<?php
session_start();
require_once("connection.php");
    $test = explode(".", $_FILES['file']['name']);
    $extension = end($test);
    $name = uniqid();
    $newname = $name . "." . $extension;
    $location = "gallery/" . $newname;

    $_SESSION['galleryimage'] = $newname;
    

    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    echo "<img src='" . $location . "' class='img-thumbnail img-fluid ml-4' id='addofficialimg'>";

?>