<?php
include_once("admin/connection.php");
$sql = "SELECT * FROM tbl_announcement ORDER by date DESC LIMIT 10";
$result = $mysqli->query($sql);

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
    <title>Announcements and Events</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style>

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

    .main {
        background-image:
            linear-gradient(to bottom, rgba(160, 200, 160, 0.2), rgba(0, 0, 0, 1)), url('admin/img/bg.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 101.1%;
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
        background-color: transparent;
        color: white;
        font-family: "Lucida Console", "Courier New", monospace;
        text-shadow: 2px 2px 2px rgb(20, 80, 20);
    }



    .section {
        height: 100vh;

    }

    ul li a {
        font-size: 14px;
        color: inherit;
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

    ul li a:hover {
        color: black;
        text-decoration: none;
        text-shadow: none;
        transition: 0.5s;
    }


    .announcementholder {
        background-color: rgba(255,255,255,0.4);
        box-shadow: 2px 2px 2px black;
        margin-top: 2px;
        color: black;
    }

    .announcementholder img{
        border: none;
        background-color: transparent;
    }

    #notif{
        color: white;
        background-color: red;
        text-shadow: none;
        font-size: 12px;
        padding: 1px;
    }
</style>

<body>
    <div class="row pt-4 pb-0  navsection">
        <div class="col-3">

        </div>
        <ul class="col-9 row mb-0 nav mt-4">
            <li class="col m-1 rounded text-center p-1"><a href="index.php">Home</a></li>
            <li class="col m-1 text-center p-1 rounded"><a href="barangayofficials.php">Barangay Officials</a></li>

            <li class="col m-1 rounded text-center p-1"><a href="events.php">Events<sub id="notif"><?php echo $noofevents; ?></sub></a></li>
            <li class="col m-1 rounded text-center p-1"><a href="requestdoc.php">Request Document</a></li>
            <li class="col m-1 rounded text-center p-1"><a href="interactivemap.html">Barangay Map</a></li>
        </ul>
    </div>
    <div class="main py-1">
        <div class="container mt-4">
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="announcementholder rounded row">

                    <img class="col-lg-4 col-md-6 col-sm-12 img-thumbnail img-fluid"
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