<?php
session_start();
include_once("connection.php");
$sql = "SELECT * FROM tbl_docrequest WHERE id = '" . $_GET['id'] . "'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
if ($row["document_type"] == "3") {
    header('Location:indigencycertificate.php?id=' . $_GET['id']);
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
            ?>
                        <div class="section1 p-4">
                            <h5>Certificate of Residency</h5>

                            <div class="row">

                                <div class="col p-2 border border-dark rounded">
                                    <div class="inputdiv container">
                                        <label for="purposeofdoc" class="form-label">Purpose of Document</label>
                                        <input type="text" class="form-control w-100" id="purposeofdoc" required>
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
        }
        ?>

                </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script>
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