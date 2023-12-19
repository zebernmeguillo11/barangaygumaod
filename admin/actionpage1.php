<?php
session_start();
include_once("connection.php");

if (isset($_GET['doctype']) && $_GET['doctype'] == "1"){
    $sql = "SELECT * FROM tbl_doctype1 WHERE request_id = '" . $_GET["id"] . "'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    $update = "UPDATE `tbl_doctype1` SET `Lastname` = '" . $_GET['lastname'] . "', `Firstname` = '" . $_GET['firstname'] . "', `Address` = '" . $_GET['address'] . "', `purchase_details` = '" . $_GET['purchasedet'] . "', `destination` = '" . $_GET['destination'] . "' WHERE `tbl_doctype1`.`id` = '" . $row['id'] . "'";
    $mysqli->query($update);
} else {
    $insert = "INSERT INTO `tbl_doctype1` (`id`, `request_id`, `Lastname`, `Firstname`, `Address`, `purchase_details`, `destination`) VALUES (DEFAULT,'" . $_GET["id"] . "', '" . $_GET['lastname'] . "', '" . $_GET['firstname'] . "', '" . $_GET['address'] . "', '" . $_GET['purchasedet'] . "', '" . $_GET['destination'] . "')";
    $mysqli->query($insert);
}
}

if (isset($_GET['doctype']) && $_GET['doctype'] == "4") {
    $sql = "SELECT * FROM tbl_doctype4 WHERE request_id = '" . $_GET["id"] . "'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $update = "UPDATE `tbl_doctype4` SET `purpose` = '" . $_GET['purpose'] . "' WHERE  request_id = " . $_GET['id'] . "";
        $mysqli->query($update);
    } else {
        $insert = "INSERT INTO `tbl_doctype4` (`id`, `request_id`, `purpose`) VALUES (NULL, '" . $_GET['id'] . "', '" . $_GET["purpose"] . "')";
        $mysqli->query($insert);
    }
}

if (isset($_GET['doctype']) && $_GET['doctype'] == "2") {
    $sql = "SELECT * FROM tbl_doctype2 WHERE request_id = '" . $_GET["id"] . "'";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        $update = "UPDATE `tbl_doctype2` SET `time_of_stay` = '".$_GET['durationofstay']."', `reason` = '".$_GET['reasonofstay']."', `bplace` = '".$_GET['birthplace']."', `spouse` = '".$_GET['spouse']."', `parents` = '".$_GET['parents']."', `bmark` = '".$_GET['birthmark']."', `purpose` = '".$_GET['purpose']."' WHERE request_id = '".$_GET["id"]."'";
        $mysqli->query($update);
    } else {
        $insert = "INSERT INTO `tbl_doctype2` (`id`, `request_id`, `time_of_stay`, `reason`, `bplace`, `spouse`, `parents`, `bmark`, `purpose`) VALUES (DEFAULT,'".$_GET["id"]."', '".$_GET['durationofstay']."', '".$_GET['reasonofstay']."', '".$_GET['birthplace']."', '".$_GET['spouse']."', '".$_GET['parents']."', '".$_GET['birthmark']."', '".$_GET['purpose']."')";
        $mysqli->query($insert);
    }
}

?>