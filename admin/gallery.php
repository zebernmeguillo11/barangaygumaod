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
    .divgallery {
        z-index: 0;
        padding: 60px;
    }

    .inputdiv {
        float: left;
    }

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

    .feedback {
        float: left;
        color: green;
        display: none;

    }

    #logoutbtn {
        transform: rotate(180deg);
    }


    .custommodal h5 {
        float: left;
    }

    .custommodal {
        position: fixed;
        left: 50%;
        top: 50%;
        width: 400px;
        height: 360px;
        margin-left: -200px;
        margin-top: -180px;
        background-color: white;
        box-shadow: 2px 10px 10px black;
        z-index: 10;
        display: none;
        text-overflow: scroll;

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


    <h2 class="w-100 text-center mt-3">Gallery</h2>
    <div class="custommodal" id="addimgmodal">
        <h5 class="w-50 p-3">Gallery</h5>
        <div class="w-25 p-2 " style="float:right">
            <button class="closebtn w-50 py-1" onclick="closemodal()"><img src="img/close.png"
                    class="img-thumbnail img-fluid"></button>
        </div>

        <div class="inputdiv container w-100">
            <label for="uploadimage" class="form-label">Upload Image</label>
            <input type="file" class="form-control w-100" id="uploadimage" onchange="uploadphoto(this)">
        </div>
        <div class="w-100 text-center text-center" style="float:left;">
            <button class="btn btn-dark w-25 my-4" onclick="addnewimage()">Add</button>
        </div>
        <div class="feedback w-100 text-center" id="successfeedback">
            Successfully added!
        </div>
    </div>
    <div class="row mt-5 divgallery" id="divgallery">
        <p class="col-12"><b>Note: </b> Only 3 images would load at the website and would be chosen randomly</p>
        <div class=" addimage col-12 my-2">
            <button class="btn btn-dark" onclick="showaddmodal()">Add Image</button>
            <button class="btn btn-dark" onclick="deleteppic()">Delete Image</button>

        </div>


        <?php
        $sql = "SELECT * FROM tbl_picturegallery";
        $result = $mysqli->query($sql);
        while ($row = $result->fetch_assoc()) {

            ?>

            <div class="col-2 img" onclick="<?php echo "checkradio(" . $row['id'] . ")"; ?>"
                id="<?php echo "picture-" . $row["id"]; ?>">
                <img src="<?php echo "gallery/" . $row['picture_source']; ?>" alt="" class="img-thumbnail img-fluid">
                <input type="radio" name="picselector" class="picselector" id="<?php echo "houseselector-" . $row["id"]; ?>"
                    style="display:none;" value="<?php echo $row["id"]; ?>">


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

    function updatepage() {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divgallery").innerHTML =this.responseText;
            }
        };
        xhttps.open("GET", "updategallery.php");
        xhttps.send();
    }

    function deleteppic() {
        $(".picselector").each(function () {
            if (this.checked) {
                var id = this.value;
                var xhttps = new XMLHttpRequest();
                xhttps.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        updatepage();
                    }
                }
                xhttps.open("GET", "deletepic.php?deletepic=" + id);
                xhttps.send();
            }


        });
    }

    function checkradio(x) {
        $(".img").css("background-color", "#FFC5C5");
        $("#picture-" + x).css("background-color", "rgb(120,40,40)");
        $("#picture-" + x).css("color", "white");
        var radiobutt = document.getElementById("houseselector-" + x);
        radiobutt.checked = true;

    }
    function addnewimage() {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $("#successfeedback").fadeIn(500).fadeOut(8000);
                updatepage();

            }
        };
        xhttps.open("GET", "addnewimg.php");
        xhttps.send();
    }
    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }

    function showaddmodal() {
        $("#addimgmodal").slideDown(500);
    }

    function closemodal() {
        $("#addimgmodal").slideUp(500);

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
                    url: "galleryimage.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                    },
                    success: function (data) {
                    }
                })
            }

        }
    }
</script>

</html>