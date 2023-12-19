<?php
session_start();
include_once("connection.php");

if(isset($_GET['doctype']) && $_GET['doctype'] =="1")
$sql= "SELECT * FROM tbl_doctype1 WHERE request_id = '".$_GET["id"]."'";
$result = $mysqli->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $update = "UPDATE `tbl_doctype1` SET `Lastname` = '".$_GET['lastname']."', `Firstname` = '".$_GET['firstname']."', `Address` = '".$_GET['address']."', `purchase_details` = '".$_GET['purchasedet']."', `destination` = '".$_GET['destination']."' WHERE `tbl_doctype1`.`id` = '".$row['id']."'";
    $mysqli->query($update);
}else{
    $insert = "INSERT INTO `tbl_doctype1` (`id`, `request_id`, `Lastname`, `Firstname`, `Address`, `purchase_details`, `destination`) VALUES (DEFAULT,'".$_GET["id"]."', '".$_GET['lastname']."', '".$_GET['firstname']."', '".$_GET['address']."', '".$_GET['purchasedet']."', '".$_GET['destination']."')";
    $mysqli->query($insert);
}


if(isset($_GET['doctype']) && $_GET['doctype'] =="4")
$sql= "SELECT * FROM tbl_doctype4 WHERE request_id = '".$_GET["id"]."'";
$result = $mysqli->query($sql);
if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $update = "UPDATE `tbl_doctype4` SET `purpose` = '".$_GET['purpose']."' WHERE  request_id = ".$_GET['id']."";
    $mysqli->query($update);
}else{
    $insert = "INSERT INTO `tbl_doctype4` (`id`, `request_id`, `purpose`) VALUES (NULL, '".$_GET['id']."', '".$_GET["purpose"]."')";
    $mysqli->query($insert);
}
?>