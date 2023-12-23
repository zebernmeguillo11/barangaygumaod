<?php
session_start();
include_once("connection.php");

$query = "INSERT INTO `tbl_picturegallery` (`id`, `picture_source`) VALUES (NULL, '" . $_SESSION["galleryimage"] . "')";
$mysqli->query($query);

unset($_SESSION["galleryimage"]);
?>