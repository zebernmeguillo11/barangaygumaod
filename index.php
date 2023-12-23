

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

</head>
<style>
    .section1 {
        background-image: url('img/bg1.png');
        background-repeat: no-repeat;
        background-size: cover;

        width: 100%;
        height: 100vh;

    }

    .nav li {
        box-shadow: 2px 2px 2px black;
    }

    ul li {
        list-style: none;
        background-color: white;
    }

    .section {
        height: 100vh;

    }

    ul li a {
        color: black;
    }

    .indeximg {
        box-shadow: 0px 2px 2px black;
    }

    .navsection {
        background-color: rgb(100, 150, 100);
    }
</style>

<body>
    <div class="row pt-4 pb-0  navsection">
        <div class="col-3">

        </div>
        <ul class="col-9 row mb-0 mt-4 nav">
            <li class="col m-1 text-center p-1 rounded"><a href="index.php">Home</a></li>
            <li class="col m-1 text-center p-1 rounded"><a href="events.php">Announcement/events</a></li>
            <li class="col m-1 text-center p-1 rounded"><a href="requestdoc.php">Request Document</a></li>
            <li class="col m-1 text-center p-1 rounded"><a href="">Barangay Map</a></li>
        </ul>
    </div>
    <div class="section1 row">
        <div class="col mt-2"><img src="img/logo1.png" width="73%" alt=""></div>
        <div class="col pt-4 mt-4">
            <h2 class="text-center pt-4 mt-4">Welcome and Mabuhay!!</h2>
        </div>
        <div class="col">

        </div>

    </div>



    <div class="row pt-4 section">
        <div class="col-lg-6 col-sm-12 col-md-12 text-center mt-5">
            <img src="img/logo2.png" alt="" width="50%" class="mt-4 indeximg">
        </div>
        <div class="col-lg-6 col-sm-12 col-md-12 text-center pt-4 mt-5">
            <h2 class="mt-4 w-100 px-5 py-3">Get Document Easier!</h2>
            <p class="mt-4 w-100 px-5 py-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris </p>
            <button class=" btn btn-info"  onclick="location.href='requestdoc.php'">Request Document>></button>
        </div>
    </div>
    <div class="row pt-4 section">

        <div class="col-lg-6 text-center col-sm-12 col-md-12 ">
            <h2 class="mt-4 w-100">Your Bulletin Board</h2>
            <p class="mt-4 w-100 px-3 py-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris </p>
            <button class="btn btn-info" onclick="location.href='events.php'">View Events>></button>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-12 text-center">
            <img src="img/logo3.png" alt="" width="50%" class="mt-4 indeximg">
        </div>
    </div>
    <div class="text-center w-100 col section">
        <h2>Map</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris </p>
        <button class="btn btn-info">Visit Map>></button>
    </div>
</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>