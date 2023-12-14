<?php
session_start();
require_once("connection.php");
if (!isset($_SESSION['page'])) {
    $_SESSION['page'] = 1;
}
$_SESSION['limit'] = 6;

if (!isset($_SESSION['page1'])) {
    $_SESSION['page1'] = 1;
}
$_SESSION['limit1'] = 1;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Management</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
    .feedback{
        float: left;
        display: none;
        color: red;
    }
     body {
        background-color: #FFC5C5;

    }


    .familydata:hover{
        cursor: pointer;
    }
    .mainsection {
        background-color: #00A1A1;
        box-shadow: 2px 2px 2px black;
        
    }

    .main {
        height: 95vh;
    }

    .hidden {
        display: none;
    }

    #search {
        width: 70%;
        float: right;
        border: none;
        box-shadow: 0px 0px 7px 1px black;
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
        text-overflow: scroll;

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

    .nav{
        width: 4%;
        padding: 0px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: white;
    }

    #logoutbtn{
        transform: rotate(180deg);
    }

    .btnnav:hover{
        background-color: rgb(150, 150, 150);
    }

</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home"  onClick="location.href='dashboard.php'"><img src="img/homepage.png"  class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onClick="logout()"><img src="img/logout.png"  class="img-thumbnail img-fluid"></button>
    </div>
    <div class="main">
        <h1 class="w-100 text-center">Resident Management</h1>
        <div class="container mainsection p-4 rounded">
            <button class="btn bg-dark text-light my-2" onClick="switchtores()">Switch to Resident View</button>
            <button class="btn bg-dark text-light my-2" onClick="switchtofam()">Switch to Family View</button>
            <label for="search" class=" w-50 p-1 my-2 text-center" >Search:<input type="text" placeholder="Enter Lastname"
                    name="search" id="search" onkeyup="searchfamily(this.value)"></label>
            <div class="section1" id="section1">
                <table class="w-100 text-center table table-striped table-hover table-light">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th><input type="checkbox" title="Select All" id="selectallcheckbox"
                                    onclick="checkall(this)"></th>
                            <th>Household No.</th>
                            <th>Family Name</th>
                            <th>Purok</th>
                        </tr>
                    </thead>
                    <?php

                    $offset = ($_SESSION['page'] - 1) * $_SESSION['limit'];
                    $sqlmax = "SELECT * FROM tbl_family";
                    $resultmax = $mysqli->query($sqlmax);

                    $sql = "SELECT * FROM tbl_family ORDER by householdName ASC LIMIT " . $offset . ", " . $_SESSION['limit'];
                    $result = $mysqli->query($sql);
                    $totalrows = mysqli_num_rows($resultmax);
                    $result = $mysqli->query($sql);
                    $totalpage = ceil($totalrows / $_SESSION['limit']) + 1;

                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><input type="checkbox" title="Select" class="famcheck"
                                    value="<?php echo $row["houseNumber"]; ?>"></td>

                            <td id="houseno-<?php echo $row['houseNumber']; ?>" class="familydata" onclick="showfamily(this.id)">
                                <?php echo $row["houseNumber"]; ?>
                            </td>
                            <td id="housename-<?php echo $row['houseNumber']; ?>" >
                                <?php echo $row["householdName"]; ?>
                            </td>
                            <td id="purok-<?php echo $row['houseNumber']; ?>" >
                                <?php echo $row["purok"]; ?>
                            </td>
                        </tr>
                        <?php


                    }


                    ?>
                </table>
                <div id="pageholder" class="col-sm-12 col-md-12 col-md-12 mb-1" style="text-align: center;">
                    <?php
                    $buttonnum = 1;
                    while ($buttonnum < $totalpage) {
                        if ($_SESSION['page'] == $buttonnum) {
                            ?>
                            <button class="pagebutton btn btn-secondary" value="<?php echo htmlentities($buttonnum); ?>"
                                onclick="setpage(this.value)">
                                <?php echo $buttonnum; ?>
                            </button>
                            <?php
                        } else {
                            ?>
                            <button class="pagebutton btn btn-primary" value="<?php echo htmlentities($buttonnum); ?>"
                                onclick="setpage(this.value)">
                                <?php echo $buttonnum; ?>
                            </button>
                            <?php
                        }

                        ?>




                        <?php
                        $buttonnum++;
                    }



                    ?>

                </div>
                <div class="w-75 my-2">
                    <button class="btn bg-dark text-light w-25" onclick="showaddfam()">Add</button>
                    <button class="btn bg-dark text-light w-25" onclick="deletefamily()">Delete</button>
                    <button class="btn bg-dark text-light w-25" onclick="editfamily()">Edit</button>
                </div>
            </div>
            <div class="section2 hidden" id="section2">
                <table class="w-100 text-center table table-striped table-hover table-light">
                    <thead class="thead-dark text-center">
                        <tr>

                            <th><input type="checkbox" title="Select All" id="selectallcheckbox3"
                                    onclick="checkall1(this)"></th>
                            <th>Lastname</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Gender</th>
                            <th>Birthdate</th>
                            <th>Marital Status</th>
                        </tr>
                    </thead>
                    <?php
                    $sqlmax1 = "SELECT * FROM tbl_resident";
                    $resultmax1 = $mysqli->query($sqlmax1);
                    $offset1 = ($_SESSION['page1'] - 1) * $_SESSION['limit1'];
                    $sql1 = "SELECT * FROM tbl_resident ORDER by Lastname LIMIT " . $offset1 . ", " . $_SESSION['limit1'];
                    $result1 = $mysqli->query($sql1);
                    $totalrows1 = mysqli_num_rows($resultmax1);
                    $result1 = $mysqli->query($sql1);
                    $totalpage1 = ceil($totalrows1 / $_SESSION['limit1']) + 1;

                    while ($row1 = $result1->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><input type="checkbox" title="Select" class="rescheck"
                                    value="<?php echo $row1["resident_id"]; ?>"></td>
                            <td id="<?php echo "lastname" . $row1["resident_id"]; ?>">
                                <?php echo $row1["Lastname"]; ?>
                            </td>
                            <td id="<?php echo "firstname" . $row1["resident_id"]; ?>">
                                <?php echo $row1["Firstname"]; ?>
                            </td>
                            <td id="<?php echo "middlename" . $row1["resident_id"]; ?>">
                                <?php echo $row1["Middlename"]; ?>
                            </td>
                            <td id="<?php echo "gender" . $row1["resident_id"]; ?>">
                                <?php echo $row1["Gender"]; ?>
                            </td>
                            <td>
                            <input id="<?php echo "bday".$row1["resident_id"];?>" type="date" value="<?php echo $row1["Birthdate"]; ?>" style="display:none;">
                                <?php
                                $date = date_create($row1['Birthdate']);
                                echo date_format($date, "M d, Y"); ?>
                            </td>
                            <td id="<?php echo "status" . $row1["resident_id"]; ?>">
                                <?php echo $row1["m_status"]; ?>
                            </td>
                        </tr>
                        <?php


                    }


                    ?>
                </table>
                <div id="pageholder" class="col-sm-12 col-md-12 col-md-12 mb-1" style="text-align: center;">

                    <?php
                    $buttonnum1 = 1;
                    while ($buttonnum1 < $totalpage1) {
                        if ($_SESSION['page1'] == $buttonnum1) {
                            ?>
                            <button class="pagebutton btn btn-secondary" value="<?php echo htmlentities($buttonnum1); ?>"
                                onclick="setpage1(this.value)">
                                <?php echo $buttonnum1; ?>
                            </button>
                            <?php
                        } else {
                            ?>
                            <button class="pagebutton btn btn-primary" value="<?php echo htmlentities($buttonnum1); ?>"
                                onclick="setpage1(this.value)">
                                <?php echo $buttonnum1; ?>
                            </button>
                            <?php
                        }

                        ?>




                        <?php
                        $buttonnum1++;
                    }



                    ?>
                </div>

                <div class="w-75 my-2">
                    <button class="btn bg-dark text-light w-25" onclick="showaddres()">Add</button>
                    <button class="btn bg-dark text-light w-25" onclick="deleteres()">Delete</button>
                    <button class="btn bg-dark text-light w-25" onclick="editres()">Edit</button>
                </div>
            </div>

        </div>
        <div class="custommodal p-2" id="addtofam">
            <h5 class="w-50 p-3">Add to Family</h5>
            <div class="w-25 p-2 " style="float:right">
                <button class="closebtn w-50 py-1" onclick="closeaddfammodal()"><img src="img/close.png"
                        class="img-thumbnail img-fluid"></button>
            </div>
            <div class="inputdiv container w-100">
                <label for="addfamilyname" class="form-label">Family Name</label>
                <input type="text" class="form-control w-100" id="addfamilyname" required>
                <div class="invalid-feedback" id="addfamilynamefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="addhouseno" class="form-label">House No.</label>
                <input type="text" class="form-control w-100" id="addhouseno" required>
                <div class="invalid-feedback" id="addhousenofeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="addpurok" class="form-label">Purok</label>
                <select name="purok" class="form-control" id="addpurok">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="w-100 text-center text-center" style="float:left;">
                <button class="btn btn-dark w-25 my-4" onclick="inserttofam()">Add</button>
            </div>
            <div class="feedback w-100 text-center" id="successfeedback">
                Successfully added!
            </div>


        </div>

        <div class="custommodal p-2" id="editfam">
            <h5 class="w-50 p-3">Edit Family</h5>
            <div class="w-25 p-2 " style="float:right">
                <button class="closebtn w-50 py-1" onclick="closeeditfam()"><img src="img/close.png"
                        class="img-thumbnail img-fluid"></button>
            </div>
            <div class="inputdiv container w-100">
                <label for="editfamilyname" class="form-label">Family Name</label>
                <input type="text" class="form-control w-100" id="editfamilyname" required>
                <div class="invalid-feedback" id="editfamilynamefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="edithouse" class="form-label">House No.</label>
                <input type="text" class="form-control w-100" id="edithouse" required disabled>
                <div class="invalid-feedback" id="edithousefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="editpurok" class="form-label">Purok</label>
                <select name="purok" class="form-control" id="editpurok">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="w-100 text-center text-center" style="float:left;">
                <button class="btn btn-dark w-25 my-4" onclick="editfam()">Update</button>
            </div>
            <div class="feedback w-100 text-center" id="successfeedback2">
                Successfully updated!
            </div>


        </div>


        <div class="custommodal p-2" id="addtores">
            <h5 class="w-50 p-3">Add Resident</h5>
            <div class="w-25 p-2 " style="float:right">
                <button class="closebtn w-50 py-1" onclick="closeaddresmodal()"><img src="img/close.png"
                        class="img-thumbnail img-fluid"></button>
            </div>
            <div class="inputdiv container w-100">
                <label for="addlastname" class="form-label">Lastname</label>
                <input type="text" class="form-control w-100" id="addlastname" required>
                <div class="invalid-feedback" id="addlastnamefed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="addfirstname" class="form-label">Firstname</label>
                <input type="text" class="form-control w-100" id="addfirstname" required>
                <div class="invalid-feedback" id="addfirstnamefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="addmiddlename" class="form-label">Middlename</label>
                <input type="text" class="form-control w-100" id="addmiddlename" required>
                <div class="invalid-feedback" id="addmiddlenamefeed">
                    Required! Put Na if not applicable.
                </div>
            </div>
            <div class="inputdiv container w-100 pt-0">
                <label for="addmiddlename" class="form-label mb-0 pb-0">Gender</label>
                <div class="form-check ml-2 my-0">
                    <input class="form-check-input" type="radio" name="gender" id="malegen" value="M" checked>
                    <label class="form-check-label" for="malegen">
                        Male
                    </label>
                </div>

                <div class="form-check ml-2 my-0">
                    <input class="form-check-input" type="radio" name="gender" id="femalegen" value="F">
                    <label class="form-check-label" for="femalegen">
                        Female
                    </label>
                </div>

            </div>

            <div class="inputdiv container w-100">
                <label for="addbirthdate" class="form-label">Birthdate</label>
                <input type="date" class="form-control w-100" id="addbirthdate" required>
                <div class="invalid-feedback" id="addbirthdatefeed">
                    Required!
                </div>
            </div>

            <div class="inputdiv container w-100">
                <label for="mstatus" class="form-label">Marital Status</label>
                <select name="status" class="form-control" id="mstatus">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>



            <div class="w-100 text-center text-center" style="float:left;">
                <button class="btn btn-dark w-25 my-4" onclick="inserttores()">Add</button>
            </div>
            <div class="feedback w-100 text-center" id="successfeedback3">
                Successfully added!
            </div>


        </div>
        <div class="custommodal p-2" id="editres">
            <h5 class="w-50 p-3">Edit Resident</h5>
            <div class="w-25 p-2 " style="float:right">
                <button class="closebtn w-50 py-1" onclick="closeditresmodal()"><img src="img/close.png"
                        class="img-thumbnail img-fluid"></button>
            </div>
            <div class="inputdiv container w-100">
                <label for="editlast" class="form-label">Lastname</label>
                <input type="text" class="form-control w-100" id="editlast" required>
                <div class="invalid-feedback" id="editlastfeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="editfirst" class="form-label">Firstname</label>
                <input type="text" class="form-control w-100" id="editfirst" required>
                <div class="invalid-feedback" id="editfirstfeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="editmiddle" class="form-label">Middlename</label>
                <input type="text" class="form-control w-100" id="editmiddle" required>
                <div class="invalid-feedback" id="editmiddlefeed">
                    Required! Put Na if not applicable.
                </div>
            </div>
            <div class="inputdiv container w-100 pt-0">
                <label class="form-label mb-0 pb-0">Gender</label>
                <div class="form-check ml-2 my-0">
                    <input class="form-check-input" type="radio" name="editgender" id="editgenradM" value="M">
                    <label class="form-check-label" for="editgenradM">
                        Male
                    </label>
                </div>

                <div class="form-check ml-2 my-0">
                    <input class="form-check-input" type="radio" name="editgender" id="editgenradF" value="F">
                    <label class="form-check-label" for="femalegen">
                        Female
                    </label>
                </div>

            </div>

            <div class="inputdiv container w-100">
                <label for="editbirth" class="form-label">Birthdate</label>
                <input type="date" class="form-control w-100" id="editbirth" required>
                <div class="invalid-feedback" id="editbirthfeed">
                    Required!
                </div>
            </div>

            <div class="inputdiv container w-100">
                <label for="editstatus" class="form-label">Marital Status</label>
                <select name="editstatus" class="form-control" id="editstatus">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>



            <div class="w-100 text-center text-center" style="float:left;">
                <button class="btn btn-dark w-25 my-4" onclick="inserttores()">Update</button>
            </div>
            <div class="feedback w-100 text-center" id="successfeedback3">
                Successfully updated!
            </div>


        </div>




</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script>
    function searchfamily(x){
        if(x.trim()!=""){
            if(x.trim().length > 1){

        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section1").innerHTML = this.responseText;
            }
        };
        xhttps.open("GET", "searchfamilypage.php?searchkey=" + x);
        xhttps.send();
    }    

        }else{
            getpage();
        }
    }
    function showfamily(id){
        var houseno =document.getElementById(id).innerHTML.trim();
        window.location.href = "showfamily.php?houseno=" + houseno;
    }
    function logout(){
        var conf =confirm("Logout?");
        if(conf){
            window.location.href = "logout.php";
        }
    }

    function checkall(e) {
        $(':checkbox.famcheck').prop('checked', e.checked);
    }
    function checkall1(e) {
        $(':checkbox.rescheck').prop('checked', e.checked);
    }
    function inserttores() {
        var lastname = document.getElementById("addlastname").value;
        var firstname = document.getElementById("addfirstname").value;
        var middlename = document.getElementById("addmiddlename").value;
        var gender = $('input[name="gender"]:checked').val();
        var e = document.getElementById("mstatus");
        var status = e.options[e.selectedIndex].value;
        var bday = document.getElementById("addbirthdate").value;

        if (lastname.trim() == "" || firstname.trim() == "" || middlename.trim() == "" || bday.trim() == "") {
            if (lastname.trim() == "") {
                $("#addlastnamefed").css('display', 'inline-block');
            }
            if (firstname.trim() == "") {
                $("#addfirstnamefeed").css('display', 'inline-block');

            }
            if (middlename.trim() == "") {
                $("#addfirstnamefeed").css('display', 'inline-block');

            }
            if (bday.trim() == "") {
                $("#addbirthdatefeed").css('display', 'inline-block');

            }
        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() == "1") {
                        document.getElementById("addhousenofeed").innerHTML = "Duplicate entry.";
                        alert("Duplicate entry!");

                    } else {
                        $("#successfeedback3").fadeIn(500).fadeOut(8000);
                        $('#addlastname').val('');
                        $('#addfirstname').val('');
                        $('#addmiddlename').val('');

                    }
                }
            };
            xhttps.open("GET", "actionpage.php?addlast=" + lastname + "&addfirst=" + firstname + "&addmiddle=" + middlename + "&addgender=" + gender + "&addbday=" + bday + "&addmstatus=" + status);
            xhttps.send();
        }
    }
    function getpage() {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section1").innerHTML = this.responseText;
            }
        };
        xhttps.open("GET", "getpage.php");
        xhttps.send();
    }

    function getpage1() {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section2").innerHTML = this.responseText;
            }
        };
        xhttps.open("GET", "getpage1.php");
        xhttps.send();
    }
    function setpage(x) {

        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                getpage();
            }
        };
        xhttps.open("GET", "actionpage.php?setpage=" + x);
        xhttps.send();
    }

    function setpage1(x) {

        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                getpage1();
            }
        };
        xhttps.open("GET", "actionpage.php?setpage1=" + x);
        xhttps.send();
    }


    function switchtores() {
        $(".section1").slideUp(1000);
        $(".section2").slideDown(1000);

    }
    function switchtofam() {
        $(".section2").slideUp(1000);
        $(".section1").slideDown(1000);

    }

    function showaddfam() {
        $("#addtofam").slideDown(500);

    }
    function showaddres() {
        $("#addtores").slideDown(500);

    }

    function closeaddfammodal() {
        $("#addtofam").slideUp(500);

    }

    function closeaddresmodal() {
        $("#addtores").slideUp(500);

    }

    function closeditresmodal() {
        $("#editres").slideUp(500);

    }



    function showeditmodal(id) {
        $("#editfam").slideDown(500);
        var name = document.getElementById("housename-" + id).innerHTML;
        var houseno = document.getElementById("houseno-" + id).innerHTML;
        var purok = document.getElementById("purok-" + id).innerHTML.trim();
        document.getElementById("editfamilyname").value = name;
        document.getElementById("edithouse").value = houseno;
        $('#editpurok').val(purok);
    }
    function showreseditmodal(id) {
        $("#editres").slideDown(500);
        var lastname = document.getElementById("lastname" + id).innerHTML;
        var firstname = document.getElementById("firstname" + id).innerHTML;
        var middle = document.getElementById("middlename" + id).innerHTML;
        var bday = document.getElementById("bday" + id).value;
        var mstatus = document.getElementById("status" + id).innerHTML.trim();
        var gender = document.getElementById("gender" + id).innerHTML.trim();
        if (gender == "M") {
            $("#editgenradM").prop("checked", true);

        } else {
            $("#editgenradF").prop("checked", true);
        }

        document.getElementById("editlast").value = lastname;
        document.getElementById("editfirst").value = firstname;
        document.getElementById("editmiddle").value = middle;
        document.getElementById("editbirth").value = bday;
        $('#editstatus').val(mstatus);



    }

    function closeeditfam() {
        $("#editfam").slideUp(500);

    }


    function inserttofam() {
        var familyname = document.getElementById("addfamilyname").value;
        var houseno = document.getElementById("addhouseno").value;
        var e = document.getElementById("addpurok");
        var purok = e.options[e.selectedIndex].value;
        if (familyname.trim() == "" || houseno.trim() == "") {
            if (familyname.trim() == "") {
                $("#addfamilynamefeed").css('display', 'inline-block');
            }
            if (houseno.trim() == "") {
                $("#addhousenofeed").css('display', 'inline-block');

            }
        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() == "1") {
                        document.getElementById("addhousenofeed").innerHTML = "Duplicate entry.";
                        $("#addhousenofeed").css('display', 'inline-block');

                    } else {
                        $("#successfeedback").fadeIn(500).fadeOut(8000);
                        $('#addfamilyname').val('');
                        $('#addhouseno').val('');
                    getpage();



                    }
                }
            };
            xhttps.open("GET", "actionpage.php?addtofamname=" + familyname + "&addtohouseno=" + houseno + "&addtopurok=" + purok);
            xhttps.send();
        }


    }

    function editfam() {
        var familyname = document.getElementById("editfamilyname").value.trim();
        var houseno = document.getElementById("edithouse").value.trim();
        var e = document.getElementById("editpurok");
        var purok = e.options[e.selectedIndex].value;
        if (familyname.trim() == "" || houseno.trim() == "") {
            if (familyname.trim() == "") {
                $("#addfamilynamefeed").css('display', 'inline-block');
            }
            if (houseno.trim() == "") {
                $("#addhousenofeed").css('display', 'inline-block');

            }
        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $("#successfeedback2").fadeIn(500).fadeOut(8000);
                    getpage();

                }
            };
            xhttps.open("GET", "actionpage.php?updatename=" + familyname + "&houseupdate=" + houseno + "&updatepurok=" + purok);
            xhttps.send();
        }
    }

    function editfamily() {
        var count = 0;
        var id = "";

        $(".famcheck").each(function () {
            if (this.checked) {
                count++;
                id = this.value;
            }

        });
        if (count != 1) {
            alert("Select only 1 to edit");
        } else {
            showreseditmodal(id);
        }

    }
    function editres() {
        var count = 0;
        var id = "";

        $(".rescheck").each(function () {
            if (this.checked) {
                count++;
                id = this.value;
            }

        });
        if (count != 1) {
            alert("Select only 1 to edit");
        } else {
            showreseditmodal(id);
        }

    }



    function deletefamily() {
        var conf = confirm("Are you sure you want to delete this entries?");
        if (conf) {
            $(".famcheck").each(function () {
                if (this.checked) {
                    var id = this.value;
                    var xhttps = new XMLHttpRequest();
                    xhttps.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            getpage();

                        }
                    }
                    xhttps.open("GET", "actionpage.php?deletehouseno=" + id);
                xhttps.send();
                }
               

            });

        }
    }


    function deleteres() {
        var conf = confirm("Are you sure you want to delete this entries?");
        if (conf) {
            $(".rescheck").each(function () {
                if (this.checked) {
                    var id = this.value;
                    var xhttps = new XMLHttpRequest();
                    xhttps.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            getpage1();

                        }
                    }
                    xhttps.open("GET", "actionpage.php?deleteres=" + id);
                xhttps.send();
                };


            });

        }
    }



    $(document).ready(function () {



    });





</script>

</html>