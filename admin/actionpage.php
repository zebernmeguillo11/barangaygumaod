<?php
session_start();
include_once("connection.php");

if (isset($_GET["addtofamname"]) && isset($_GET["addtohouseno"])) {
    $query = "SELECT * FROM tbl_family WHERE houseNumber ='" . $_GET['addtohouseno'] . "'";
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) > 0) {
        echo "1";
    } else {
        $insertfamily = "INSERT INTO `tbl_family` (`householdName`, `houseNumber`, `purok`) VALUES ('" . $_GET["addtofamname"] . "', '" . $_GET["addtohouseno"] . "', '" . $_GET["addtopurok"] . "' )";
        $mysqli->query($insertfamily);
        echo "0";
    }

}

if (isset($_GET["addlast"]) && isset($_GET["addfirst"])) {
    $query = "SELECT * FROM tbl_resident WHERE Lastname ='" . $_GET['addlast'] . "' && Firstname = '" . $_GET["addfirst"] . "' && Middlename = '" . $_GET["addmiddle"] . "'";
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) > 0) {
        echo "1";
    } else {
        $insertres = "INSERT INTO `tbl_resident` (`resident_id`, `Lastname`, `Firstname`, `Middlename`, `Birthdate`, `Gender`, `houseNumber`, `m_status`) VALUES (DEFAULT, '" . $_GET["addlast"] . "', '" . $_GET["addfirst"] . "', '" . $_GET["addmiddle"] . "', '" . $_GET["addbday"] . "', '" . $_GET["addgender"] . "', DEFAULT, '" . $_GET["addmstatus"] . "')";
        $mysqli->query($insertres);
        echo "0";
    }

}

if (isset($_GET["deletehouseno"])) {
    $query = "DELETE FROM tbl_family WHERE houseNumber = '" . $_GET["deletehouseno"] . "'";
    $mysqli->query($query);
}

if (isset($_GET["deleteres"])) {
    $query = "DELETE FROM tbl_resident WHERE resident_id = '" . $_GET["deleteres"] . "'";
    $mysqli->query($query);
}

if (isset($_GET["updatename"]) && isset($_GET["houseupdate"])) {
    $update = "UPDATE tbl_family SET householdName = '" . $_GET["updatename"] . "', purok  = '" . $_GET["updatepurok"] . "' WHERE houseNumber = '" . $_GET["houseupdate"] . "'";

    $mysqli->query($update);
    echo $update;


}

if (isset($_GET["setpage"])) {
    $_SESSION['page'] = $_GET['setpage'];
}

if (isset($_GET["setpage1"])) {
    $_SESSION['page1'] = $_GET["setpage1"];
}

if (isset($_GET["addmedbrand"]) && isset($_GET["genname"])) {

    $sql = "INSERT INTO `tbl_medicine` (`medicine_id`, `brandname`, `genericname`, `quantity`, `unit`) VALUES (DEFAULT, '" . $_GET["addmedbrand"] . "', '" . $_GET["genname"] . "', '" . $_GET["quantity"] . "', '" . $_GET["unit"] . "')";
    $mysqli->query($sql);

}

if (isset($_GET["deletemed"])) {
    $query = "DELETE FROM tbl_medicine WHERE medicine_id = '" . $_GET["deletemed"] . "'";
    $mysqli->query($query);
}

if (isset($_GET["deleteofficial"])) {
    $query = "DELETE FROM tbl_officials WHERE id = '" . $_GET["deleteofficial"] . "'";
    $mysqli->query($query);
    echo $query;
}

if (isset($_GET['medid']) || isset($_GET['editbrand'])) {
    $sql = "UPDATE `tbl_medicine` SET `brandname` = '" . $_GET['editbrand'] . "', `genericname` = '" . $_GET['genname'] . "', `quantity` = '" . $_GET["quantity"] . "', `unit` = '" . $_GET["unit"] . "' WHERE `tbl_medicine`.`medicine_id` = '" . $_GET['medid'] . "'";
    $mysqli->query($sql);

}

if (isset($_GET['addtitle']) && isset($_GET['desc'])) {

    $img = "";
    if (isset($_SESSION['uploadimg'])) {
        $img = $_SESSION['uploadimg'];
    } else {
        $img = 'upload.png';
    }
    $sql = "INSERT INTO `tbl_announcement` (`id`, `title`, `description`, `date`, `img`) VALUES (DEFAULT, '" . $_GET['addtitle'] . "', '" . $_GET['desc'] . "', NOW(), '" . $img . "')";
    $mysqli->query($sql);
    unset($_SESSION["uploadimg"]);
}


if (isset($_GET['id']) && isset($_GET['edittitle'])) {

    $img = "";
    if (isset($_SESSION['editimg'])) {
        $img = $_SESSION['editimg'];
    } else {
        $img = 'upload.png';
    }
    $sql = "UPDATE `tbl_announcement` SET `title` = '" . $_GET['edittitle'] . "', `description` = '" . $_GET['desc'] . "', `img` = '" . $img . "' WHERE `tbl_announcement`.`id` = '" . $_GET['id'] . "'";
    $mysqli->query($sql);
    unset($_SESSION["uploadimg"]);
}

if (isset($_GET["deleteannid"])) {
    $query = "DELETE FROM tbl_announcement WHERE id = '" . $_GET["deleteannid"] . "'";
    $mysqli->query($query);
}
if (isset($_GET["oldpass"])) {
    $query = "SELECT * FROM tbl_account WHERE accountType = 1";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();
    $oldpass = $row["accountPassword"];
    $oldpass1 = trim($_GET['oldpass']);
    if ($oldpass != $oldpass1) {
        echo "1";
    } else {
        $sql = "UPDATE `tbl_account` SET `accountPassword` = '" . $_GET['newpass'] . "' WHERE `tbl_account`.`id` = '1'";
        $mysqli->query($sql);
    }
}

if(isset($_GET["resid"]) && isset($_GET["posid"])){
    $img = "";
    if (isset($_SESSION['officialimg'])) {
        $img = $_SESSION['officialimg'];
    } else {
        $img = 'upload.png';
    }
    $sql="INSERT INTO `tbl_officials` (`id`, `position_id`, `resident_id`, `img`) VALUES (DEFAULT, '".$_GET["posid"]."', '".$_GET["resid"]."', '".$img."')";
    $mysqli->query($sql);
    unset($_SESSION["officialimg"]);

    
}

if(isset($_GET["famid"]) && isset($_GET["resid"])){
    $sql = "INSERT INTO `tbl_familymember` (`id`, `houseNumber`, `resident_id`, `Position`) VALUES (DEFAULT, '".$_GET["famid"]."', '".$_GET["resid"]."', '".$_GET["pos"]."')";
    $mysqli->query($sql);
    echo $sql;
}

if(isset($_GET["deletemember"])){
    $sql = "DELETE FROM tbl_familymember WHERE id = '".$_GET["deletemember"]."'";
    $mysqli->query($sql);
}
?>