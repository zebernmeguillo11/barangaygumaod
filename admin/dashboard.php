<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
    body {
        background-color: #FFC5C5;

    }

    .section {
        background-color: #00A1A1;
        border-radius: 2%;
        box-shadow: 5px 10px #888888;
    }

    .section:hover {
        box-shadow: 2px 2px 0px 4px #00E5E5;
        transition: 1s;
        background-color: #00E5E5;
        cursor: pointer;


    }
</style>

<body>
    <h1 class="w-100 text-center">Admin Dashboard</h1>
    <div class="row text-center m-auto py-2 container">
        <div class="col-4 my-2 ">
            <div class="container my-4 p-2 section" onClick="location.href='residentmanagement.php'">
                <h6>Resident Management</h6>
                <img src="img/resident.png" class="img-thumbnail img-fluid">


            </div>

        </div>

        <div class="col-4 my-2 ">
            <div class="container my-4 p-2 section" onClick="location.href='medicinecabinet.php'">
                <h6>Medicine Cabinet</h6>
                <img src="img/medicine.png" class="img-thumbnail img-fluid">


            </div>

        </div>
        <div class="col-4 my-2">
            <div class="container my-4   p-2 section" onClick="location.href='documentrequest.php'">
                <h6>Document Request</h6>
                <img src="img/Document.png" class="img-thumbnail img-fluid">

            </div>

        </div>
        <div class="col-4 my-2">
            <div class="container my-4   p-2 section" onClick="location.href='barangayofficials.php'">
                <h6>Barangay Officials</h6>
                <img src="img/Chart.png" class="img-thumbnail img-fluid">



            </div>

        </div>
        <div class="col-4 my-2">
            <div class="container my-4   p-2 section" onClick="location.href='manageaccount.php'">
                <h6>Website Account Management</h6>
                <img src="img/Account.png" class="img-thumbnail img-fluid">



            </div>

        </div>
        <div class="col-4 my-2 ">
            <div class="container my-4  p-2 section" onClick="location.href='publicannouncement.php'">
                <h6>Public Announcement</h6>
                <img src="img/Announcement.png" class="img-thumbnail img-fluid">

            </div>

        </div>
        <div class="col-4 my-2 ">
            <div class="container my-4 p-2 section" onClick="location.href='treasurer.php'">
                <h6>Treasurer's Page</h6>
                <img src="img/Treasurer.png" class="img-thumbnail img-fluid">


            </div>

        </div>
        <div class="col-4 my-2 ">
            <div class="container my-4 p-2 section" onClick="location.href='interactivemap.php'">
                <h6>Interactive Map</h6>
                <img src="img/map1.png" class="img-thumbnail img-fluid">


            </div>

        </div>
        <div class="col-4 my-2 ">
            <div class="container my-4 section p-2" onClick="location.href='logout.php'">
                <h6>Logout</h6>
                <img src="img/Logout.png" class="img-thumbnail img-fluid">


            </div>

        </div>
    </div>
</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>

<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>