<?php include '../../server/customerserver.php'?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/app.css">
</head>
<body>

<div id="navbar">
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
</div>  


<div class="image">
    <img src="../assets/img/homeimage.jpg" id="homei">
    <div class="text">
       <h2>ABOUT US</h2>
    </div>
</div>

<div class="circle">

  <em><h3 id="who">WHO WE ARE</h3></em>
  <div class="abouttext">
  <p>Since launching in 2006, Online Auction has been <br> recognized as the go-to online auction marketplace for <br> new, overstock, closeout and recertified products.</p>
 </div>

 <div class="abouttext2">
   <em><p>We specialize in offering the best deals on popular, everyday items <br> from watches to laptops, and sports memorabilia from trusted and <br> certified vendors and merchants, directly to our customers in auction, <br> fixed-price and "Deals of the Day" formats.</p></em>
 </div>

  
</div><br>

 <div class="techs">
  <center><em><h3 id="t">What We Offer</h3></center></em>
  <br><br>
 

  <img src="techicon.png" id="icon1">
  <em><p id="ttext2">Renzo Abel A. Codilla <br> &nbsp &nbsp IOS/ANDROID</p></em>
  <div class="rate2">
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  </div>

  <img src="techicon.png" id="icon2">
  <em><p id="ttext1">Renzo Abel A. Codilla <br> &nbsp &nbsp IOS/ANDROID</p></em>
  <div class="rate1">
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star"></span>
  </div>

  <img src="techicon.png" id="icon3">
  <em><p id="ttext3">Renzo Abel A. Codilla <br> &nbsp &nbsp IOS/ANDROID</p></em>
  <div class="rate3">
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star"></span>
  <span class="fa fa-star"></span>
  </div>

  
</div>

<div class="footer">
  <a href="#twtr"></a><p id="twitter">TWITTER FEED</p></a>
  <a href="#twtr"></a><p id="insta">INSTAGRAM FEED</p></a>
  <a href="#twtr"></a><p id="contact">CONTACT US</p></a>
  <a href="#twtr"></a><p id="about">ABOUT US</p></a>

</div>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">LOGIN NOW!</h4></center>
        </div>
        <div class="modal-body">

          <form action="homepage.php" method="post">
            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Username" name="Username">
            </div>
            
            <div class="input-container">
              <i class="fa fa-key icon"></i>
              <input class="input-field" type="password" placeholder="Password" name="Password">
            </div>

            <button type="submit" class="btn" name="Login">Log In</button>
            
            <li>
              <span class="txt1">
                Don’t have an account?
              </span>

              <a href="registercustomer.php" class="txt2">
                Sign up
              </a>
            </li>
          </ul>

          </form>

      
        </div>
      </div>
      
    </div>
  </div>

  
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
