<?php include 'server/functions.php'?>
<?php include 'server/customerserver.php'?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="client/assets/css/app.css">
</head>
<body>
  
  <!--POP UP EDIT ENFORCER'S ACCOUNT -->

  <!-- Navigation bar -->
  <?php include 'client/components/common/navbar.php'; ?>

  <!-- Display page -->
  <div id="display-page" class="container"></div>

  <script type="text/javascript">
    $(document).ready(function() {
      switchPage()

      $("[data-toggle='tooltip']").tooltip();

      let valPhone = $('#phone-select').val();
      const problem_id = window.location.search.substr(1).split('=')[1]; // Get problem_id search params
      let phoneSelect = $(`#phone-select option[value='${problem_id}']`);
      phoneSelect.attr('selected', true) // Select value of phone based on search params
      $('#problem-label').text(phoneSelect.attr("data-problem")) // Display problem based on selected phone (data-problem attribute)
      $('#technician-name').text(phoneSelect.attr("data-name")) // Display problem based on selected phone (data-problem attribute)
      $('#technician-contact').text(phoneSelect.attr("data-contactNumber")) // Display problem based on selected phone (data-problem attribute)

      console.log(phoneSelect.attr("data-contactNumber"))

      $(window).on('hashchange', function() {
        // If page is switched, execute switchPage() function
        switchPage()
      });  

      $('#summary-table').DataTable({
        "paging": false,
        "info": false
      });

      $('#technicianbid-table').DataTable({
        "order": [[ 0, "asc" ]],
        "columnDefs": [
          {
            "targets": [4],
            orderable: false,
            "width": "10%", 
          },
          {
            "width": "5%", 
            "targets": 0
          },
          {
            "width": "10%", 
            "targets": 2 
          },
          {
            "width": "20%", 
            "targets": 3 
          },
        ],
      });

      // Event for rating
      $(document).on('click', '.fa-star', rateStar);
    });

    function lookProblem(id) {
      window.location = `dashboard.php?problem_id=${id}#technicianbid`; // Refresh page with new problem_id
    }

    function rateStar(event) {
      const rate = event.target.dataset.rate;
      $('#rate-me .fa-star').each((i, el) => {
        if (rate > i)
          $('#' + el.id).addClass('checked')
        else  
          $('#' + el.id).removeClass('checked')
      });
      $('#rating').val(rate)
    }

    function submitFeedback() {
      const formData = new FormData(document.forms.namedItem('form-rating'))
      let payload = {};
      formData.forEach((value,key) => payload[key] = value)

      $.post('/phonetech/server/customerserver.php', { ...payload, SubmitFeedback: null }, (result) => {
        result = JSON.parse(result)
        if(result.success) {
          alert('Successfully selected bid!');
          window.location.reload(true);
        } else {
          alert(result.msg);
          console.log(result.msg)
        }
      });
    }

    function selectBid(row) {
      console.log(row)
      $('#problem_id').val(row.problem_id); 
      $('#tech_id').val(row.tech_id); 
      $('#status').val('Pending'); 
    }

    function submitBid() {
      const formData = new FormData(document.forms.namedItem('modal-form3'))
      let payload = {};
      formData.forEach((value,key) => payload[key] = value)

      $.post('/phonetech/server/customerserver.php', { ...payload, SelectBid: null }, (result) => {
        result = JSON.parse(result)
        if(result.success) {
          alert('Successfully selected bid!');
          window.location.reload(true);
        } else {
          alert(result.msg);
          console.log(result.msg)
        }
      });
    }

    function postProblem() {
      const formData = new FormData(document.forms.namedItem('modal-form'))
      let payload = {};
      formData.forEach((value,key) => payload[key] = value )

      $.post('/phonetech/server/customerserver.php', { ...payload, PostProblem: null }, (result) => {
        result = JSON.parse(result)
        if(result.success) {
          alert('Account successfully updated!');
          window.location.reload(true);
        } else {
          alert(result.msg);
          console.log(result.msg)
        }
      });
    }


    function switchPage () {
      let x = document.getElementById("display-page");

      if (window.location.hash !== '') {
        let loc_split = (window.location.hash).split('?')
        const hash = loc_split[0]
        if (hash === '#technicianbid') {

          // Display table if on technicianbid page (in this case -> Technician)
          x.innerHTML = `<?php include "client/components/customer/technicianbid.php"; ?>`;

          // Change active class on current page
          $('#home-link').removeClass("active"); 
          $('#technicianbid-link').addClass("active");

          // Initialize onchange on phone select when current page is on technician bid
          const problem_id = loc_split.length > 1? loc_split[1].substr(1).split('=')[1] : ''; // Get problem_id search params
          $(`#phone-select option[value='${problem_id}']`).attr('selected', true); // Select value of phone based on search params
          $('#phone-select').on('change', function() {
            window.location = 'dashboard.php?problem_id=' + this.value.split('|')[0] + '#technicianbid'; // Refresh page with new problem_id
          });

        } else {
          backHome(x);
        }
      } else {
        backHome(x);
      }
    }

    function backHome(x) {
      // Display home page
      x.innerHTML = `<?php include "client/components/customer/home.php"; ?>`;

      // Change active class on current page (in this case -> Home)
      $('#home-link').addClass("active");
      $('#technicianbid-link').removeClass("active");
    }
  </script>
</body>
</html>
