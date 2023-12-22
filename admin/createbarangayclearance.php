<?php
session_start();
include_once("connection.php");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
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

    #dropdown {
        background-color: rgb(220, 220, 220);
        height: 120px;
        overflow-y: scroll;
        display: none;
    }

    .dropdownlist:hover {
        background-color: white;
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
            <h5>Barangay Clearance</h5>

            <div class="row">
                <div class="col p-2 border border-dark rounded">
                    <div class="inputdiv container">
                        <label for="residentID" class="form-label">Search Resident</label>
                        <input type="text" class="form-control" id="residentID" placeholder="Search by Lastname"
                            onkeyup="showdropdown(this)" autocomplete="off">
                        <div id="dropdown">



                        </div>

                        <div class="invalid-feedback" id="fullnamefeed">
                            Required!
                        </div>
                        <input type="hidden" id="residentidhidden">
                    </div>

                    <div class="inputdiv container">
                        <label for="durationofstay" class="form-label">Duration of stay</label>
                        <input type="text" class="form-control w-100" id="durationofstay" required>
                        <div class="invalid-feedback" id="durationofstayfeed">
                            Required!
                        </div>
                    </div>
                    <div class="inputdiv container">
                        <label for="reasonofstay" class="form-label">Reason for stay</label>
                        <input type="text" class="form-control w-100" id="reasonofstay" required>
                        <div class="invalid-feedback" id="reasonofstayfeed">
                            Required!
                        </div>

                    </div>
                    <div class="inputdiv container">
                        <label for="birthplace" class="form-label">Birthplace</label>
                        <input type="text" class="form-control w-100" id="birthplace" required>
                        <div class="invalid-feedback" id="birthplacefeed">
                            Required!
                        </div>

                    </div>



                </div>

                <div class="col p-2 border border-dark rounded">



                    <div class="inputdiv container">
                        <label for="spouse" class="form-label">Spouse</label>
                        <input type="text" class="form-control w-100" id="spouse" required>
                        <div class="invalid-feedback" id="spousefeed">
                            Required!
                        </div>

                    </div>
                    <div class="inputdiv container">
                        <label for="parents" class="form-label">Parents</label>
                        <input type="text" class="form-control w-100" id="parents" required>
                        <div class="invalid-feedback" id="parentsfeed">
                            Required!
                        </div>

                    </div>
                    <div class="inputdiv container">
                        <label for="birthmark" class="form-label">Birthmark</label>
                        <input type="text" class="form-control w-100" id="birthmark" required>
                        <div class="invalid-feedback" id="birthmarkfeed">
                            Required!
                        </div>

                    </div>
                    <div class="inputdiv container">
                        <label for="purposeofclearance" class="form-label">Purpose</label>
                        <input type="text" class="form-control w-100" id="purposeofclearance" required>
                        <div class="invalid-feedback" id="purposeofclearancefeed">
                            Required!
                        </div>
                        <div class="col-12 text-right mt-2">
                            <button class="btn btn-dark" onclick="createbarangayclearance()">Procceed>></button>
                        </div>


                    </div>
                </div>

            </div>
        </div>


    </div>



    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery.js"></script>

    <script>

        function createbarangayclearance() {

            var durationofstay = document.getElementById("durationofstay").value;
            var reasonofstay = document.getElementById("reasonofstay").value;

            var birthplace = document.getElementById("birthplace").value;
            var spouse = document.getElementById("spouse").value;
            var parents = document.getElementById("parents").value;
            var birthmark = document.getElementById("birthmark").value;
            var purposeofclearance = document.getElementById("purposeofclearance").value;
            var resid =document.getElementById("residentidhidden").value;
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.href = "printbaragayclearance.php?id=" + this.responseText.trim();
                }
            };
            xhttps.open("GET", "createactionpage.php?doctype=2&resid=" + resid + "&durationofstay=" + durationofstay + "&reasonofstay=" + reasonofstay +
                "&birthplace=" + birthplace + "&spouse=" + spouse + "&parents=" + parents + "&birthmark=" + birthmark + "&purpose=" + purposeofclearance);
            xhttps.send();




        }

        function chooseres(e) {
            var fullname = document.getElementById("fullname" + e).innerHTML;
            document.getElementById("residentID").value = fullname.trim();
            document.getElementById("residentidhidden").value = e;

        }
        function showdropdown(e) {
            var searchkey = e.value;
            if (searchkey.length >= 2) {
                $("#dropdown").slideDown(400);
                var xhttps = new XMLHttpRequest();
                xhttps.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("dropdown").innerHTML = this.responseText;
                    }
                };
                xhttps.open("GET", "searchres2.php?searchkey=" + searchkey);
                xhttps.send();

            } else {
                $("#dropdown").slideUp(400);

            }
        }

        function logout() {
            var conf = confirm("Logout?");
            if (conf) {
                window.location.href = "logout.php";
            }
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