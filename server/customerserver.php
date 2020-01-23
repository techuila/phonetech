<?php

// session_start();
//Registration variables
$FirstName = "";
$LastName = "";
$Username = "";
$Password = "";
$ContactNumber = "";
$Email = "";
$Address = "";
$errors = array();

//Registration local input variable to database storing
$db = mysqli_connect('localhost', 'root', '', 'phonetech_db');

if (isset($_POST['ChangeStatus'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $status = mysqli_real_escape_string($db, $_POST['status']);
  $query = "UPDATE customer_account SET status = '$status' WHERE Customer_ID = $id;";

  echo executeQuery($db, $query, null);
}

//REGISTER
if (isset($_POST['Register'])) {
  $FirstName = mysqli_real_escape_string($db, $_POST['FirstName']);
  $LastName = mysqli_real_escape_string($db, $_POST['LastName']);
  $Username = mysqli_real_escape_string($db, $_POST['Username']);
  $ContactNumber = mysqli_real_escape_string($db, $_POST['ContactNumber']);
  $Email = mysqli_real_escape_string($db, $_POST['Email']);
  $Type = mysqli_real_escape_string($db, $_POST['type']);
  $Address = mysqli_real_escape_string($db, $_POST['Address']);
  $Password1 = mysqli_real_escape_string($db, $_POST['Password1']);
  $Password2 = mysqli_real_escape_string($db, $_POST['Password2']);

  $user_check_query = "SELECT * FROM customer_account WHERE Username='$Username'LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  
  if (!isset($_POST['EditAccount'])) {
    require_once getcwd() . '/server/vendor/autoload.php'; 
    
    $Password1 = mysqli_real_escape_string($db, $_POST['Password1']);
    $Password2 = mysqli_real_escape_string($db, $_POST['Password2']);

    //CHECK REQUIRMENTS
    if ($Password1 != $Password2) {
      array_push($errors, "The two passwords do not match!", "<br>");
    }

    if ($user) { // if user exists
      if ($user['Username'] === $Username) {
        array_push($errors, "Username already exists!");
      }
    }

    if (!$user) {
      $Password = $Password1;
      $status = ($Type === 'Technician' ? 'Pending' : 'Active');
      $query = "INSERT INTO customer_account (FirstName, LastName, Username, Password, ContactNumber, Email, Address, type, status)
          VALUES('$FirstName', '$LastName', '$Username', '$Password', '$ContactNumber', '$Email', '$Address', '$Type', '$status')";
      mysqli_query($db, $query);
  
      if ($Type === 'Technician') {
        $query1 = "SELECT * FROM customer_account WHERE Email = 'phonetech.zam@gmail.com' LIMIT 1";
        $result1 = mysqli_query($db, $query1);
        $admin = mysqli_fetch_assoc($result1);
  
        $basic  = new \Nexmo\Client\Credentials\Basic('f9b7b5b4', 'ReB3KvDqSDP2YgYR');
        $client = new \Nexmo\Client($basic);
    
        $message = $client->message()->send([
          'to' => $admin['ContactNumber'],
          'from' => 'Phone Tech',
          'text' => "Phone Tech\nA new registered technician pending for approval: \nName: ". $FirstName . " " . $LastName . "\nMobile #: +". $ContactNumber . " \n\n"
        ]);
    
        // ======= ERROR RESPONSE GUIDE ======= 
        // "1" = Invalid Number.
        // "2" = Number Prefix not supported. Please contact us so we can add.
        // "3" = Invalid ApiCode.
        // "4" = Maximum Message per day reached. This will be reset every 12MN.
        // "5" = Maximum allowed character for message reached.
        // "6" = System OFFLINE.
        // "7" = Expired APICODE.
        // "8" = iTexMo Error. Please try again later.
        // "9" = Invalid Function Parameters.
        // "10" = Recipent's number is blocked due to flooding, message was ignored.
        // "11" = Recipent's number is blocked temporarily due to HARD sending (after 3 retries of sending and message still failed to send) and the message was ignored. Try again after an hour.
        // "12" = Invalid request. You can't set message prorities on non corporate apicodes.
        // "13" = Invalid or Not Registered Custom Sender ID.
        // "0" = Success! Message is now on queue and will be sent soon.
    
        if ($message->getResponseData() == "") { // SMS NOT SENT
          echo "<script type ='text/javascript'>alert('Registration succesfull, wait for the administrator's approval \nError: unable to send sms. (". $message->getResponseData().")');window.location = 'index.php'</script>";
        } else { // SMS SUCCESSFULLY SENT
          echo "<script type ='text/javascript'>alert('Registration succesfull, wait for the administrator's approval');window.location = 'index.php'</script>";
        }
      } else {
        echo "<script type ='text/javascript'>alert('Registration succesfull');window.location = 'index.php'</script>";
      }
    }
    
  } else {

    // ===== Edit Account =====
    $id = mysqli_real_escape_string($db, $_POST['Customer_ID']);
    $Username1 = mysqli_real_escape_string($db, $_POST['Username1']);
    $pass = "";

    if (isset($_POST['ChangePass']) && $Password1 != $Password2) {
      array_push($errors, "The two passwords do not match!", "<br>");
    } elseif (isset($_POST['ChangePass']) && $Password1 == $Password2) {
      $pass = "Password = '$Password1',";
    }

    if ($user) { // if user exists
      if (strcmp(trim($Username),trim($Username1)) != 0) {  // Username changed
        if ($user['Username'] === $Username) {  // New username exists
          array_push($errors, "Username already exists!");
        }
      }
    }

    if (count($errors) == 0) {
      $q11  ="UPDATE customer_account SET FirstName = '$FirstName', LastName = '$LastName', Username = '$Username', ".$pass." ContactNumber = '$ContactNumber', Email = '$Email', Address = '$Address', type = '$Type' WHERE Customer_ID = $id;";
      echo executeQuery($db, $q11, null);
    } else {
      echo json_encode(['success'=>false, 'msg'=>$errors]);
    }
  }
}

//LOGIN
if (isset($_POST['Login'])) {
  require 'config.php';
  $Username = mysqli_real_escape_string($db, $_POST['Username']);
  $Password = mysqli_real_escape_string($db, $_POST['Password']);

  $query = "SELECT * FROM customer_account WHERE Username='$Username' AND Password='$Password';";
  $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
  $user = mysqli_fetch_assoc($results);
  $count = mysqli_num_rows($results);

  if ($user['type'] != 'Technician') {    
    if ($count == 1) {
      login($user);
    } else {
      echo "<script type='text/javascript'>alert('Wrong Username/Password')</script>";
    }
  } else {
    if ($user['status'] == 'Active') {
      login($user);
    } else {
      echo "<script type='text/javascript'>alert('Account has not yet approved by the admin')</script>";
    }
  }
}

function login ($row) {
  $_SESSION['Customer_ID'] = $row['Customer_ID'];
  $_SESSION['FirstName'] = $row['FirstName'];
  $_SESSION['LastName'] = $row['LastName'];
  $_SESSION['Username'] = $row['Username'];
  $_SESSION['Password'] = $row['Password'];
  $_SESSION['type'] = $row['type'];
  $_SESSION['ContactNumber'] = $row['ContactNumber'];
  $_SESSION['Email'] = $row['Email'];
  $_SESSION['Address'] = $row['Address'];

  header('location: dashboard.php');
}

if (isset($_POST['submit'])) {
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png', 'pdf');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {
        $fileNameNew = uniqid('.', true) . "." . $fileActualExt;
        $fileDestination = 'uploads/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        echo "File is too big!";
      }

    } else {
      echo "There was an error uploading your file!";
    }

  } else {
    echo "You cannot upload files of this type!";
  }

}

if (isset($_POST['PostProblem'])) {

  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $serialNumber = mysqli_real_escape_string($db, $_POST['serialNumber']);
  $brand = mysqli_real_escape_string($db, $_POST['brand']);
  $problem = mysqli_real_escape_string($db, $_POST['problem']);

  $query = "INSERT INTO problem_tb (user_id, serialNumber, brand, problem) VALUES($user_id, '$serialNumber', '$brand', '$problem')";
  echo executeQuery($db, $query, $user_id);
}

if (isset($_POST['SubmitBid'])) {
  $descr = $_POST['descr'];
  $price = $_POST['price'];
  $repairdays = mysqli_real_escape_string($db, $_POST['repairdays']);
  $problem_id = mysqli_real_escape_string($db, $_POST['problem_id']);
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $id = isset($_POST['id']) ? mysqli_real_escape_string($db, $_POST['id']) : "(SELECT LAST_INSERT_ID())";  
  
  if (isset($_POST['id'])) {
    $q1 = "UPDATE bid_tb SET repairdays = '$repairdays' WHERE id = $id;";
    $q2 = "DELETE FROM payment_breakdown WHERE bid_id = $id;";
    $query = $q1 . $q2;
  } else {
    $query = "INSERT INTO bid_tb (problem_id, tech_id, repairdays) VALUES($problem_id, $user_id, '$repairdays');";
  }
  $query .= insertQuery($id, $price, $descr);

  echo executeQuery($db, $query, null);
}

if (isset($_POST['SelectBid'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $tech_id = mysqli_real_escape_string($db, $_POST['tech_id']);
  $status = mysqli_real_escape_string($db, $_POST['status']);

  // Reset problem data then update new selected bid
  $query = "UPDATE problem_tb SET tech_id = 0, status = 'No Technician' WHERE id != $id;
              UPDATE problem_tb SET tech_id = $tech_id, status = '$status' WHERE id = $id;";

  echo executeQuery($db, $query, $query);
}

if (isset($_POST['SubmitFeedback'])) {
  $problem_id = mysqli_real_escape_string($db, $_POST['problem_id']);
  $comment = mysqli_real_escape_string($db, $_POST['comment']);
  $rating = mysqli_real_escape_string($db, $_POST['rating']);

  // Reset problem data then update new selected bid
  $query = "INSERT INTO rating_tb (problem_id, rating, comment) 
              VALUES($problem_id, $rating, '$comment');";

  echo executeQuery($db, $query, $query);
}

function insertQuery ($id, $price, $descr) {
  $pb_query = "INSERT INTO payment_breakdown (bid_id, price, descr) VALUES";

  for ($i = 0; $i < count($descr); $i++) {
    $p = $price[$i];
    $d = $descr[$i];
    $pb_query .= "($id, '$p', '$d')";

    if ($i == (count($descr) - 1)) {
      $pb_query .= ";";
    } else {
      $pb_query .= ", ";
    }
  }

  return $pb_query;
}

if (isset($_POST['Ack'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $status = mysqli_real_escape_string($db, $_POST['status']);

  $query = "UPDATE problem_tb SET status = '$status' WHERE id = $id;";

  echo executeQuery($db, $query, $query);
}

function executeQuery($db, $query, $error) {
  if (mysqli_multi_query($db, $query)) {
    return json_encode(['success'=>true]);
  } else {
    return json_encode(['success'=>false, 'msg'=> $error != null ? $error : mysqli_error($db)]);
  }
}


if (isset($_POST['Logout'])) {
  session_start();
  session_destroy();
  header('location: ../index.php');
}