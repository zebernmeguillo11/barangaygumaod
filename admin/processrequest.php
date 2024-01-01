<?php
session_start();
include_once("connection.php");
$sql = "SELECT * FROM tbl_docrequest WHERE id = '" . $_GET['id'] . "'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
if(!isset($_SESSION["auth"])){
    header("location: index.php");
}

if ($row["document_type"] == "3") {
    header('Location:indigencycertificate.php?id=' . $_GET['id']);
}

if ($row["document_type"] == "7") {
    header('Location:goodmoral.php?id=' . $_GET['id']);
}
if ($row["document_type"] == "8") {
    header('Location:woodcutting.php?id=' . $_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Request</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
    #section1 {
        background-color: #00A1A1;
        box-shadow: 2px 2px 2px black;
    }

    body {
        background-color: #FFC5C5;

    }

    .btnnav:hover {
        background-color: rgb(150, 150, 150);
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

    .section1 {
        background-color: #00A1A1;
        box-shadow: 2px 2px 2px black;
    }
</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home" onClick="location.href='dashboard.php'"><img
                src="img/homepage.png" class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onClick="logout()"><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
    </div>
    <h4 class="w-100 text-center">Request Details</h4>
    <div class="container">
        <?php


        if ($row["document_type"] == "1") {

            $sql1 = "SELECT * FROM tbl_doctype1 WHERE request_id ='" . $_GET['id'] . "'";
            $result1 = $mysqli->query($sql1);
            if (mysqli_num_rows($result1) == 1) {
                $row1 = $result1->fetch_assoc();
                ?>
                <div class="section1 p-4">
                    <h5>Animal Transport</h5>

                    <div class="row">

                        <div class="col p-2 border border-dark rounded">
                            <h6>Buyer's Information</h6>
                            <div class="inputdiv container">
                                <label for="buyerlastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control w-100" id="buyerlastname"
                                    value="<?php echo $row1["Lastname"]; ?>" required>
                                <div class="invalid-feedback" id="brandnamefeed">
                                    Required!
                                </div>

                            </div>
                            <div class="inputdiv container">
                                <label for="buyerfirstname" class="form-label">Firstname</label>
                                <input type="text" class="form-control w-100" value="<?php echo $row1["Firstname"]; ?>"
                                    id="buyerfirstname" required>
                                <div class="invalid-feedback" id="buyerfirstnamefeed">
                                    Required!
                                </div>
                            </div>
                            <div class="inputdiv container">
                                <label for="buyeraddress" class="form-label">Address</label>
                                <textarea type="text" class="form-control w-100" id="buyeraddress"
                                    required><?php echo $row1["Address"]; ?></textarea>
                                <div class="invalid-feedback" id="buyeraddressfeed">
                                    Required!
                                </div>
                            </div>

                        </div>
                        <div class="col p-2 border border-dark rounded">
                            <h6>Purchase Information</h6>
                            <div class="inputdiv container">
                                <label for="purchasedetails" class="form-label">Purchase Details</label>
                                <textarea type="text" class="form-control w-100" id="purchasedetails"
                                    required><?php echo $row1["purchase_details"]; ?></textarea>
                                <div class="invalid-feedback" id="purchasedetailsfeed">
                                    Required!
                                </div>
                            </div>
                            <div class="inputdiv container">
                                <label for="destinationdetail" class="form-label">Destination</label>
                                <textarea type="text" class="form-control w-100" id="destinationdetail"
                                    required><?php echo $row1["destination"]; ?></textarea>
                                <div class="invalid-feedback" id="destinationdetailfeed">
                                    Required!
                                </div>
                            </div>


                        </div>
                        <div class="col-12 text-right mt-2">
                            <button class="btn btn-dark" value="<?php echo $_GET["id"]; ?>"
                                onclick="procceedanimaltransport(this.value)">Procceed>></button>
                        </div>
                    </div>



                    <?php
            } else {
                ?>
                    <div class="section1 p-4">
                        <h5>Animal Transport</h5>

                        <div class="row">

                            <div class="col p-2 border border-dark rounded">
                                <h6>Buyer's Information</h6>
                                <div class="inputdiv container">
                                    <label for="buyerlastname" class="form-label">Lastname</label>
                                    <input type="text" class="form-control w-100" id="buyerlastname" required>
                                    <div class="invalid-feedback" id="brandnamefeed">
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


                            </div>
                            <div class="col-12 text-right mt-2">
                                <button class="btn btn-dark" value="<?php echo $_GET["id"]; ?>"
                                    onclick="procceedanimaltransport(this.value)">Procceed>></button>
                            </div>
                        </div>


                        <?php
            }
            ?>

                    <?php
        } else if ($row["document_type"] == "4") {

            $sql1 = "SELECT * FROM tbl_doctype4 WHERE request_id ='" . $_GET['id'] . "'";
            $result1 = $mysqli->query($sql1);
            ?>
                        <div class="section1 p-4">
                            <h5>Certificate of Residency</h5>

                            <div class="row">

                                <div class="col p-2 border border-dark rounded">
                                    <div class="inputdiv container">
                                        <label for="purposeofdoc" class="form-label">Purpose of Document</label>
                                        <?php
                                        if (mysqli_num_rows($result1) == 1) {
                                            $row1 = $result1->fetch_assoc();
                                            ?>
                                            <input type="text" class="form-control w-100" id="purposeofdoc"
                                                value="<?php echo $row1["purpose"]; ?>" required>


                                        <?php
                                        } else {
                                            ?>
                                            <input type="text" class="form-control w-100" id="purposeofdoc" required>
                                        <?php
                                        }

                                        ?>
                                        <div class="invalid-feedback" id="purposeofdocfeed">
                                            Required!
                                        </div>

                                    </div>

                                    <div class="col-12 text-right mt-2">
                                        <button class="btn btn-dark" value="<?php echo $_GET["id"]; ?>"
                                            onclick="proceedresidency(this.value)">Procceed>></button>
                                    </div>
                                </div>



                            <?php
        } else if ($row["document_type"] == "2") {

            $durationofstay = "";
            $reasonofstay = "";
            $bplace = "";
            $spouse="";
            $parents = "";
            $bmark="";
            $purposebrgyclearance = "";
            $sql = "SELECT * FROM tbl_doctype2 WHERE request_id = '".$_GET['id']."'";
            $result = $mysqli->query($sql);
            if (mysqli_num_rows($result) == 1){
                $row = $result->fetch_assoc();
            $durationofstay = $row["time_of_stay"];
            $reasonofstay = $row["reason"];
            $bplace = $row["bplace"];
            $spouse = $row["spouse"];
            $parents = $row["parents"];
            $bmark = $row["bmark"];
            $purposebrgyclearance = $row["purpose"];



            }
            ?>
                                    <div class="section1 p-4">
                                        <h5>Barangay Clearance</h5>
                                        <div class="row">
                                            <div class="col p-2 border border-dark rounded">
                                                <div class="inputdiv container">
                                                    <label for="durationofstay" class="form-label">Duration of stay</label>
                                                    <input type="text" class="form-control w-100" value = "<?php echo $durationofstay;?>" id="durationofstay" required>
                                                    <div class="invalid-feedback" id="durationofstayfeed">
                                                        Required!
                                                    </div>
                                                </div>
                                                <div class="inputdiv container">
                                                    <label for="reasonofstay" class="form-label">Reason for stay</label>
                                                    <input type="text" class="form-control w-100" value = "<?php echo $reasonofstay;?>" id="reasonofstay" required>
                                                    <div class="invalid-feedback" id="reasonofstayfeed">
                                                        Required!
                                                    </div>

                                                </div>
                                                <div class="inputdiv container">
                                                    <label for="birthplace" class="form-label">Birthplace</label>
                                                    <input type="text" class="form-control w-100" value = "<?php echo $bplace;?>" id="birthplace" required>
                                                    <div class="invalid-feedback" id="birthplacefeed">
                                                        Required!
                                                    </div>

                                                </div>

                                                <div class="inputdiv container">
                                                    <label for="spouse" class="form-label">Spouse</label>
                                                    <input type="text" class="form-control w-100" value = "<?php echo $spouse;?>" id="spouse" required>
                                                    <div class="invalid-feedback" id="spousefeed">
                                                        Required!
                                                    </div>

                                                </div>


                                            </div>
                                            <div class="col p-2 border border-dark rounded">
                                                <div class="inputdiv container">
                                                    <label for="parents" class="form-label">Parents</label>
                                                    <input type="text" class="form-control w-100" value = "<?php echo $parents;?>" id="parents" required>
                                                    <div class="invalid-feedback" id="parentsfeed">
                                                        Required!
                                                    </div>

                                                </div>
                                                <div class="inputdiv container">
                                                    <label for="birthmark" class="form-label">Birthmark</label>
                                                    <input type="text" class="form-control w-100" value = "<?php echo $bmark;?>" id="birthmark" required>
                                                    <div class="invalid-feedback" id="birthmarkfeed">
                                                        Required!
                                                    </div>

                                                </div>
                                                <div class="inputdiv container">
                                                    <label for="purposeofclearance" class="form-label">Purpose</label>
                                                    <input type="text" class="form-control w-100" value = "<?php echo $purposebrgyclearance;?>" id="purposeofclearance" required>
                                                    <div class="invalid-feedback" id="purposeofclearancefeed">
                                                        Required!
                                                    </div>
                                                    <div class="col-12 text-right mt-2">
                                                        <button class="btn btn-dark" value="<?php echo $_GET["id"]; ?>"
                                                            onclick="proceedbarangayclearance(this.value)">Procceed>></button>
                                                    </div>


                                                </div>
                                            </div>


                                        </div>
                                    </div>


                            <?php
        }
        ?>

                    </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script>

    function proceedbarangayclearance(id){
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
                    window.location.href = "printbaragayclearance.php?id=" + id;
                }
            };
            xhttps.open("GET", "actionpage1.php?doctype=2&id=" + id + "&durationofstay=" + durationofstay + "&reasonofstay=" + reasonofstay + 
            "&birthplace=" + birthplace + "&spouse=" + spouse + "&parents=" + parents + "&birthmark=" + birthmark + "&purpose=" + purposeofclearance);
            xhttps.send();
        
    }
    function proceedresidency(id) {
        var purpose = document.getElementById("purposeofdoc").value;
        if (purpose.trim() == "") {
            $("#purposeofdocfeed").css("display", "inline-block");

        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.href = "printresidency.php?id=" + id + "&purpose=" + purpose;
                }
            };
            xhttps.open("GET", "actionpage1.php?doctype=4&id=" + id + "&purpose=" + purpose);
            xhttps.send();


        }

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
                window.location.href = "printanimaltransport.php?id=" + id;

            }
        };
        xhttps.open("GET", "actionpage1.php?doctype=1&id=" + id + "&lastname=" + lastname + "&firstname=" + firstname + "&address=" + address + "&purchasedet=" + details + "&destination=" + destination);
        xhttps.send();


    }

    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }
</script>

</html>