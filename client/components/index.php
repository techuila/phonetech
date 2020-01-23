<?php include 'server/customerserver.php'?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="client/assets/css/app.css">
</head>

<body>

  <!-- <div id="navbar">
    <a href="#default" id="logo">Phone Tech Logo</a>
    <div id="navbar-right">
      <a href="homepage.php">Home</a>
      <a href="aboutus.php">About Us</a>
      <a href="technicians.php">Technicians</a>
      <a href="#about" data-toggle="modal" data-target="#myModal" id="log">Login</a>
      <div class="dropdown">
        <a href="registercustomer.php" class="dropbtn">Register</a>
        <div class="dropdown-content">
          <a href="registercustomer.php">Customer</a><br><br>
          <a href="registertechnician.php">Technician</a>
        </div>
      </div>

    </div>
  </div> -->

  <!-- Navigation bar -->
  <?php include 'client/components/common/navbar.php' ?>

  <div id="image-header">
    <div class="header-text-img">
      <h2>PhoneTech: An Online Technician <br> &nbsp &nbsp Finder In Zamboanga City</h2>
      <center><a href="customer/server/registercustomer.php"><button class="btn" id="getstarted">Get Started</button></a></center>
    </div>
    <img src="client/assets/img/homeimage.jpg" id="homei">
  </div>
  <div class="circle">
    <h3 style="text-align: center;width: 100%;margin: 20px 0;font-weight: 600;font-size: 1.5em;color: #000;">HOW IT WORKS</h3>

    <div id="circles">
      <div class="c-container">
        <button class="step">1</button>
        <p class="c-header">Register/Login</p>
        <p class="c-desc">To start the process, you"ll need to login or register.</p>
      </div>
        
      <div class="c-container">
        <button class="step">2</button>
        <p class="c-header">Post Problem</p>
        <p class="c-desc">You can post the problem of your phone. You can select a filtered problem about your mobile phone.</p>
      </div>
        
      <div class="c-container">
        <button class="step">3</button>
        <p class="c-header">Choose Technician</p>
        <p class="c-desc">Now choose your selected technician that has a convenient bid price. </p>
      </div>
        
      <div class="c-container">
        <button class="step">4</button>
        <p class="c-header">Confirm Repair</p>
        <p class="c-desc"> Check if the phone has been repaired. Confirm after 3 days if phone has been repaired.</p>
      </div>
        
      <div class="c-container">
        <button class="step">5</button>
        <p class="c-header">Feedback</p>
        <p class="c-desc">Submit your feedback about the service given by the technician.</p>
      </div>
    </div>
  </div>

  <div class="techs">
    <h3 style="text-align: center;width: 100%;margin: 20px 0;font-weight: 600;font-size: 1.5em;color: #000;">Top Technicians</h3>

    <!-- <img src="client/assets/img/techicon.png" id="icon1"> -->
    <div class="tech-user-container">
      <div class="user-container">
        <div class="circle-user">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </div>
  
        <p class="tech-name">Renzo Abel A. Codilla</p>
        <p class="tech-position">IOS / ANDROID DEVELOPER</p>
        <div class="rate">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>

        </div>
      </div>

      <div class="user-container">
        <div class="circle-user">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </div>
        
        <p class="tech-name">Renzo Abel A. Codilla</p>
        <p class="tech-position">IOS / ANDROID DEVELOPER</p>
        <div class="rate">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
        </div>
      </div>

      <div class="user-container">
        <div class="circle-user">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </div>
        
        <p class="tech-name">Renzo Abel A. Codilla</p>
        <p class="tech-position">IOS / ANDROID DEVELOPER</p>
        <div class="rate">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
        </div>
      </div>
    </div>

    <a href="client/components/technician/technicians.php"><button class="btn" id="viewalltech">View All Technician</button></a>
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
    window.onscroll = function() {
      scrollFunction()
    };

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
