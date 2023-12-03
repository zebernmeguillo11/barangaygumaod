<?php 
$mysqli = mysqli_connect("localhost","root", "");
mysqli_select_db($mysqli, "db_barangay");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  



?>

