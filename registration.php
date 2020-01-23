<?php 
  session_start();  
  if (isset($_SESSION['type']) && !empty($_SESSION['type'])) {
    header('location: dashboard.php');
  } else {
    include './client/components/registration.php';
  }
?>