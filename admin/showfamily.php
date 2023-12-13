<?php
session_start();
include_once("connection.php");
$sql = "SELECT * FROM `tbl_family` WHERE houseNumber = '" . trim($_GET['houseno']) . "'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $_GET["houseno"] . "-" . $row['householdName']; ?>
    </title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
    #dropdown {
        background-color: rgb(220, 220, 220);
        height: 100px;
        overflow-y: scroll;
        display: none;
    }

    .dropdownlist:hover {
        background-color: white;
    }

    .feedback {
        float: left;
        display: none;
        color: red;
    }

    .custommodal {
        position: fixed;
        left: 50%;
        top: 50%;
        width: 400px;
        height: 650px;
        margin-left: -200px;
        margin-top: -325px;
        background-color: white;
        box-shadow: 2px 10px 10px black;
        z-index: 10;
        display: none;

    }

    .custommodal h5 {
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

    .inputdiv {
        float: left;
    }

    .btnnav:hover {
        background-color: rgb(150, 150, 150);
    }

    #logoutbtn {
        transform: rotate(180deg);
    }

    .nav {
        width: 4%;
        padding: 0px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: white;
    }

    .main {
        height: 95vh;
    }
</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home" onClick="location.href='dashboard.php'"><img
                src="img/homepage.png" class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onClick="logout()"><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
    </div>
    <div class="main">
        <h2 class="w-100 text-center">
            <?php echo $row['householdName'] . " Family"; ?>
        </h2>
        <div class="container" id="section1">

            <table class="w-100 text-center table table-striped table-hover table-light">
                <thead class="thead-dark text-center">
                    <tr>
                        <th><input type="checkbox" onchange="checkall(this)"></th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Marital Status</th>
                        <th>Relation</th>
                    </tr>
                </thead>
                <?php
                $query = "SELECT * FROM tbl_familymember WHERE houseNumber = '" . $_GET['houseno'] . "'";
                $result1 = $mysqli->query($query);
                while ($row1 = $result1->fetch_assoc()) {
                    $select = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row1['resident_id'] . "'";
                    $result2 = $mysqli->query($select);
                    $row2 = $result2->fetch_assoc();
                    $fullname = $row2["Lastname"] . ", " . $row2["Firstname"];
                    ?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $row1["id"]; ?>" class="famcheck"></td>
                        <td>
                            <?php echo $fullname; ?>
                        </td>
                        <td>
                            <?php
                            $date = date_create($row2['Birthdate']);
                            echo date_format($date, "M d, Y"); ?>
                        </td>
                        <td><?php echo $row2["Gender"];?></td>
                        <td><?php echo $row2["m_status"];?></td>
                        <td>
                            <?php echo $row1['Position']; ?>
                        </td>
                    </tr>
                    <?php
                }

                ?>
            </table>
            <div class="w-75">
                <button class="w-25 btn btn-info" onclick="showaddmember()">Add</button>
                <button class="w-25 btn btn-info" onclick="deleteres()">Delete</button>
            </div>
        </div>


    </div>

    <div class="custommodal p-2" id="addmember">
        <h5 class="w-50 p-3">Add Member</h5>
        <div class="w-25 p-2 " style="float:right">
            <button class="closebtn w-50 py-1" onclick="closeaddmember()"><img src="img/close.png"
                    class="img-thumbnail img-fluid"></button>
        </div>
        <div class="inputdiv container w-100">
            <label for="relationship" class="form-label">Relation</label>
            <select name="relation" class="form-control" id="relationship">
                <option value="Grandfather">Grandfather</option>
                <option value="Grandmother">Grandmother</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="Child">Child</option>
                <option value="Other">Other</option>





            </select>
        </div>

        <div class="inputdiv container w-100">
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



        <div class="w-100 text-center text-center" style="float:left;">
            <button class="btn btn-dark w-25 mt-5" value="<?php echo $_GET["houseno"]; ?>" id="addfamilymemberbtn"
                onclick="inserttomember(this.value)">Add</button>
        </div>
        <div class="feedback w-100 text-center" id="successfeedback">
            Successfully added!
        </div>


    </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>


<script>
    function checkall(e) {
        $(':checkbox.famcheck').prop('checked', e.checked);
    }
    function inserttomember(id) {
        var resid = document.getElementById("residentidhidden").value;
        var e = document.getElementById("relationship");
        var pos = e.options[e.selectedIndex].value;
        var name = document.getElementById("residentID").value;
        if (name.trim() == "") {
            $("#fullnamefeed").css('display', 'inline-block');
        } else {
            $("#fullnamefeed").css('display', 'none');
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $("#successfeedback").fadeIn(100).fadeOut(2000);
                    document.getElementById("residentID").value = "";
                    updatetable();
                }
            };
            xhttps.open("GET", "actionpage.php?famid=" + id + "&resid=" + resid + "&pos=" + pos);
            xhttps.send();
        }


    }

    function updatetable() {
        var famid = document.getElementById("addfamilymemberbtn").value;
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section1").innerHTML = this.responseText;
            }
        };
        xhttps.open("GET", "updatefamilytable.php?famid=" + famid);
        xhttps.send();
    }
    function showaddmember() {
        $("#addmember").slideDown(500);

    }
    function closeaddmember() {
        $("#addmember").slideUp(500);

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
            xhttps.open("GET", "searchres1.php?searchkey=" + searchkey);
            xhttps.send();

        } else {
            $("#dropdown").slideUp(400);

        }
    }

    function chooseres(e) {
        var fullname = document.getElementById("fullname" + e).innerHTML;
        document.getElementById("residentID").value = fullname.trim();
        document.getElementById("residentidhidden").value = e;

    }

    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }

    function deleteres() {
        var conf = confirm("Are you sure you want to delete this entries?");
        if (conf) {
            $(".famcheck").each(function () {

                if (this.checked) {
                    var id = this.value;
                    var xhttps = new XMLHttpRequest();
                    xhttps.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {

                        }
                    }
                    xhttps.open("GET", "actionpage.php?deletemember=" + id);
                    xhttps.send();
                };


            });

        }
        updatetable();

    }


    $(document).ready(function () {



    });



</script>

</html>