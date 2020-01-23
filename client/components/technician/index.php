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
  <!-- Navigation bar -->
  <?php include 'client/components/common/navbar.php' ?>
  
  <!-- Display page -->
  <div id="display-page" class="container"></div>


  <script type="text/javascript">
    $(document).ready(function() {
      switchPage()

      // ===== PLACE BID =====
      $(document).on('click', '.btn-add', addFormGroup);
      $(document).on('click', '.btn-remove', removeFormGroup);
      $(document).on('keyup', '.bid-price', (el) => {
        let total = [...$('.bid-price')].map(a => (parseFloat(a.value) || 0)).reduce((a,b) => a + b);
        $('#total-bid-price').text('₱' + total.toLocaleString(undefined, {minimumFractionDigits: 2}))
      });
    });

    $(window).on('hashchange', function() {
      // If page is switched, execute switchPage() function
      switchPage()
    });  

    var addFormGroup = function (event) {
      event.preventDefault();

      var $formGroup = $(this).closest('.form-group');
      var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
      var $formGroupClone = $formGroup.clone();

      $(this)
          .toggleClass('btn-success btn-add btn-danger btn-remove')
          .html('–');

      $formGroupClone.find('input').val('');
      $formGroupClone.find('.concept').text('Phone');
      $formGroupClone.insertAfter($formGroup);

      var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
      if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
          $lastFormGroupLast.find('.btn-add').attr('disabled', true);
      }
    };

    var removeFormGroup = function (event) {
      event.preventDefault();

      var $formGroup = $(this).closest('.form-group');
      var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

      var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
      if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
          $lastFormGroupLast.find('.btn-add').attr('disabled', false);
      }

      $formGroup.remove();
    };

    var countFormGroup = function ($form) {
      return $form.find('.form-group').length;
    };

    function initializeDatatables() {
      // Initialize datatables
      $("[data-toggle='modal'], [data-toggle='tooltip']").tooltip();

      $('#summary-table').DataTable({
        "paging": false,
        "info": false,
        "order": [[ 5, "asc" ]],
      });

      $('#problem-table').DataTable({
        "paging": false,
        "order": [[ 6, "asc" ], [ 5, "desc" ]],
        "columnDefs": [
          {
            "width": "5%", 
            "targets": 0
          },
          {
            "width": "5%", 
            "targets": 6
          },
        ],
      });
    }

    function enterBid(row, type) {
      let total = 0;
      clearText();

      if (type === 'update') {
        $('.update-bid').each((i, el) => {$('#' + el.id).show()});
        $('.view-bid').each((i, el) => {$('#' + el.id).hide()});

        $('#id').val(row.bid_id);
        $('#problem_id').val(row.id);
        $('#repairdays').val(row.repairdays);
        row.payments.forEach((e, i) => {
          if (i != 0) $('.btn-add').click();

          total += parseFloat(e.price);
          $('input[name="descr"]')[i].value =  e.descr;
          $('input[name="price"]')[i].value =  e.price;
        })

        $('#total-bid-price').text('₱' + total.toLocaleString(undefined, {minimumFractionDigits: 2}));
      } else {
        $('.update-bid').each((i, el) => {$('#' + el.id).hide()})
        $('.view-bid').each((i, el) => {$('#' + el.id).show()});

        if (row.status == 'Finished') {
          $('#view-footer').hide();
        }

        let breakdown = '';

        $('#problem_id_view').val(row.id);
        $('#summary_id').text('PR-' + row.id);
        $('#summary-status').text(row.status);
        $('#summary-name').text(row.FirstName + ' ' + row.LastName);
        $('#summary-serialNumber').text(row.serialNumber);
        $('#summary-brand').text(row.brand);
        $('#summary-problem').text(row.problem);
        $('#summary-repairdays').text(row.repairdays);

        row.payments.forEach((e, i) => {
          breakdown += `
            <tr>
              <td>${e.descr}</td>
              <td style="text-align: right;">₱${parseFloat(e.price).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
            </tr>
          `;
          
          total += parseFloat(e.price);
        })
        $('#summary-total-price').text('₱' + parseFloat(total).toLocaleString(undefined, {minimumFractionDigits: 2}));
        $('#payment-breakdown').html(breakdown);
      }
    }

    function ackRepair() {
      const formData = new FormData(document.forms.namedItem('modal-form3'))
      let payload = {};
      formData.forEach((value,key) => payload[key] = value);

      $.post('/phonetech/server/customerserver.php', { ...payload, status: 'Finished', Ack: null }, (result) => {
        result = JSON.parse(result)
        if(result.success) {
          alert('Response successfully sent!');
          window.location.reload(true);
        } else {
          alert(result.msg);
          console.log(result.msg)
        }
      });
    }

    function repairDone(row) {
      $('#problemo').val(row.id);
    }

    function clearText() {
      let bids = $('.form-group.multiple-form-group.input-group');
      bids.each((i, el) => { if ((bids.length - 1) > i) el.remove(); });
      // Update Modal
      $('#problem_id').val('');
      $('#repairdays').val('');
      $('input[name="descr"]')[0].value = '';
      $('input[name="price"]')[0].value = '';

      // View Modal
      $('#su').val('')
      $('#problem_id_view').val('');
      $('#summary_id').text('');
      $('#summary-status').text('');
      $('#summary-name').text('');
      $('#summary-serialNumber').text('');
      $('#summary-brand').text('');
      $('#summary-problem').text('');
      $('#summary-repairdays').text('');

      $('#total-bid-price').text('₱' + (0).toLocaleString(undefined, {minimumFractionDigits: 2}));
    }

    function ack(event) {
      const formData = new FormData(document.forms.namedItem('modal-form2'))
      let payload = {};
      formData.forEach((value,key) => payload[key] = value);

      console.log(payload)

      $.post('/phonetech/server/customerserver.php', { id: payload.problem_id, status: payload.status, Ack: null }, (result) => {
        result = JSON.parse(result)
        if(result.success) {
          alert('Response successfully sent!');
          window.location.reload(true);
        } else {
          alert(result.msg);
          console.log(result.msg)
        }
      });
    }

    function setStatus(status) {
      $('#su').val(status)
    }

    function submitBid() {
      const formData = new FormData(document.forms.namedItem('modal-form'))
      let payload = {};
      formData.forEach((value,key) => payload[key] = ((key == 'descr' || key == 'price')? (!!payload[key] ? payload[key].concat([value]) : [value]) : value) )

      if (payload.id == 0 || payload.id == null || payload.id == '') {
        delete payload.id;
      }

      $.post('/phonetech/server/customerserver.php', { ...payload, user_id: <?php echo $_SESSION['Customer_ID']; ?>, SubmitBid: null }, (result) => {
        result = JSON.parse(result)
        if(result.success) {
          alert('Post Bid succesfull!');
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
        if (hash === '#problemlist') {              

          // Display table if on problemlist page (in this case -> Technician)
          x.innerHTML = `<?php include "client/components/technician/problemlist.php"; ?>`;

          // Change active class on current page
          $('#home-link').removeClass("active"); 
          $('#problemlist-link').addClass("active");

          // // Initialize onchange on phone select when current page is on technician bid
          // const problem_id = loc_split.length > 1? loc_split[1].substr(1).split('=')[1] : ''; // Get problem_id search params
          // $(`#phone-select option[value='${problem_id}']`).attr('selected', true); // Select value of phone based on search params
          // $('#phone-select').on('change', function() {
          //   window.location = 'dashboard.php?problem_id=' + this.value.split('|')[0] + '#problemlist'; // Refresh page with new problem_id
          // });

        } else {
          backHome(x);
        }
      } else {
        backHome(x);
      }

      initializeDatatables()
    }

    function backHome(x) {
      // Display home page
      x.innerHTML = `<?php include "client/components/technician/home.php"; ?>`;

      // Change active class on current page (in this case -> Home)
      $('#home-link').addClass("active");
      $('#problemlist-link').removeClass("active");
    }
  </script>
</body>
</html>
