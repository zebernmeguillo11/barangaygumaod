<?php
session_start();
include_once("connection.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Officials</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
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

    .feedback {
        float: left;
        color: green;
        display: none;

    }


    .custommodal {
        position: fixed;
        left: 50%;
        top: 0%;
        width: 500px;
        height: 100vh;
        margin-left: -250px;
        background-color: white;
        box-shadow: 2px 10px 10px black;
        z-index: 10;
        display: none;

    }

    .inputdiv {
        float: left;
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

    #dropdown {
        background-color: rgb(220, 220, 220);
        height: 25vh;
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
    <div class="main">
        <h2 class="text-center">Barangay Officials</h2>
        <div class="row">
            <div class="col-2"></div>
            <div class="col">
                <div id="section1">
                    <table class="w-100 text-center table table-light table-striped">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th><input type="checkbox" title="Select All" id="selectallcheckbox"
                                        onclick="checkall(this)"></th>
                                <th>Position</th>
                                <th>Name</th>
                            </tr>
                        </thead>

                        <?php
                        $sql = "SELECT * FROM tbl_officials ORDER BY position_id ASC";
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr class="align-middle">
                                <td class="align-middle"> <input type="checkbox" title="Select" class="officecheck"
                                        value="<?php echo $row['id'];?>">
                                </td>
                                <td class="align-middle">
                                    <?php
                                    $sql1 = "SELECT * FROM tbl_position WHERE id = '" . $row["position_id"] . "'";
                                    $result1 = $mysqli->query($sql1);
                                    $row1 = $result1->fetch_assoc();
                                    echo $row1["name"];
                                    ?>

                                </td>
                                <td class="align-middle">
                                    <?php
                                    $sql2 = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row["resident_id"] . "'";
                                    $result2 = $mysqli->query($sql2);
                                    $row2 = $result2->fetch_assoc();
                                    ?>
                                    <img src="<?php echo htmlentities("pics1/" . $row['img']); ?>"
                                        class="img-thumbnail img-fluid" style="height: 5rem;">

                                    <?php
                                    echo $row2["Lastname"] . ", " . $row2["Firstname"] . " " . $row2["Middlename"];
                                    ?>
                                </td>
                            </tr>







                            <?php
                        }


                        ?>
                    </table>
                    <button class="btn-info w-25" onclick="showaddofficial()">Add</button>
                    <button class="btn-info w-25" onclick="deleteofficial()">Delete</button>
                </div>

            </div>
            <div class="col-2"></div>

        </div>
        <div class="custommodal" id="addofficial">
            <h5 class="w-50 p-3">Add Official</h5>
            <div class="w-25 p-2" style="float:right">
                <button class="closebtn w-50 py-1" onclick="closeaddofficial()"><img src="img/close.png"
                        class="img-thumbnail img-fluid"></button>
            </div>
            <div class="w-100 text-center" id="officialimg" style="float: left;">
                <img src="img/upload.png" class="img-thumbnail img-fluid ml-4" style="height: 20vh;"
                    id="addofficialimg">
            </div>
            <div class="inputdiv container w-100">
                <label for="uploadimage" class="form-label">Upload Image</label>
                <input type="file" class="form-control w-100" id="uploadimage" onchange="uploadphoto(this)">
            </div>
            <div class="inputdiv container w-100">
                <label for="addpos" class="form-label">Position</label>
                <select name="addpos" class="form-control" id="addpos">
                    <?php
                    $sql = "SELECT * FROM tbl_position ORDER BY id";
                    $result = $mysqli->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row["name"]; ?>
                        </option>
                        <?php
                    }
                    ?>

                </select>
            </div>
            <div class="inputdiv container w-100">
                <label for="anndesc" class="form-label">Search Resident</label>
                <input type="text" class="form-control" id="residentID" placeholder="Search by Lastname"
                    onkeyup="showdropdown(this)" autocomplete="off">
                <div id="dropdown">


                </div>

                <div class="invalid-feedback" id="fullnamefeed">
                    Required!
                </div>
            </div>
            <input type="hidden" id="residentidhidden">
            <div class="w-100 text-center text-center" style="float:left;">
                <button class="btn btn-dark w-25 my-4" onclick="inserttoofficial()">Add</button>
            </div>
            <div class="feedback w-100 text-center" id="successfeedback">
                Successfully added!
            </div>
        </div>
    </div>



</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script>


    function checkall(e) {
        $(':checkbox.officecheck').prop('checked', e.checked);
    }
    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }

    function chooseres(e) {
        var fullname = document.getElementById("fullname" + e).innerHTML;
        document.getElementById("residentID").value = fullname.trim();
        document.getElementById("residentidhidden").value = e;

    }

    function updateofficialstable() {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section1").innerHTML = this.responseText;
            }
        };
        xhttps.open("GET", "updateofficialstable.php");
        xhttps.send();
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
            xhttps.open("GET", "searchres.php?searchkey=" + searchkey);
            xhttps.send();

        } else {
            $("#dropdown").slideUp(400);

        }
    }

    function showaddofficial() {
        $("#addofficial").slideDown(400);
    }

    function closeaddofficial() {
        $("#addofficial").slideUp(400);

    }

    function inserttoofficial() {
        var position = document.getElementById("addpos").value;
        var resid = document.getElementById("residentidhidden").value;
        var fullname = document.getElementById("residentID").value;
        if (fullname == "") {
            $("#fullnamefeed").css("display", "inline-block");
        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $("#successfeedback").fadeIn(500).fadeOut(8000);
                    $('#residentID').val('');
                    document.getElementById("residentidhidden").value = "";
                    document.getElementById("addpos").value = "1";
                    document.getElementById("uploadimage").value = null;
                    document.getElementById("addofficialimg").src = "pics1/upload.png";
                    $("#dropdown").slideUp(400);
                    updateofficialstable();

                }
            };
            xhttps.open("GET", "actionpage.php?resid=" + resid + "&posid=" + position);
            xhttps.send();
        }

    }

    function uploadphoto(e) {
        var property = e.files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase().trim();
        if (jQuery.inArray(image_extension, ['gif', 'png', 'jpg', 'jpeg']) > -1) {
            var image_size = property.size;
            if (image_size > 2000000) {
                alert("File size too big.");
            } else {
                var form_data = new FormData();
                form_data.append("file", property);
                $.ajax({
                    url: "officialimage.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#officialimg').html("<label class='text-success'>Image Uploading...</label>");
                    },
                    success: function (data) {
                        $('#officialimg').html(data);
                    }
                })
            }

        }
    }

    function deleteofficial() {
        var conf = confirm("Are you sure you want to delete this entries?");
        if (conf) {
            $(".officecheck").each(function () {
                if (this.checked) {
                    var id = this.value;
                    var xhttps = new XMLHttpRequest();
                    xhttps.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                        }
                    }
                    xhttps.open("GET", "actionpage.php?deleteofficial=" + id);
                    xhttps.send();
                }


            });
            updateofficialstable();

        }
    }



</script>

</html>