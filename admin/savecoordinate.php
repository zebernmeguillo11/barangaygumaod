<?php
session_start();
include_once("connection.php");


$sql = "INSERT INTO `tbl_coordinates` (`id`, `houseno`, `coordinates`) VALUES (NULL, '".$_GET['houseno']."', '".$_GET['latlng']."')";
$mysqli->query($sql);

?>