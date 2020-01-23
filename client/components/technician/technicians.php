
<?php include('customerserver.php')?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font: 400 15px/1.8 Lato, sans-serif;
  

}

#navbar {
  background-color: #333333;
  padding: 90px 10px;
  transition: 0.4s;
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 99;
}

#navbar a {
  float: left;
  color: white;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

#navbar #logo {
  font-size: 35px;
  font-weight: bold;
  transition: 0.4s;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

#navbar a.active {
  background-color: dodgerblue;
  color: white;
}

#navbar-right {
  position: absolute;
  margin-left: 350px;
}

@media screen and (max-width: 580px) {
  #navbar {
    padding: 20px 10px !important;
  }
  #navbar a {
    float: none;
    display: block;
    text-align: left;
  }
  #navbar-right {
    float: none;
  }
}

#homei{
  margin-top: 140px;
  width: 100%;
  height: 650px;
  opacity: 1;
}

.c1{
  position: absolute;
  background-color: #ddd;
  border: none;
  color: black;
  padding:  32px;
  text-align: center;
  font-size: 30px;
  transition: 0.3s;
  height: 140px;
  width: 150px;
  border-radius: 50%;
  margin-top: 60px;
  margin-left: 60px;
}

.c1:hover {
  background-color: #3e8e41;
  color: white;
}

#p1{
  position: absolute;
  font-size: 20px;
  margin-top: 220px;
  margin-left: 65px;
  
}

.c2{
  position: absolute;
  background-color: #ddd;
  border: none;
  color: black;
  padding:  32px;
  text-align: center;
  font-size: 30px;
  transition: 0.3s;
  height: 140px;
  width: 150px;
  border-radius: 50%;
  margin-top: 60px;
  margin-left: 340px;
}

.c2:hover {
  background-color: #3e8e41;
  color: white;
}

#p2{
  position: absolute;
  font-size: 20px;
  margin-top: 220px;
  margin-left: 345px;
}

.c3{
  position: absolute;
  background-color: #ddd;
  border: none;
  color: black;
  padding:  32px;
  text-align: center;
  font-size: 30px;
  transition: 0.3s;
  height: 140px;
  width: 150px;
  border-radius: 50%;
  margin-top: 60px;
  margin-left: 610px;
}

.c3:hover {
  background-color: #3e8e41;
  color: white;
}

#p3{
  position: absolute;
  font-size: 20px;
  margin-top: 220px;
  margin-left: 600px;
}

.c4{
  position: absolute;
  background-color: #ddd;
  border: none;
  color: black;
  padding:  32px;
  text-align: center;
  font-size: 30px;
  transition: 0.3s;
  height: 140px;
  width: 150px;
  border-radius: 50%;
  margin-top: 60px;
  margin-left: 880px;
}

.c4:hover {
  background-color: #3e8e41;
  color: white;
}

#p4{
  position: absolute;
  font-size: 20px;
  margin-top: 220px;
  margin-left: 880px;
}

.c5{
  position: absolute;
  background-color: #ddd;
  border: none;
  color: black;
  padding:  32px;
  text-align: center;
  font-size: 30px;
  transition: 0.3s;
  height: 140px;
  width: 150px;
  border-radius: 50%;
  margin-top: 60px;
  margin-left: 1130px;
}

.c5:hover {
  background-color: #3e8e41;
  color: white;
}

#p5{
  position: absolute;
  font-size: 20px;
  margin-top: 220px;
  margin-left: 1160px;
}

.circle{
  height: 475px;

}

.techs{
  height: 560px;
  background-color: #FFFAF1
}

.footer{
  height: 400px;
  background-color: #2c2b30;
  font-color: white;

}

h3, h4 {
    margin: 10px 0 30px 0;     
    font-size: 30px;
    color: #111;
    margin-top: 20px;
  }

  #t1{
    position: absolute;
    margin-top: 270px;
    margin-left: 30px;
    color: #999999;
    font-size: 16px;
  }

   #t2{
    position: absolute;
    margin-top: 270px;
    margin-left: 260px;
    color: #999999;
    font-size: 16px;
  }

  #t3{
    position: absolute;
    margin-top: 270px;
    margin-left: 580px;
    color: #999999;
    font-size: 16px;
  }

  #t4{
    position: absolute;
    margin-top: 270px;
    margin-left: 850px;
    color: #999999;
    font-size: 16px;
  }

  #t5{
    position: absolute;
    margin-top: 270px;
    margin-left: 1130px;
    color: #999999;
    font-size: 16px;
  }

  #twitter{
    position: absolute;
    margin-top: 100px;
    margin-left: 100px;
    font-size: 20px;
    color: white;
  }

   #insta{
    position: absolute;
    margin-top: 100px;
    margin-left: 450px;
    font-size: 20px;
    color: white;
  }

  #contact{
    position: absolute;
    margin-top: 100px;
    margin-left: 800px;
    font-size: 20px;
    color: white;
  }

  #about{
    position: absolute;
    margin-top: 100px;
    margin-left: 1100px;
    font-size: 20px;
    color: white;
  }


#pt{
  position: absolute;
  margin-bottom: 200px;
  height: 650px;
}

#log{
  position: absolute;
  margin-left: 480px;
}

#username{
  margin-left: 100%;
}

#password{
  margin-left: 100%;
  margin-top: 20px;
}
h2 {
   position: absolute;
   top: 450px;
   left: 300px;
   color: white;
   font-family: fonts/The Machine.ttf;
   font-size: 75px;

}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: dodgerblue;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}

#regis{
  position: absolute;
  margin-left: 500px;
}

.dropdown {
  position: absolute;
  display: inline-block;
  margin-left: 550px;
}

.dropdown-content {
  width: 100px;
  position: absolute;
  margin-top: 40px;
  display: none;
  position: absolute;
  z-index: 1;
}

.dropdown-content a {
  padding: 12px 16px;
  text-decoration: none;
  display: block;
   position: absolute;
}

.dropdown:hover .dropdown-content {
  display: block;
   position: absolute;
}

#icon1{
  position: absolute;
  height: 40%;
  height: 40%;
  margin-top: 20px;
  margin-left: 110px;
}

#icon2{
  position: absolute;
  height: 40%;
  height: 40%;
  margin-top: 20px;
  margin-left: 520px;
}

#icon3{
  position: absolute;
  height: 40%;
  height: 40%;
  margin-top: 20px;
  margin-left: 940px;
}

#ttext1{
  position: absolute;
  margin-top: 280px;
  margin-left: 190px;
  font-size: 17px;
}

#ttext2{
  position: absolute;
  margin-top: 280px;
  margin-left: 600px;
  font-size: 17px;
}

#ttext3{
  position: absolute;
  margin-top: 280px;
  margin-left: 1030px;
  font-size: 17px;
}

.checked {
  color: orange;
}

.rate1{
  position: absolute;
  margin-top: 370px;
  margin-left: 190px;
}

.rate2{
  position: absolute;
  margin-top: 370px;
  margin-left: 600px;
}

.rate3{
  position: absolute;
  margin-top: 370px;
  margin-left: 1030px;
}

#t{
  position: absolute;
  margin-top: 15px;
  margin-left: 44%;
}

#viewalltech{
  border: none;
  position: absolute;
  height: 50px;
  width: 17%;
  font-size: 18px;
  background: #ddd;
  margin-top: 420px;
  margin-left: 560px;
  opacity: 0.9;
  border-radius: 20px;
}

#viewalltech:hover {
  background-color: #3e8e41;
  color: white;
}

</style>
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
    <img src="homeimage.jpg" id="homei">
    <div class="text">
       <h2>PhoneTech Technicians</h2>
    </div>
</div>

 <div class="techs">
  <br>
  <center><em><h3 id="t">Technicians</h3></center></em>
  <br><br>
 

  <img src="techicon.png" id="icon1">
  <div>
  <em><p id="ttext1">Renzo Abel A. Codilla <br> 4 years working in MaskiPop <br> IOS/ANDROID</p></em>
  <div class="rate1">
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>

  </div>
</div>
  <img src="techicon.png" id="icon2">
  <em><p id="ttext2">Renzo Abel A. Codilla <br> Freelancer for 5 years <br> IOS/ANDROID</p></em>
  <div class="rate2">
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star checked"></span>
  <span class="fa fa-star"></span>
  </div>

  <img src="techicon.png" id="icon3">
  <em><p id="ttext3">Renzo Abel A. Codilla <br> 5 years working in Cellular Options <br> IOS/ANDROID</p></em>
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
