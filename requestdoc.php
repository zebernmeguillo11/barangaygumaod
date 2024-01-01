<?php
include_once("admin/connection.php");
$sql = "SELECT * FROM tbl_announcement ORDER by date DESC LIMIT 10";
$result = $mysqli->query($sql);

$date = date('Y-m-d', strtotime('-7 days'));

$sql1 = "SELECT * FROM tbl_announcement WHERE date > '".$date."'";
$result1 = $mysqli->query($sql1);
$noofevent = mysqli_num_rows($result1);
$noofevents = "";
if($noofevent == 0){
    $noofevents = "";
}else{
    $noofevents= $noofevent;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Gumaod Page</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<style>
    html {
        box-sizing: border-box;
        font-size: 100%;
    }

    *,
    *::before,
    *::after {
        box-sizing: inherit;
    }

    body {
        margin: 0;
        padding: 0;

    }

    #notif{
        color: white;
        background-color: red;
        text-shadow: none;
        font-size: 12px;
        padding: 1px;
    }

    .navsection ul li {
        list-style: none;
        background-color: transparent;
        color: white;
        font-family: "Lucida Console", "Courier New", monospace;
        padding: 0 20px;
    }

    .navsection ul li:hover a {
        color: black;
        text-shadow: none;
        text-decoration: none;
        text-shadow: none;
        transition: all 0.5s ease;

    }

    .navsection ul li:hover {
        background-color: white;
        color: black;
        text-shadow: none;
        text-decoration: none;
        text-shadow: none;
        transition: all 0.5s ease;

    }

    .section {
        height: 100vh;

    }

    .navsection ul li a {
        color: white;
        text-shadow: 2px 2px 2px rgb(20, 80, 20);
        font-size: 14px;


    }





    .section1 {

        width: 50%;
        background-color: #013220;
        color: white;
        margin-top: 10%;
        box-shadow: 4px 4px 4px rgba(90, 120, 90, 0.8);
        overflow-y: scroll;
        height: 95%;

    }

    .gender {
        background-color: rgba(255, 255, 255, 0.7);
    }



    .main ul li {
        list-style: none;
        padding-top: 5px;
        padding-bottom: 5px;

    }




    .navsection {
        position: sticky;
        top: -6%;
        left: 0%;
        background-color: rgb(70, 100, 70);
        z-index: 3;

        &.scrolled {
            opacity: 0;
            transition: all 1s ease;


            &:hover {
                opacity: 1;
            }
        }

    }

    .stepholder div {
        margin: 0px;
        width: 49.6%;
        display: inline-block;
        text-align: center;

        &.active {
            background-color: white;
            color: black;
            transition: all 1s ease;
        }
    }

    .main {
        background-image:
            linear-gradient(to bottom, rgba(160, 200, 160, 0.2), rgba(0, 0, 0, 1)), url('admin/img/bg.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 101.1%;
        height: 90vh;
        padding-top: 10%;


    }


    .sidebar {
        background-color: white;
        box-shadow: 2px 2px 2px black;
    }

    .lastname label {
        font-weight: bold;
    }

    .dropdown {
        overflow-y: scroll;
        display: none;
        height: 100px;
    }

    .step1div {
        padding-bottom: 5%;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        color: black;
        height: 100%;


    }

    .step2div {
        padding-bottom: 5%;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        color: black;



    }

    .addinfo {
        display: none;
    }
</style>

<body>
    <div class="row pt-4 pb-0  navsection">
        <div class="col-3">

        </div>
        <ul class="col-9 row mb-0 nav mt-4">
            <li class="col m-1  text-center p-1 py-2"><a href="index.php">Home</a></li>
            <li class="col m-1 text-center p-1 py-2"><a href="barangayofficials.php">Barangay Officials</a></li>
            <li class="col m-1 rounded text-center p-1"><a href="events.php">Events<sub id="notif"><?php echo $noofevents; ?></sub></a></li>

            <li class="col m-1  text-center p-1 py-2"><a href="requestdoc.php">Request Document</a></li>
            <li class="col m-1  text-center p-1 py-2"><a href="interactivemap.html">Barangay Map</a></li>
        </ul>
    </div>
    <div>
        <div class="main">
            <div class="section1 m-auto rounded">
                <h4 class=" text-center py-2">Request Document</h4>
                <div class="w-100 stepholder mb-0">
                    <div class="active" id="step1" style="border-top-right-radius: 5px; height: 100%;">Step 1</div>
                    <div id="step2" style="border-top-left-radius: 5px; height: 100%;">Step 2</div>
                </div>
                <div class="step1div mt-0" style="background-color: white; margin-top: -5%;">

                    <h6 class="w-100 text-center pt-3">Type of Document</h6>
                    <div class="d-flex align-content-center justify-content-center">
                        <div class=" w-75 d-flex align-content-center justify-content-start">
                            <ul class="w-50 align-content-center">
                                <li><input type="radio" name="typeofdoc" class="typeofdoc" value="2"
                                        onclick="enablebutton(this.value)"> Barangay Clearance
                                </li>
                                <li><input type="radio" name="typeofdoc" class="typeofdoc" value="9"
                                        onclick="enablebutton(this.value)"> Barangay
                                    Certification
                                </li>
                                <li><input type="radio" name="typeofdoc" class="typeofdoc" value="3"
                                        onclick="enablebutton(this.value)"> Certificate of
                                    Indigency</li>
                                <li><input type="radio" name="typeofdoc" class="typeofdoc" value="8"
                                        onclick="enablebutton(this.value)"> Wood Cutting
                                    Permit
                                </li>
                                <li><input type="radio" name="typeofdoc" class="typeofdoc" value="7"
                                        onclick="enablebutton(this.value)"> Good Moral
                                    Certificate
                                </li>
                                <li><input type="radio" name="typeofdoc" class="typeofdoc" value="4"
                                        onclick="enablebutton(this.value)"> Certificate of
                                    Residency</li>
                                <li><input type="radio" name="typeofdoc" class="typeofdoc" value="1"
                                        onclick="enablebutton(this.value)"> Animal Transport
                                    Certificate</li>

                            </ul>


                        </div>
                    </div>
                    <div class="w-100 text-center">
                        <button class="btn btn-info" id="submitbtn" disabled
                            onclick="showform(this.value)">Next>></button>

                    </div>
                </div>
                <div class="step2div" style="background-color: white; display: none">
                    <h6 class="w-100 text-center pt-4">Requestor's Information</h6>
                    <div class="d-flex align-content-center justify-content-center">
                        <label for="lastname" class="form-label w-50">Search your name<span style="color: red;">*</span>
                            <input type="text" name="lastname" id="lastname" placeholder="Enter lastname"
                                class="form-control" onkeyup="showdropdown(this)" required></label>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback" id="resfeedback">Please fill out this field.</div>
                    </div>
                    <div class="dropdown mx-auto w-50" id="dropdown">

                    </div>
                    <input type="hidden" id="residentidhidden" value="0">
                    <hr>
                    <div class="additionalinfo1 addinfo">
                        <h6 class="w-100 text-center">Livestock Buyer's Information</h6>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="buyerlastname" class="form-label">Lastname
                            </label>
                            <input type="text" class="form-control w-100" id="buyerlastname" required>
                            <div class="invalid-feedback" id="brandnamefeed">
                                Required!
                            </div>
                        </div>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="buyerfirstname" class="form-label">Firstname</label>
                            <input type="text" class="form-control w-100" id="buyerfirstname" required>
                            <div class="invalid-feedback" id="buyerfirstnamefeed">
                                Required!
                            </div>
                        </div>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="buyeraddress" class="form-label">Address</label>
                            <textarea type="text" class="form-control w-100" id="buyeraddress" required></textarea>
                            <div class="invalid-feedback" id="buyeraddressfeed">
                                Required!
                            </div>
                        </div>
                        <h6 class="w-100 text-center">Purchase Information</h6>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="purchasedetails" class="form-label">Purchase Details</label>
                            <textarea type="text" class="form-control w-100" id="purchasedetails" required></textarea>
                            <div class="invalid-feedback" id="purchasedetailsfeed">
                                Required!
                            </div>
                        </div>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="destinationdetail" class="form-label">Destination</label>
                            <textarea type="text" class="form-control w-100" id="destinationdetail" required></textarea>
                            <div class="invalid-feedback" id="destinationdetailfeed">
                                Required!
                            </div>
                        </div>

                    </div>
                    <div class="additionalinfo2 addinfo ">
                        <h6 class="w-100 text-center">Barangay Clearance</h6>
                        <div class="inputdiv container  w-50 m-auto">
                            <label for="durationofstay" class="form-label">Duration of stay</label>
                            <input type="text" class="form-control w-100" id="durationofstay" required>
                            <div class="invalid-feedback" id="durationofstayfeed">
                                Required!
                            </div>
                        </div>
                        <div class="inputdiv container  w-50 m-auto">
                            <label for="reasonofstay" class="form-label">Reason for stay</label>
                            <input type="text" class="form-control w-100" id="reasonofstay" required>
                            <div class="invalid-feedback" id="reasonofstayfeed">
                                Required!
                            </div>

                        </div>
                        <div class="inputdiv container  w-50 m-auto">
                            <label for="birthplace" class="form-label">Birthplace</label>
                            <input type="text" class="form-control w-100" id="birthplace" required>
                            <div class="invalid-feedback" id="birthplacefeed">
                                Required!
                            </div>

                        </div>
                        <div class="inputdiv container  w-50 m-auto">
                            <label for="spouse" class="form-label">Spouse</label>
                            <input type="text" class="form-control w-100" id="spouse" required>
                            <div class="invalid-feedback" id="spousefeed">
                                Required!
                            </div>

                        </div>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="parents" class="form-label">Parents</label>
                            <input type="text" class="form-control w-100" id="parents" required>
                            <div class="invalid-feedback" id="parentsfeed">
                                Required!
                            </div>

                        </div>
                        <div class="inputdiv container  w-50 m-auto">
                            <label for="birthmark" class="form-label">Birthmark</label>
                            <input type="text" class="form-control w-100" id="birthmark" required>
                            <div class="invalid-feedback" id="birthmarkfeed">
                                Required!
                            </div>

                        </div>
                        <div class="inputdiv container  w-50 m-auto">
                            <label for="purposeofclearance" class="form-label">Purpose</label>
                            <input type="text" class="form-control w-100" id="purposeofclearance" required>
                            <div class="invalid-feedback" id="purposeofclearancefeed">
                                Required!
                            </div>



                        </div>


                    </div>
                    <div class="additionalinfo4 addinfo">
                        <h6 class="w-100 text-center">Certificate of Residency</h6>
                        <div class="inputdiv container  w-50 m-auto">
                            <label for="purposeofdoc" class="form-label">Purpose of Document</label>
                            <input type="text" class="form-control w-100" id="purposeofdoc" required>
                            <div class="invalid-feedback" id="purposeofdocfeed">
                                Required!
                            </div>
                        </div>

                    </div>
                    <div class="additionalinfo7 addinfo">
                        <h6 class="w-100 text-center">Good Moral Certificate</h6>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="purposeofdoc1" class="form-label">This Good Moral Certificate is a
                                Requirement
                                For</label>
                            <input type="text" class="form-control w-100" id="purposeofdoc1" required>
                            <div class="invalid-feedback" id="purposeofdoc1feed">
                                Required!
                            </div>
                        </div>

                    </div>
                    <div class="additionalinfo8 addinfo">
                        <h6 class="w-100 text-center">Wood Cutting Permit</h6>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="treename" class="form-label">Tree Variety</label>
                            <input type="text" class="form-control w-100" id="treename" required>
                            <div class="invalid-feedback" id="treenamefeed">
                                Required!
                            </div>
                        </div>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="treelocation" class="form-label">Tree Location
                            </label>
                            <input type="text" class="form-control w-100" id="treelocation" required>
                            <div class="invalid-feedback" id="treelocationfeed">
                                Required!
                            </div>
                        </div>
                        <div class="inputdiv container w-50 m-auto">
                            <label for="purpose" class="form-label">Purpose
                            </label>
                            <input type="text" class="form-control w-100" id="purpose" required>
                            <div class="invalid-feedback" id="purposefeed">
                                Required!
                            </div>
                        </div>

                    </div>
                    <div class="d-flex align-content-center justify-content-center">
                        <button class="btn btn-info w-25 mt-2" style="float: right;" id="submitdetailsbtn"
                            onclick="submitrequest(this.value)">Submit</button>
                    </div>
                </div>


            </div>






        </div>

    </div>


    </div>

</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="admin/jquery.js"></script>


<script>
    $(document).ready(function () {


        $(window).scroll(function () {

            if ($(window).scrollTop() > 50) {
                $('.navsection').addClass('scrolled');
            } else {
                $('.navsection').removeClass('scrolled');
            };
        });
    });

    function enablebutton(x) {

        document.getElementById("submitbtn").disabled = false;
        document.getElementById("submitbtn").value = x;
        document.getElementById("submitdetailsbtn").value = x;

    }

    function showform(x) {
        $(".step1div").slideUp(500);
        $(".step2div").slideDown(500);
        $("#step1").removeClass("active");
        $("#step2").addClass("active");
        $(".additionalinfo" + x).css("display", "block")



    }

    function procceedanimaltransport(id) {

        var lastname = document.getElementById("buyerlastname").value;
        var firstname = document.getElementById("buyerfirstname").value;
        var address = document.getElementById("buyeraddress").value;
        var details = document.getElementById("purchasedetails").value;
        var destination = document.getElementById("destinationdetail").value;
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = "submitrequest.php?id=" + this.responseText;


            }
        };
        xhttps.open("GET", "actionpage1.php?doctype=1&resid=" + id + "&lastname=" + lastname + "&firstname=" + firstname + "&address=" + address + "&purchasedet=" + details + "&destination=" + destination);
        xhttps.send();


    }

    function indigency(id) {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = "submitrequest.php?id=" + this.responseText;


            }
        };
        xhttps.open("GET", "actionpage1.php?doctype=3&resid=" + id);
        xhttps.send();


    }


    function proceedbarangayclearance(id) {
        var durationofstay = document.getElementById("durationofstay").value;
        var reasonofstay = document.getElementById("reasonofstay").value;
        var birthplace = document.getElementById("birthplace").value;
        var spouse = document.getElementById("spouse").value;
        var parents = document.getElementById("parents").value;
        var birthmark = document.getElementById("birthmark").value;
        var purposeofclearance = document.getElementById("purposeofclearance").value;
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = "submitrequest.php?id=" + this.responseText;

            }
        };
        xhttps.open("GET", "actionpage1.php?doctype=2&resid=" + id + "&durationofstay=" + durationofstay + "&reasonofstay=" + reasonofstay +
            "&birthplace=" + birthplace + "&spouse=" + spouse + "&parents=" + parents + "&birthmark=" + birthmark + "&purpose=" + purposeofclearance);
        xhttps.send();

    }

    function residency(id) {
        var purpose = document.getElementById("purposeofdoc").value;
        if (purpose.trim() == "") {
            $("#purposeofdocfeed").css("display", "inline-block");

        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.href = "submitrequest.php?id=" + this.responseText;

                }
            };
            xhttps.open("GET", "actionpage1.php?doctype=4&resid=" + id + "&purpose=" + purpose);
            xhttps.send();


        }

    }

    function submitrequest(x) {
        var id = document.getElementById("residentidhidden").value;
        var typeofdoc = 0;
        if (id == "0") {
            alert("Please choose your name from dropdown results.");

        } else {
            if (x == 1) {
                procceedanimaltransport(id);
            }
            if (x == 2) {
                proceedbarangayclearance(id);
            }
            if (x == 3) {
                indigency(id);
            }

            if (x == 4) {
                residency(id);
            }

            if (x == 7) {
                proceedgoodmoral(id);
            }

            if (x == 8) {
                proceedwoodcutting(id);
            }


        }

    }

    function proceedwoodcutting(id) {
        var treename = document.getElementById("treename").value;
        var treelocation = document.getElementById("treelocation").value;
        var purpose = document.getElementById("purpose").value;
        var xhttps = new XMLHttpRequest();

        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = "submitrequest.php?id=" + this.responseText;

            }

        };
        xhttps.open("GET", "actionpage1.php?doctype=8&resid=" + id + "&purpose=" + purpose + "&variety=" + treename + "&location=" + treelocation);
        xhttps.send();

    }
    function proceedgoodmoral(id) {
        var purpose = document.getElementById("purposeofdoc1").value;
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                window.location.href = "submitrequest.php?id=" + this.responseText;

            }
        };
        xhttps.open("GET", "actionpage1.php?doctype=7&resid=" + id + "&purpose=" + purpose);
        xhttps.send();
    }


    function showdropdown(e) {
        var searchkey = e.value.trim();
        if (searchkey.length >= 2) {
            $("#dropdown").slideDown(400);
            var xhttps = new XMLHttpRequest();

            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dropdown").innerHTML = this.responseText;
                }
            };
            xhttps.open("GET", "searchres4.php?searchkey=" + searchkey);
            xhttps.send();

        }
    }


    function chooseres1(e) {
        var fullname = document.getElementById("fullname1" + e).innerHTML;
        document.getElementById("lastname").value = fullname.trim();
        document.getElementById("residentidhidden").value = e;

    }



</script>

</html>