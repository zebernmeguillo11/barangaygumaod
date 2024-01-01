<?php
include_once("admin/connection.php");
$date = date('Y-m-d', strtotime('-7 days'));

$sql1 = "SELECT * FROM tbl_announcement WHERE date > '" . $date . "'";
$result1 = $mysqli->query($sql1);
$noofevent = mysqli_num_rows($result1);
$noofevents = "";
if ($noofevent == 0) {
    $noofevents = "";
} else {
    $noofevents = $noofevent;
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


    .carousel-inner {
        width: 60%;
        overflow: hidden;
        margin: 0% 20%;
    }

    #notif {
        color: white;
        background-color: red;
        text-shadow: none;
        font-size: 12px;
        padding: 1px;
    }

    #myCarousel {
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
        height: 90vh;
        color: black;
        padding-bottom: 100px;


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

    .section1inner {
        height: 90%;
        margin: auto;
        margin-top: 2%;
        overflow-y: scroll;
        background-color: white;

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


    .header11 {
        position: sticky;
        top: 0%;
        left: 0%;
        background-color: rgb(70, 100, 70);
        z-index: 3;







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
            <li class="col m-1 rounded text-center p-1"><a href="events.php">Events<sub id="notif"><?php echo $noofevents; ?>
                    </sub></a></li>

            <li class="col m-1 text-center p-1 rounded"><a href="requestdoc.php">Request Document</a></li>
            <li class="col m-1 text-center p-1 rounded"><a href="interactivemap.html">Barangay Map</a></li>
        </ul>
    </div>
    <div class="section1  row ">
        <h2 class="text-center w-100 ">Barangay Officials</h2>

        <div class="w-75 m-auto section1inner">
            <table class="w-100 table table-light table-striped m-auto">
                <thead class="thead-dark header11 ">
                    <tr>

                        <th class="text-center">Position</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">On Duty?</th>

                    </tr>
                </thead>

                <?php
                $sql = "SELECT * FROM tbl_officials ORDER BY position_id ASC";
                $result = $mysqli->query($sql);
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr class="align-middle">

                        <td class="align-middle">
                            <?php
                            $sql1 = "SELECT * FROM tbl_position WHERE id = '" . $row["position_id"] . "'";
                            $result1 = $mysqli->query($sql1);
                            $row1 = $result1->fetch_assoc();
                            echo $row1["name"];
                            ?>

                        </td>
                        <td class="align-middle ">
                            <?php
                            $sql2 = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row["resident_id"] . "'";
                            $result2 = $mysqli->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            ?>
                            <img src="<?php echo htmlentities("admin/pics1/" . $row['img']); ?>"
                                class="img-thumbnail img-fluid ml-5" style="height: 5rem;">

                            <?php
                            echo $row2["Lastname"] . ", " . $row2["Firstname"] . " " . $row2["Middlename"];
                            ?>
                        </td>
                        <?php if ($row["onduty"] == 0) {
                            ?>

                            <td style="color: red;" class="align-middle text-center"> NO </td>
                            <?php
                        } else {
                            ?>
                            <td style="color: green;" class="align-middle text-center"> YES </td>
                            <?php

                        } ?>
                    </tr>







                    <?php
                }


                ?>
            </table>
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

            if ($(window).scrollTop() > 100) {
                $('.navsection').addClass('scrolled');
            } else {
                $('.navsection').removeClass('scrolled');
            };
        });
    });
</script>

</html>