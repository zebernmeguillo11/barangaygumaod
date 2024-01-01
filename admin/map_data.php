<?php
include_once("connection.php");
$sql = "SELECT * FROM tbl_coordinates";
$result = $mysqli -> query($sql);
$data = $result -> fetch_all(MYSQLI_ASSOC);
echo json_encode($data);

?>
