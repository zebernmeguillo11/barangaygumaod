<?php
session_start();
include_once("connection.php");
if (isset($_GET['doctype']) && $_GET['doctype'] == "1") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (DEFAULT, '1', '0', NOW(), '0000', '1')";
    $mysqli->query($insert);
    $last_id = mysqli_insert_id($mysqli);

    $insert = "INSERT INTO `tbl_doctype1` (`id`, `request_id`, `Lastname`, `Firstname`, `Address`, `purchase_details`, `destination`) VALUES (DEFAULT,'" . $last_id . "', '" . $_GET['lastname'] . "', '" . $_GET['firstname'] . "', '" . $_GET['address'] . "', '" . $_GET['purchasedet'] . "', '" . $_GET['destination'] . "')";
    $mysqli->query($insert);
    echo $last_id;

}

if (isset($_GET['doctype']) && $_GET['doctype'] == "2") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (DEFAULT, '2', '" . $_GET["resid"] . "', NOW(), '0000', '1')";
    $mysqli->query($insert);
    $last_id = mysqli_insert_id($mysqli);


    $insert = "INSERT INTO `tbl_doctype2` (`id`, `request_id`, `time_of_stay`, `reason`, `bplace`, `spouse`, `parents`, `bmark`, `purpose`) VALUES (DEFAULT,'" . $last_id . "', '" . $_GET['durationofstay'] . "', '" . $_GET['reasonofstay'] . "', '" . $_GET['birthplace'] . "', '" . $_GET['spouse'] . "', '" . $_GET['parents'] . "', '" . $_GET['birthmark'] . "', '" . $_GET['purpose'] . "')";
    $mysqli->query($insert);
    echo $last_id;

}

if (isset($_GET['doctype']) && $_GET['doctype'] == "3") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (DEFAULT, '3', '" . $_GET["resid"] . "', NOW(), '0000', '1')";
    $mysqli->query($insert);
    $last_id = mysqli_insert_id($mysqli);
    echo $last_id;

}


if (isset($_GET['doctype']) && $_GET['doctype'] == "4") {
    $insert = "INSERT INTO `tbl_docrequest` (`id`, `document_type`, `resident_id`, `date`, `contactno`, `is_processed`) VALUES (DEFAULT, '4', '" . $_GET["resid"] . "', NOW(), '0000', '1')";
    $mysqli->query($insert);
    $last_id = mysqli_insert_id($mysqli);

    $insert = "INSERT INTO `tbl_doctype4` (`id`, `request_id`, `purpose`) VALUES (NULL, '" . $last_id . "', '" . $_GET["purpose"] . "')";
    $mysqli->query($insert);
    echo $last_id;
}
?>