<?php
session_start();
include_once("admin/connection.php");

if (isset($_GET['doctype']) && $_GET['doctype'] == "1") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (NULL, '1', '" . $_GET['resid'] . "', NOW(), '0000', '0')";
    $mysqli->query($insert);
    $lastid = mysqli_insert_id($mysqli);
    $insert1 = "INSERT INTO `tbl_doctype1` (`id`, `request_id`, `Lastname`, `Firstname`, `Address`, `purchase_details`, `destination`) VALUES (DEFAULT,'" . $lastid . "', '" . $_GET['lastname'] . "', '" . $_GET['firstname'] . "', '" . $_GET['address'] . "', '" . $_GET['purchasedet'] . "', '" . $_GET['destination'] . "')";
    $mysqli->query($insert1);
    echo $lastid;
}

if (isset($_GET['doctype']) && $_GET['doctype'] == "3") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (NULL, '3', '" . $_GET['resid'] . "', NOW(), '0000', '0')";
    $mysqli->query($insert);
    $lastid = mysqli_insert_id($mysqli);
    echo $lastid;
}

if (isset($_GET['doctype']) && $_GET['doctype'] == "4") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (NULL, '4', '" . $_GET['resid'] . "', NOW(), '0000', '0')";
    $mysqli->query($insert);
    $lastid = mysqli_insert_id($mysqli);
    $insert1 = "INSERT INTO `tbl_doctype4` (`id`, `request_id`, `purpose`) VALUES (NULL, '" . $lastid . "', '" . $_GET["purpose"] . "')";
    $mysqli->query($insert1);
    echo $lastid;


}

if (isset($_GET['doctype']) && $_GET['doctype'] == "2") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (NULL, '2', '" . $_GET['resid'] . "', NOW(), '0000', '0')";
    $mysqli->query($insert);
    $lastid = mysqli_insert_id($mysqli);
    $insert1 = "INSERT INTO `tbl_doctype2` (`id`, `request_id`, `time_of_stay`, `reason`, `bplace`, `spouse`, `parents`, `bmark`, `purpose`) VALUES (DEFAULT,'" . $lastid . "', '" . $_GET['durationofstay'] . "', '" . $_GET['reasonofstay'] . "', '" . $_GET['birthplace'] . "', '" . $_GET['spouse'] . "', '" . $_GET['parents'] . "', '" . $_GET['birthmark'] . "', '" . $_GET['purpose'] . "')";
    $mysqli->query($insert1);
    echo $lastid;

}

if (isset($_GET['doctype']) && $_GET['doctype'] == "7") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (NULL, '7', '" . $_GET['resid'] . "', NOW(), '0000', '0')";
    $mysqli->query($insert);
    $lastid = mysqli_insert_id($mysqli);
    $insert1 = "INSERT INTO `tbl_doctype7` (`id`, `request_id`, `purpose`) VALUES (NULL, '" . $lastid . "', '" . $_GET["purpose"] . "')";
    $mysqli->query($insert1);
    echo $lastid;
}


if (isset($_GET['doctype']) && $_GET['doctype'] == "8") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (NULL, '8', '" . $_GET['resid'] . "', NOW(), '0000', '0')";
    $mysqli->query($insert);
    $lastid = mysqli_insert_id($mysqli);
    $insert1 = "INSERT INTO `tbl_doctype8` (`id`, `request_id`, `variety`, `location`, `purpose`) VALUES (NULL, '" . $lastid . "', '" . $_GET["variety"] . "', '" . $_GET["location"] . "', '" . $_GET["purpose"] . "')";
    $mysqli->query($insert1);
    echo $lastid;


}


?>