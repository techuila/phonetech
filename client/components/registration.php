<?php include getcwd() . '/server/customerserver.php'?>

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

<!-- Navigation bar -->
<?php include getcwd() . '/client/components/common/navbar.php'?>


<center><h1>Register Now!</h1></center>

<br>

<form method="post" action="/phonetech/registration.php" style="border:1px solid #ccc">
  <div id="registration-form" class="container">
    <?php include getcwd() . '/client/components/common/errorsreg.php'?>

    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">First Name</span>
      <input type="text" class="form-control" placeholder="Enter First Name" name="FirstName" required>
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Last Name</span>
      <input type="text" class="form-control" placeholder="Enter Last Name" name="LastName" required>
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Username</span>
      <input type="text" class="form-control" placeholder="Enter Username" name="Username" required>
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Password</span>
      <input type="password" class="form-control" placeholder="Enter Password" name="Password1" required>
    </div>
    
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Confirm Password</span>
      <input type="password" class="form-control" placeholder="Repeat Password" name="Password2" required>
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Contact Number (+63)</span>
      <input maxlength="10" type="text" class="form-control" placeholder="Enter Contact Number" name="ContactNumber" required>
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Email Address</span>
      <input type="email" class="form-control" placeholder="Enter Email Address" name="Email" required>
    </div>

    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">Address</span>
      <input type="text" class="form-control" placeholder="Enter Address" name="Address" required>
    </div>

    <div class="user-type">
      <input type="radio" name="type" value="Customer" checked> Customer
      <input type="radio" name="type" value="Technician"> Technician
    </div>

    <div class="clearfix">
      <a href="index.php"><button type="button" class="cancelbtn">Cancel</button></a>
      <button type="submit" class="signupbtn" name="Register">Register</button>
    </div>
  </div>
</form>

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
