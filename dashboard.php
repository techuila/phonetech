<?php 
  session_start();
  if (isset($_SESSION['type']) && !empty($_SESSION['type'])) {
    if ($_SESSION['type'] === 'Customer') {
      include 'client/components/customer/index.php';
    } else if ($_SESSION['type'] === 'Technician') {
      include 'client/components/technician/index.php';
    } else {
      include 'client/components/administrator/index.php';
    }
  } else {
    header('location: index.php');
  }
?>