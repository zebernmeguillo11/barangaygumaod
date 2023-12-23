<?php
session_start();
include_once("connection.php");

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

    .zoneoptions button {
        font-size: 12px;
        width: 100%;
        margin-top: 2px;
    }

    .zoneoptions {
        display: none;
    }

    .zoneoptions button:hover {
        background-color: rgb(80, 100, 80);
        color: white;
    }

    .zonenav {
        margin: 15px auto;
        box-shadow: 0px 0px 10px black;
        padding: 10px 0px;
        background-color: rgb(50, 120, 50);
        color: white;
        text-align: center;

    }



    .zonenav:hover {
        cursor: pointer;
        background-color: white;
        color: black;
        transition: 0.7s;
    }

    .puroknavigator {
        position: fixed;
        right: 4%;
        top: 7%;
        width: 8%;
        height: 90vh;
    }

    .householder {
        overflow-y: scroll;
        height: 90vh;
        box-shadow: -2px -2px 2px black;
        background-color: rgb(100, 150, 100);


    }

    #myCanvas {
        height: 90vh;
        background-image: url("img/map1.png");
        background-size: contain;
        background-repeat: no-repeat;
        box-shadow: -2px -2px 2px black;
    }

    .house {
        box-shadow: 0px 0px 2px black;
        height: 25%;
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
    }

    #logoutbtn {
        transform: rotate(180deg);
    }
</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home" onClick="location.href='dashboard.php'"><img
                src="img/homepage.png" class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onClick="logout()"><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
    </div>

    <div class="main container">
        <h1 class="w-100 text-center">Interactive Map</h1>
        <div class="row container" >

          

        </div>
    </div>


</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="canvas.js"></script>


<script>


    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }



    function expandandchange(x) {
        $(".zoneoptions").slideUp(500);
        $("#zoneoption" + x).slideDown(500);
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("housenavholder").innerHTML = this.responseText;
            }
        };
        xhttps.open("GET", "getzone.php?zone=" + x);
        xhttps.send();

    }

    function checkradio(x){
        $(".house").css("background-color","#FFC5C5");
        $("#houseno-"+x).css("background-color","rgb(120,40,40)");
        $("#houseno-"+x).css("color","white");
        var radiobutt =document.getElementById("houseselector-" + x);
        radiobutt.checked = true;

    }





</script>

</html>