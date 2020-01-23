<?php

$connection = mysqli_connect('localhost', 'root', '');
if (!$connection){
	die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'phonetech_db');
if (!$select_db) {
	die("Databse Selection Failed" . mysqli_error($connection));
}

?>