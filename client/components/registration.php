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
<form id="photo-form" name="choosePhoto" enctype="multipart/form-data">
  <input id="photo-file" name="file" type="file">
</form>
<form method="post" action="/phonetech/registration.php" style="border:1px solid #ccc" enctype="multipart/form-data">
  <input style="visibility: hidden; height: 0;position: absolute;" type="text" class="form-control" name="photo" id="invi-photo">

  <div id="registration-form" class="container">
    <?php include getcwd() . '/client/components/common/errorsreg.php'?>

    <div id="tech-photo-container" class="tech-user-container techy">
      <div class="user-container">
        <div class="circle-user" onclick="document.getElementById('photo-file').click();">
          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </div>
      </div>
      <img id="tech-photo" src="" onclick="document.getElementById('photo-file').click();" class="rounded mx-auto d-block">
      <br />
    </div>

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

    <div id="custom-file" class="form-group">
      <label for="exampleFormControlFile1">Upload Certificate</label>
      <input type="file" name="certificate" class="form-control-file" id="exampleFormControlFile1">
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
$(document).on('change', '.user-type input[type="radio"]', function (event) {
  if (event.target.value === 'Technician') {
    $('#tech-photo-container').css('display', 'flex');
    $('#custom-file').css('display', 'block');
  } else {
    $('#tech-photo-container').css('display', 'none');
    $('#custom-file').css('display', 'none');
  }
})

$(document).on('change', '#photo-file', function () {
  var formData = new FormData(document.forms.namedItem('choosePhoto'));
  var f = $('#photo-file').val().replace(/.*[\/\\]/, '');
  $.ajax({
      url: '/phonetech/server/movePhoto.php',
      dataType: 'JSON',
      type: 'POST',
      data: formData,
      contentType: false, 
      processData: false,
      success: function(result){
        if (result.success) {
          $('#invi-photo').val(f)

          $('#tech-photo').css('display', 'initial');
          $('#tech-photo-container .user-container').css('display', 'none');
          $('#tech-photo').attr('src','/phonetech/server/uploads/'+f);
        } else {
          $('#tech-photo').css('display', 'none');
          $('#tech-photo-container .user-container').css('display', 'initial');
        }
      },
      error: function(a,b,c){
          console.log("Error: " + a + " " + b + " " + c);
      }
  });
})

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
