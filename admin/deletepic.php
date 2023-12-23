<?php
session_start();
include_once("connection.php");


$delete = "DELETE FROM tbl_picturegallery WHERE id = '".$_GET['deletepic']."'";
$mysqli->query($delete);


?>