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
    echo $update;
}else{
    $insert = "INSERT INTO `tbl_doctype1` (`id`, `request_id`, `Lastname`, `Firstname`, `Address`, `purchase_details`, `destination`) VALUES (DEFAULT,'".$_GET["id"]."', '".$_GET['lastname']."', '".$_GET['firstname']."', '".$_GET['address']."', '".$_GET['purchasedet']."', '".$_GET['destination']."')";
    $mysqli->query($insert);
}
?>