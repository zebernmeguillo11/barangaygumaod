<?php
session_start();
include_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Requests</title>
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

    .inputdiv {
        float: left;
    }

    #dropdown {
        background-color: rgb(220, 220, 220);
        height: 100px;
        overflow-y: scroll;
        display: none;
    }

    .dropdownlist:hover {
        background-color: white;
    }

    #logoutbtn {
        transform: rotate(180deg);
    }

    .custommodal {
        position: fixed;
        left: 50%;
        top: 50%;
        width: 400px;
        height: 500px;
        margin-left: -200px;
        margin-top: -250px;
        background-color: white;
        box-shadow: 2px 10px 10px black;
        z-index: 10;
        display: none;
        text-overflow: scroll;

    }

    .custommodal h5 {
        float: left;
    }

    .custommodal2 h5 {
        float: left;
    }

    .custommodal1 {
        position: fixed;
        left: 50%;
        top: 50%;
        width: 400px;
        height: 400px;
        margin-left: -200px;
        margin-top: -200px;
        background-color: white;
        box-shadow: 2px 10px 10px black;
        z-index: 10;
        display: none;
        text-overflow: scroll;
        z-index: 20;

    }

    .custommodal1 h5 {
        float: left;
    }

    .custommodal2 {
        position: fixed;
        left: 50%;
        top: 50%;
        width: 400px;
        height: 500px;
        margin-left: -200px;
        margin-top: -250px;
        background-color: white;
        box-shadow: 2px 10px 10px black;
        z-index: 10;
        display: none;
        text-overflow: scroll;
        z-index: 20;

    }

    .custommodal1 h5 {
        float: left;
    }

    .closebtn {
        border: none;
        background-color: white;
        float: right;

    }

    .closebtn:hover {
        cursor: pointer;
        background-color: rgb(100, 100, 100);
    }
</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home" onClick="location.href='dashboard.php'"><img
                src="img/homepage.png" class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onclick="logout()"><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
    </div>

    <div class="main">
        <h1 class="w-100 text-center">Document Requests</h1>
        <div class="container">

            <div class="section1 px-3 py-2 rounded">
                <h5 class="w-100 text-center mt-4">Request</h5>
                <button class="btn" onclick="showmodal()">Create++</button>
                <table class="w-100 table">
                    <thead class="thead-dark text-center">
                        <tr>
                        <th>ID</th>
                            <th>Requestor's Name</th>
                            <th>Document Requested</th>
                            <th>Date Requested</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM tbl_docrequest WHERE is_processed = '0' ORDER BY date DESC";
                    $result = $mysqli->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr class="text-center">
                            <td> <?php
                            echo $row["id"];
                            
                            ?></td>
                            <td>
                                <?php
                                $res = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row['resident_id'] . "'";
                                $result2 = $mysqli->query($res);
                                $row2 = $result2->fetch_assoc();
                                echo $row2["Lastname"] . ", " . $row2["Firstname"] . " " . $row2["Middlename"];
                                ?>
                            </td>

                            <td>
                                <?php
                                $doctype = "SELECT * FROM tbl_documenttype WHERE id='" . $row['document_type'] . "'";
                                $result3 = $mysqli->query($doctype);
                                $row3 = $result3->fetch_assoc();
                                echo $row3["document_type"];
                                ?>
                            </td>
                            <td>
                                <?php
                                $date = date_create($row["date"]);
                                echo date_format($date, "M d, Y H:ia");
                                ?>
                            </td>
                            <td><button class="btn w-50 p-0 border-dark" value="<?php echo $row['id']; ?>"
                                    onclick="processrequest(this.value)">Process</button><button
                                    class="btn w-50 p-0 border-dark ">Delete</button></td>
                        </tr>

                        <?php
                    }

                    ?>
                </table>
            </div>

            <div class="custommodal p-2" id="addtofam">
                <h5 class="w-50 p-3">Document Type</h5>
                <div class="w-25 p-2 " style="float:right">
                    <button class="closebtn w-50 py-1" onclick="closemodal()"><img src="img/close.png"
                            class="img-thumbnail img-fluid"></button>
                </div>
                <div class="w-100 text-center p-2" style="float: left;">
                    <button class="btn btn-dark w-50" onClick="location.href='createanimaltransport.php'">Animal
                        Transport</button>
                </div>
                <div class="w-100 text-center p-2" style="float: left;">
                    <button class="btn btn-dark w-50" onClick="location.href='createbarangayclearance.php'">Barangay
                        Clearance</button>

                </div>
                <div class="w-100 text-center p-2" style="float: left;">
                    <button class="btn btn-dark w-50" onclick="showresselector()">Certificate of Indigency</button>

                </div>
                <div class="w-100 text-center p-2" style="float: left;">
                    <button class="btn btn-dark w-50" onclick="showresselector1()">Certificate of Residency</button>

                </div>
                <div class="w-100 text-center p-2" style="float: left;">
                    <button class="btn btn-dark w-50">Good Moral Certificate</button>

                </div>
                <div class="w-100 text-center p-2" style="float: left;">
                    <button class="btn btn-dark w-50">Wood Cutting Permit</button>

                </div>
            </div>
            <div class="custommodal1 p-2">
                <h5 class="w-50 p-3">Choose Resident</h5>
                <div class="w-25 p-2 " style="float:right">
                    <button class="closebtn w-50 py-1" onclick="closemodal1()"><img src="img/close.png"
                            class="img-thumbnail img-fluid"></button>
                </div>
                <div class="inputdiv container">
                    <label for="residentID" class="form-label" style="float: left;">Search Resident</label>
                    <input type="text" class="form-control" id="residentID" placeholder="Search by Lastname"
                        onkeyup="showdropdown(this)" autocomplete="off">
                    <div id="dropdown">



                    </div>

                    <div class="invalid-feedback" id="fullnamefeed">
                        Required!
                    </div>
                    <input type="hidden" id="residentidhidden" value="0">
                </div>
                <div class="w-100 text-center my-5">
                    <button class="btn btn-dark mt-4" onclick="proceedcreate()">Proceed>></button>

                </div>
            </div>

            <div class="custommodal2 p-2">
                <h5 class="w-50 p-3">Choose Resident</h5>
                <div class="w-25 p-2 " style="float:right">
                    <button class="closebtn w-50 py-1" onclick="closemodal2()"><img src="img/close.png"
                            class="img-thumbnail img-fluid"></button>
                </div>
                <div class="inputdiv container">
                    <label for="residentID" class="form-label" style="float: left;">Search Resident</label>
                    <input type="text" class="form-control" id="residentID1" placeholder="Search by Lastname"
                        onkeyup="showdropdown1(this)" autocomplete="off">
                    <div id="dropdown1">



                    </div>

                    <div class="invalid-feedback" id="fullnamefeed1">
                        Required!
                    </div>
                    <input type="hidden" id="residentidhidden1" value="0">
                </div>
                <div class="inputdiv container">
                    <label for="purposeofdoc" class="form-label">Purpose of Document</label>
                    <input type="text" class="form-control w-100" id="purposeofdoc" required>
                    <div class="invalid-feedback" id="purposeofdocfeed">
                        Required!
                    </div>

                </div>
                <div class="w-100 text-center my-5">
                    <button class="btn btn-dark mt-4" onclick="proceedcreate1()">Proceed>></button>

                </div>
            </div>



        </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script>
    function processrequest(id) {
        window.location.href = "processrequest.php?id=" + id;
    }
    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }

    function proceedcreate() {
        var res_id = document.getElementById("residentidhidden").value;
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                processrequest(this.responseText.trim());

            }
        };
        xhttps.open("GET", "createactionpage.php?doctype=3&resid=" + res_id);
        xhttps.send();


        
    }
    function proceedcreate1() {
        var res_id = document.getElementById("residentidhidden1").value;
        var purpose =document.getElementById("purposeofdoc").value;

        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var id =this.responseText.trim();
                window.location.href = "printresidency.php?id=" + id + "&purpose=" + purpose;


            }
        };
        xhttps.open("GET", "createactionpage.php?doctype=4&resid=" + res_id + "&purpose=" + purpose);
        xhttps.send();


    }

    function closemodal() {
        $(".custommodal").slideUp(500);
    }

    function showmodal() {
        $(".custommodal").slideDown(500);

    }
    function showresselector() {
        $(".custommodal1").slideDown(500);


    }
    function showresselector1() {
        $(".custommodal2").slideDown(500);


    }
    function closemodal1() {
        $(".custommodal1").slideUp(500);
    }

    function closemodal2() {
        $(".custommodal2").slideUp(500);
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
            xhttps.open("GET", "searchres3.php?searchkey=" + searchkey);
            xhttps.send();

        } else {
            $("#dropdown").slideUp(400);

        }
    }

    function showdropdown1(e) {
        var searchkey = e.value;
        if (searchkey.length >= 2) {
            $("#dropdown1").slideDown(400);
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dropdown1").innerHTML = this.responseText;
                }
            };
            xhttps.open("GET", "searchres4.php?searchkey=" + searchkey);
            xhttps.send();

        } else {
            $("#dropdown").slideUp(400);

        }
    }

    function chooseres1(e) {
        var fullname = document.getElementById("fullname1" + e).innerHTML;
        document.getElementById("residentID1").value = fullname.trim();
        document.getElementById("residentidhidden1").value = e;

    }

</script>

</html>