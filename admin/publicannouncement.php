<?php
session_start();
include_once("connection.php");
if(!isset($_SESSION["auth"])){
    header("location: index.php");
}

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
    .inputdiv {
        float: left;
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

    .btn1 {
        filter: drop-shadow(rgb(150, 150, 200) 0.5rem 0.5rem 10px);
    }

    .postbtn {
        position: absolute;
        bottom: 2px;
        right: 2px;
    }

    .section {
        filter: drop-shadow(rgb(150, 150, 150) 1rem 1rem 10px);


    }

    .post-desc {
        font-size: 15px;

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

    .btnnav:hover {
        background-color: rgb(150, 150, 150);
    }
</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home" onClick="location.href='dashboard.php'"><img src="img/homepage.png"
                class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onClick="logout()" ><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
    </div>
    <div class="main container">
        <h2 class="w-100 text-center">Public Announcement</h2>
        <button class="btn bg-info" onclick="showcreate()"> <b>+</b> Create Announcement</button>
        <div id="section6">
            <?php
            $sql = "SELECT * FROM tbl_announcement ORDER BY date DESC";
            $result = $mysqli->query($sql);
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class=" row section bg-light border-right border-bottom my-1 py-2">
                    <div class="col-5 text-center ">
                        <img src="<?php echo "pics/" . $row["img"]; ?>" class="img-thumbnail img-fluid w-75"
                            style="height:35vh;">
                        <input type="hidden" value="<?php echo htmlentities($row["img"]); ?>"
                            id="<?php echo "pic" . htmlentities($row['id']); ?>">
                    </div>
                    <div class="col-7">
                        <div class="w-100">
                            <h5 class="pb-0 mb-0" id="<?php echo "title" . htmlentities($row['id']); ?>">
                                <?php echo $row["title"]; ?>
                            </h5>
                            <small class="text-muted">
                                <?php
                                $date = date_create($row['date']);
                                echo date_format($date, "M d, Y H:ia");

                                ?>
                            </small>
                        </div>
                        <div class="w-100">
                            <p class="post-desc" id="<?php echo "desc" . htmlentities($row['id']); ?>">
                                <?php
                                echo $row['description'];

                                ?>
                            </p>

                        </div>
                        <div class="postbtn w-50 text-right">
                            <button class="btn bg-info w-25 btn1" value="<?php echo $row["id"]; ?>"
                                onclick="showedit(this.value)">Edit</button>
                            <button class="btn bg-info w-25 btn1" value="<?php echo $row["id"]; ?>"
                                onclick="deleteannounce(this.value)">Delete</button>
                        </div>

                    </div>

                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="custommodal" id="addannounce">
        <h5 class="w-50 p-3">Add Announcement</h5>
        <div class="w-25 p-2" style="float:right">
            <button class="closebtn w-50 py-1" onclick="closeaddannounce()"><img src="img/close.png"
                    class="img-thumbnail img-fluid"></button>
        </div>
        <div class="w-100 text-center" id="addannphoto" style="float: left;">
            <img src="img/upload.png" class="img-thumbnail img-fluid ml-4">
        </div>
        <div class="inputdiv container w-100">
            <label for="uploadimage" class="form-label">Upload Image</label>
            <input type="file" class="form-control w-100" id="uploadimage" onchange="uploadphoto(this)">
        </div>
        <div class="inputdiv container w-100">
            <label for="addtitle" class="form-label">Title</label>
            <input type="Text" class="form-control w-100" id="addtitle">
            <div class="invalid-feedback" id="addtitlefeed">
                Required!
            </div>
        </div>
        <div class="inputdiv container w-100">
            <label for="anndesc" class="form-label">Description</label>
            <textarea name="" id="anndesc" class="form-control w-100" cols="30" rows="7"></textarea>
            <div class="invalid-feedback" id="anndescfeed">
                Required!
            </div>
        </div>
        <div class="w-100 text-center text-center" style="float:left;">
            <button class="btn btn-dark w-25 my-4" onclick="inserttoann()">Add</button>
        </div>
        <div class="feedback w-100 text-center" id="successfeedback">
            Successfully added!
        </div>
    </div>

    <div class="custommodal" id="editannounce">
        <h5 class="w-50 p-3">Edit Announcement</h5>
        <div class="w-25 p-2" style="float:right">
            <button class="closebtn w-50 py-1" onclick="closeedit()"><img src="img/close.png"
                    class="img-thumbnail img-fluid"></button>
        </div>
        <div class="w-100 text-center" id="editphoto" style="float: left;">
            <img src="img/upload.png" class="img-thumbnail img-fluid ml-4" id="editupload">
        </div>
        <div class="inputdiv container w-100">
            <label for="edituploadimage" class="form-label">Upload Image</label>
            <input type="file" class="form-control w-100" id="edituploadimage" onchange="uploadphoto1(this)">
        </div>
        <div class="inputdiv container w-100">
            <label for="edittitle" class="form-label">Title</label>
            <input type="Text" class="form-control w-100" id="edittitle">
            <div class="invalid-feedback" id="edittitlefeed">
                Required!
            </div>
        </div>
        <div class="inputdiv container w-100">
            <label for="editdesc" class="form-label">Description</label>
            <textarea name="" id="editdesc" class="form-control w-100" cols="30" rows="7"></textarea>
            <div class="invalid-feedback" id="editdescfeed">
                Required!
            </div>
        </div>
        <div class="w-100 text-center text-center" style="float:left;">
            <button class="btn btn-dark w-25 my-4" id="editannsubbtn" onclick="editann(this.value)">Edit</button>
        </div>
        <div class="feedback w-100 text-center" id="successfeedback1">
            Successfully Updated!
        </div>
    </div>



</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script>
    function logout(){
        var conf =confirm("Logout?");
        if(conf){
            window.location.href = "logout.php";
        }
    }
    function updateannouncementpage() {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section6").innerHTML = this.responseText;

            }
        };
        xhttps.open("GET", "updateannouncementpage.php");
        xhttps.send();
    }

    function editann() {
        var anntitle = document.getElementById("edittitle").value;
        var descrip = document.getElementById("editdesc").value;
        var id = document.getElementById("editannsubbtn").value;
        if (anntitle.trim() == "" || descrip.trim() == "") {
            if (anntitle.trim() == "") {
                $("#edittitlefeed").css('display', 'inline-block');
            }
            if (descrip.trim() == "") {
                $("#editdescfeed").css('display', 'inline-block');
            }
        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $("#successfeedback1").fadeIn(500).fadeOut(8000);
                    updateannouncementpage();

                }
            };
            xhttps.open("GET", "actionpage.php?id=" + id + "&edittitle=" + anntitle + "&desc=" + descrip);
            xhttps.send();
        }
    }

    function showcreate() {
        $("#addannounce").slideDown(500);

    }
    function closeaddannounce() {
        $("#addannounce").slideUp(500);

    }

    function showedit(e) {
        $("#editannounce").slideDown(500);
        var title = document.getElementById("title" + e).innerHTML;
        var descript = document.getElementById("desc" + e).innerHTML.trim();
        var img = document.getElementById("pic" + e).value;

        document.getElementById("editannsubbtn").value = e;
        document.getElementById("edittitle").value = title;
        document.getElementById("editdesc").value = descript;
        document.getElementById("editupload").src = "pics/" + img;


    }

    function deleteannounce(e) {
        var conf = confirm("Are you sure you want to delete post?");
        if (conf) {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    updateannouncementpage();
                }
            };
            xhttps.open("GET", "actionpage.php?deleteannid=" + e);
            xhttps.send();
        }
    }


    function closeedit(e) {
        $("#editannounce").slideUp(500);
    }

    function inserttoann() {
        var anntitle = document.getElementById("addtitle").value;
        var descrip = document.getElementById("anndesc").value;
        if (anntitle.trim() == "" || descrip.trim() == "") {
            if (anntitle.trim() == "") {
                $("#addtitlefeed").css('display', 'inline-block');
            }
            if (descrip.trim() == "") {
                $("#anndescfeed").css('display', 'inline-block');
            }
        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $("#successfeedback").fadeIn(500).fadeOut(8000);
                    $('#addtitle').val('');
                    $('#anndesc').val('');
                    updateannouncementpage();

                }
            };
            xhttps.open("GET", "actionpage.php?addtitle=" + anntitle + "&desc=" + descrip);
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
                    url: "uploadimg.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#addannphoto').html("<label class='text-success'>Image Uploading...</label>");
                    },
                    success: function (data) {
                        $('#addannphoto').html(data);
                    }
                })
            }

        }
    }
    function uploadphoto1(e) {
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
                    url: "uploadimg1.php",
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#editphoto').html("<label class='text-success'>Image Uploading...</label>");
                    },
                    success: function (data) {
                        $('#editphoto').html(data);
                    }
                })
            }

        }
    }



    $(document).ready(function () {

    });




</script>

</html>