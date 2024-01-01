<?php
include_once("admin/connection.php");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style>
    .mapbg {
        background-image: linear-gradient(to bottom, rgba(160, 200, 160, 0.2), rgba(0, 0, 0, 1)), url("admin/img/mapbg.png");
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
    }

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


    .carousel-inner{
        width: 60%;
        overflow: hidden;
        margin: 0% 20%;
    }

    #notif{
        color: white;
        background-color: red;
        text-shadow: none;
        font-size: 12px;
        padding: 1px;
    }

    #myCarousel{
        width: 100%;
        margin: 0 auto;
        height: 90vh;
    }

  
    .section1 {
        background-image:
            linear-gradient(to bottom, rgba(160, 200, 160, 0.2), rgba(0, 0, 0, 1)), url('admin/img/bg.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 101.1%;
        height: 100vh;
        color: white;

    }

    .section1 h2 {
        text-shadow: 2px 2px 2px rgb(20, 50, 20);
    }


    ul li {
        list-style: none;
        background-color: transparent;
        color: white;
        font-family: "Lucida Console", "Courier New", monospace;
        text-shadow: 2px 2px 2px rgb(20, 80, 20);
    }

    .section {
        height: 95vh;
        width: 96%;
        margin: auto;
        margin-top: 2%;


    }

    .section4 {
        height: 100vh;
    }



    ul li a {
        color: inherit;
    }

    ul li a:hover {
        color: black;
        text-decoration: none;
        text-shadow: none;
        transition: 0.5s;
    }

    .indeximg {
        box-shadow: 0px 2px 2px black;
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

    img {
        max-width: 50%;
        height: auto;
    }
</style>

<body>
    <div class="row pt-4 pb-0  navsection">
        <div class="col-3">

        </div>
        <ul class="col-9 row mb-0 mt-4 nav">
            <li class="col m-1 text-center p-1 rounded"><a href="index.php">Home</a></li>
            <li class="col m-1 text-center p-1 rounded"><a href="barangayofficials.php">Barangay Officials</a></li>
            <li class="col m-1 rounded text-center p-1"><a href="events.php">Events<sub id="notif"><?php echo $noofevents; ?></sub></a></li>

            <li class="col m-1 text-center p-1 rounded"><a href="requestdoc.php">Request Document</a></li>
            <li class="col m-1 text-center p-1 rounded"><a href="interactivemap.html">Barangay Map</a></li>
        </ul>
    </div>
    <div class="section1  row ">
        <div class="col container pt-4 mt-4 align-middle ">

            <h2 class=" pt-4 px-5 mt-5">Welcome and Mabuhay!!</h2>
            <p class="mt-5 w-100 px-5 py-3 ">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris </p>

        </div>
        <div class="col px-4 mx-auto my-5">
            <img src="img/logo1.png" class="img-thumbnail img-fluid w-50 "
                style="background-color: transparent; border:none; ">

        </div>


    </div>
    <div class="text-center w-100 my-3 section4">
            <h3>Gallery</h3>

        <div class="my-auto w-100">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>

    </ol>
<?php

$select = "SELECT * FROM tbl_picturegallery ORDER BY RAND() LIMIT 6";
$result = $mysqli->query($select);
// $piclimit = mysqli_num_rows($result);
$picarray = array();
$index = 0;
while($row=$result->fetch_assoc()){
    $picarray[$index] = $row['picture_source'];
    $index++;
}



?>
    <!-- Wrapper for slides -->
    <div class="carousel-inner text-center">
      <div class="item active">
        <img src="<?php echo "admin/gallery/".$picarray[0];?>" class="img-thumbnail img-fluid" style="width:100%;">
      </div>

      <div class="item">
        <img src="<?php echo "admin/gallery/".$picarray[1];?>" class="img-thumbnail img-fluid" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="<?php echo "admin/gallery/".$picarray[2];?>" class="img-thumbnail img-fluid" style="width:100%;">
        
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev" id="leftcontrol">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

            <div class="w-100"></div>
        </div>
    </div>


    <div class="row pt-4 section ro">
        <div class="col-lg-6 col-sm-12 col-md-12 text-center my-auto">
            <img src="img/logo2.png" width="60%" class="img-thumbnail img-fluid img-responsive indeximg">
        </div>
        <div class="col-lg-6 col-sm-12 col-md-12 text-center pt-4 my-auto">
            <h2 class=" w-100 px-5 py-3">Get Document Easier!</h2>
            <p class=" px-5 py-3 d-sm-none d-lg-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris </p>
            <button class=" btn btn-info" onclick="location.href='requestdoc.php'">Request Document>></button>
        </div>
    </div>
    <div class="row pt-4 section">

        <div class="col-lg-6 text-center col-sm-12 col-md-12 my-auto">
            <h2 class="w-100">Your Bulletin Board</h2>
            <p class="w-100 px-3 py-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris </p>
            <button class="btn btn-info" onclick="location.href='events.php'">View Events>></button>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-12 text-center my-auto">
            <img src="img/logo3.png" alt="" width="50%" class="indeximg">
        </div>
    </div>
    <div class="text-center w-100 row section mapbg">
        <div class="my-auto w-100">
            <h2>Map</h2>
            <p class="w-50 mx-auto ">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris </p>
            <button class="btn btn-info" onclick="location.href='interactivemap.html'">Visit Map>></button>
        </div>
    </div>
</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="admin/jquery.js"></script>

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
</script>

</html>