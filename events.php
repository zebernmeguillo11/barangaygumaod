<?php
include_once("admin/connection.php");
$sql = "SELECT * FROM tbl_announcement ORDER by date DESC";
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements and Events</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
</head>
<style>
    .main {
        background-image: url('img/bg2.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        margin: 0px;
        margin-left: 0px;
        width: 99.9%;
        height: 100vh;


    }

    .section1 {
        background-image: url('img/bg1.png');
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100vh;

    }

    ul li {
        list-style: none;
        background-color: white;
    }

    .nav li {
        box-shadow: 2px 2px 2px black;
    }

    .section {
        height: 100vh;

    }

    ul li a {
        color: black;
    }


    .navsection {
        background-color: rgb(100, 150, 100);
    }

    .nav li {
        box-shadow: 2px 2px 2px black;
    }

    .announcementholder {
        background-color: white;
        box-shadow: 2px 2px 2px black;
        margin-top: 2px;
    }
</style>

<body>
    <div class="row pt-4 pb-0  navsection">
        <div class="col-3">

        </div>
        <ul class="col-9 row mb-0 nav mt-4">
            <li class="col m-1 rounded text-center p-1"><a href="index.php">Home</a></li>
            <li class="col m-1 rounded text-center p-1"><a href="events.php">Announcement/events</a></li>
            <li class="col m-1 rounded text-center p-1"><a href="requestdoc.php">Request Document</a></li>
            <li class="col m-1 rounded text-center p-1"><a href="">Barangay Map</a></li>
        </ul>
    </div>
    <div class="main py-1">
        <div class="container mt-4">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="announcementholder rounded row">

                    <img class="col-lg-4 col-md-6 col-sm-12 img-thumbnail img-fluid "
                        src="<?php echo "admin/pics/" . $row["img"]; ?>" alt="">

                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <h5>
                            <?php echo $row['title'] ?>
                        </h5>
                        <?php $date = date_create($row["date"]); ?>
                        <p>
                            <?php echo date_format($date, "M d, Y H:i a"); ?>
                        </p>
                        <p>
                            <?php echo $row["description"]; ?>
                        </p>
                    </div>



                </div>



                <?php


            }


            ?>


        </div>
    </div>
</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>