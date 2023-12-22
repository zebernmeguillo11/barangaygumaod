<?php
session_start();
include_once("connection.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Document - Animal Transport</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
    body {
        background-color: #FFC5C5;

    }

    .section1 {
        background-color: #00A1A1;
        box-shadow: 2px 2px 2px black;
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
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onclick="logout()"><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
    </div>
    <h4 class="w-100 text-center mt-4">Create Document</h4>

    <div class="container">


        <div class="section1 p-4">
            <h5>Animal Transport</h5>

            <div class="row">

                <div class="col p-2 border border-dark rounded">
                    <h6>Buyer's Information</h6>
                    <div class="inputdiv container">
                        <label for="buyerlastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control w-100" id="buyerlastname" required>
                        <div class="invalid-feedback" id="buyerlastnamefeed">
                            Required!
                        </div>

                    </div>
                    <div class="inputdiv container">
                        <label for="buyerfirstname" class="form-label">Firstname</label>
                        <input type="text" class="form-control w-100" id="buyerfirstname" required>
                        <div class="invalid-feedback" id="buyerfirstnamefeed">
                            Required!
                        </div>
                    </div>
                    <div class="inputdiv container">
                        <label for="buyeraddress" class="form-label">Address</label>
                        <textarea type="text" class="form-control w-100" id="buyeraddress" required></textarea>
                        <div class="invalid-feedback" id="buyeraddressfeed">
                            Required!
                        </div>
                    </div>

                </div>
                <div class="col p-2 border border-dark rounded">
                    <h6>Purchase Information</h6>
                    <div class="inputdiv container">
                        <label for="purchasedetails" class="form-label">Purchase Details</label>
                        <textarea type="text" class="form-control w-100" id="purchasedetails" required></textarea>
                        <div class="invalid-feedback" id="purchasedetailsfeed">
                            Required!
                        </div>
                    </div>
                    <div class="inputdiv container">
                        <label for="destinationdetail" class="form-label">Destination</label>
                        <textarea type="text" class="form-control w-100" id="destinationdetail" required></textarea>
                        <div class="invalid-feedback" id="destinationdetailfeed">
                            Required!
                        </div>
                    </div>
                    <div class="col-12 text-right mt-2">
                        <button class="btn btn-dark" onclick="createanimaltransportdoc()">Procceed>></button>
                    </div>



                </div>
            </div>
        </div>
    </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script>
    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }

    function createanimaltransportdoc() {

    }

    function createanimaltransportdoc() {
        var lastname = document.getElementById("buyerlastname").value;
        var firstname = document.getElementById("buyerfirstname").value;
        var address = document.getElementById("buyeraddress").value;
        var details = document.getElementById("purchasedetails").value;
        var destination = document.getElementById("destinationdetail").value;
        if (lastname.trim() == "" || firstname.trim() == "" || address.trim() == "" || details.trim() == "" || destination.trim() == "") {
            if (lastname.trim() == "") {
                $("#buyerlastnamefeed").css('display', 'inline-block');
            }
            if (lastname.trim() == "") {
                $("#buyerfirstnamefeed").css('display', 'inline-block');
            }
            if (lastname.trim() == "") {
                $("#buyeraddressfeed").css('display', 'inline-block');
            }
            if (lastname.trim() == "") {
                $("#purchasedetailsfeed").css('display', 'inline-block');
            }
            if (lastname.trim() == "") {
                $("#destinationdetailfeed").css('display', 'inline-block');
            }
        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    window.location.href = "printanimaltransport.php?id=" + this.responseText.trim();

                }
            };
            xhttps.open("GET", "createactionpage.php?doctype=1&lastname=" + lastname + "&firstname=" + firstname + "&address=" + address + "&purchasedet=" + details + "&destination=" + destination);
            xhttps.send();

        }




    }



</script>

</html>