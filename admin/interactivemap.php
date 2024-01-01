<?php
session_start();
include_once("connection.php");
if (!isset($_SESSION["auth"])) {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Map</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
    .house {
        background-color: #FFC5C5;

    }

    body {
        background-color: #FFC5C5;

    }
    .marker-desc{
    width: 300px;
    min-height: 40px;
    text-align: justify;
    color: #333;
    font-size: 14px;
  }






    .main {
        height: 100vh;
    }

    .nav {
        width: 4%;
        padding: 0px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: white;
        z-index: 2;
    }

    #logoutbtn {
        transform: rotate(180deg);
    }

    #map {
        position: fixed;
        height: 100vh;
        z-index: 1;
        top: 0;
        left: 0; 
    }

    h1 {
        position: fixed;
        z-index: 2;
    }
</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home" onClick="location.href='dashboard.php'"><img
                src="img/homepage.png" class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onClick="logout()"><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
        <div class="controlbbar" id="controlbar" onclick="addhouseenable()">
            <input type="checkbox" id="addhousecheckbox" style="display: none;">
            <img src="img/addhouse.png" alt="" class="img-thumbnail img-fluid" id="addhouseimg">

        </div>
    </div>




    <h2 class="w-100 text-center">Interactive Map</h2   >

    <div id="map">

    </div>


</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script
    src="https://maps.googleapis.com/maps/api/js?KEY=AIzaSyDRSYAAW1yoCMMxYuPcz0nr2_Is7K-b_A4&map_ids=4c3a2990a9d5267d&callback=initMap">
    </script>
<script type="text/javascript" src="map.js"></script>


<script>


    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }

    function addhouseenable(){

       if(document.getElementById("addhousecheckbox").checked){
        document.getElementById("addhousecheckbox").checked=false;
        document.getElementById("addhouseimg").src="img/addhouse1.png";
        $("#map").css("cursor", "crosshair");
       }else{
        document.getElementById("addhousecheckbox").checked=true;
        document.getElementById("addhouseimg").src="img/addhouse.png";
        $("#map").css("cursor", "auto");


       }
    }








</script>

</html>