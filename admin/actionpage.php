<?php
session_start();
include_once("connection.php");

if(isset($_GET["addtofamname"]) && isset($_GET["addtohouseno"])){
    $query="SELECT * FROM tbl_family WHERE houseNumber ='".$_GET['addtohouseno']."'";
    $result = $mysqli->query($query);
    if(mysqli_num_rows($result)>0){
        echo "1";
    }else{
        $insertfamily = "INSERT INTO `tbl_family` (`householdName`, `houseNumber`, `purok`) VALUES ('".$_GET["addtofamname"]."', '".$_GET["addtohouseno"]."', '".$_GET["addtopurok"]."' )";
        $mysqli->query($insertfamily);
        echo "0";
    }
    
}

if(isset($_GET["addlast"]) && isset($_GET["addfirst"])){
    $query="SELECT * FROM tbl_resident WHERE Lastname ='".$_GET['addlast']."' && Firstname = '".$_GET["addfirst"]."' && Middlename = '".$_GET["addmiddle"]."'";
    $result = $mysqli->query($query);
    if(mysqli_num_rows($result)>0){
        echo "1";
    }else{
        $insertres = "INSERT INTO `tbl_resident` (`resident_id`, `Lastname`, `Firstname`, `Middlename`, `Birthdate`, `Gender`, `houseNumber`, `m_status`) VALUES (DEFAULT, '".$_GET["addlast"]."', '".$_GET["addfirst"]."', '".$_GET["addmiddle"]."', '".$_GET["addbday"]."', '".$_GET["addgender"]."', DEFAULT, '".$_GET["addmstatus"]."')";
        $mysqli->query($insertres);
        echo "0";
    }
    
}

if(isset($_GET["deletehouseno"])){
    $query= "DELETE FROM tbl_family WHERE houseNumber = '".$_GET["deletehouseno"]."'";
    $mysqli->query($query);
}

if(isset($_GET["deleteres"])){
    $query= "DELETE FROM tbl_resident WHERE resident_id = '".$_GET["deleteres"]."'";
    $mysqli->query($query);
}

if(isset($_GET["updatename"]) && isset($_GET["houseupdate"])){
    $update = "UPDATE tbl_family SET householdName = '".$_GET["updatename"]."', purok  = '".$_GET["updatepurok"]."' WHERE houseNumber = '".$_GET["houseupdate"]."'";
        
        $mysqli->query($update);
        echo $update;
    
    
}

if(isset($_GET["setpage"])){
$_SESSION['page'] = $_GET['setpage'];
}

if(isset($_GET["setpage1"])){
    $_SESSION['page1'] = $_GET["setpage1"];
    }
?>