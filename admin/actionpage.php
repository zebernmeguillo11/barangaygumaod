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

if(isset($_GET["deletehouseno"])){
    $query= "DELETE FROM tbl_family WHERE houseNumber = '".$_GET["deletehouseno"]."'";
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
?>