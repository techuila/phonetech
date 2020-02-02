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


  <div id="image-header">
    <div class="header-text-img">
      <h2>PhoneTech: An Online Technician <br> &nbsp &nbsp Finder In Zamboanga City</h2>
      <center><a href="registration.php"><button class="btn" id="getstarted">Get Started</button></a></center>
    </div>
    <img src="client/assets/img/homeimage.jpg" id="homei">
  </div>

  <div class="techs">
    <h3 style="text-align: center;width: 100%;margin: 20px 0;font-weight: 600;font-size: 1.5em;color: #000;">Technicians</h3>

    <!-- <img src="client/assets/img/techicon.png" id="icon1"> -->
    <div class="tech-user-container">

      <?php 
        $conn= new mysqli("localhost", "root","","phonetech_db");
        $query= "SELECT a.Customer_ID, a.FirstName, a.LastName, a.photo, AVG(c.rating) as rating FROM customer_account a LEFT OUTER JOIN problem_tb b ON a.Customer_ID = b.tech_id LEFT OUTER JOIN rating_tb c ON b.id = c.problem_id WHERE a.type != 'Administrator' GROUP BY a.Customer_ID ORDER BY rating DESC";
        $res=$conn->query($query);
        $x1 = 0;
        while($row=$res->fetch_assoc()){
          $x1 += 1;
          $hasPhoto = $row['photo'] != null && $row['photo'] != '';
      ?>
        <div class="user-container">
          <div class="circle-user" style="display: <?= $hasPhoto ? 'none' : 'block'; ?>">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
          </div>
          <img id="tech-photo" src="server/uploads/<?= $row['photo']; ?>" class="rounded mx-auto d-block" style="display: <?= $hasPhoto ? 'block' : 'none'; ?>; margin-left: 20px;">
          
          <p class="tech-name"><?= $row['FirstName'] . ' ' . $row['LastName'] ?></p>
          <div class="rate">
              <?php 
                for ($y = 1; $y <= 5; $y++) {
                  if ($y <= intval($row['rating'])) {
                    if ($y == intval($row['rating'])) {
                      if ($y < $row['rating']) {
                        echo "<span class='fa fa-star-half-o checked'></span>";
                      } else {
                        echo "<span class='fa fa-star checked'></span>";
                      }
                    } else {
                      echo "<span class='fa fa-star checked'></span>";
                    }
                  } else {
                    echo "<span class='fa fa-star-o'></span>";
                  }
                }
              ?>
            </div>
        </div>
      <?php } 
        if($x1 == 0 ){
          ?>
          <h2>-- No Data --</h2>
        <?php } ?>
    </div>
  </div>

  <div class="footer">
    <a href="#twtr">
      <p>TWITTER FEED</p>
    </a>
    <a href="#twtr">
      <p>INSTAGRAM FEED</p>
    </a>
    <a href="#twtr">
      <p>CONTACT US</p>
    </a>
    <a href="#twtr">
      <p>ABOUT US</p>
    </a>
  </div>

  <script>
    // When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("navbar").style.padding = "30px 10px";
        document.getElementById("logo").style.fontSize = "25px";
      } else {
        document.getElementById("navbar").style.padding = "80px 10px";
        document.getElementById("logo").style.fontSize = "35px";
      }
    }
  </script>

</body>
</html>
