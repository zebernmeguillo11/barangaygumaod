<?php
session_start();
include_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Requests</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
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

    #logoutbtn {
        transform: rotate(180deg);
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
        <h1 class="w-100 text-center">Document Requests</h1>
        <div class="container">

            <div class="section1 px-3 py-2 rounded">
                <h5 class="w-100 text-center mt-4">Request</h5>
                <table class="w-100 table">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Requestor's Name</th>
                            <th>Contact No.</th>
                            <th>Document Requested</th>
                            <th>Date Requested</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM tbl_docrequest WHERE is_processed = '0' ORDER BY date DESC";
                    $result = $mysqli->query($sql);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <tr class="text-center">
                            <td>
                                <?php
                                $res = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row['resident_id'] . "'";
                                $result2 = $mysqli->query($res);
                                $row2 = $result2->fetch_assoc();
                                echo $row2["Lastname"] . ", " . $row2["Firstname"] . " " . $row2["Middlename"];
                                ?>
                            </td>
                            <td>
                                <?php echo $row["contactno"]; ?>
                            </td>
                            <td>
                                <?php
                                $doctype = "SELECT * FROM tbl_documenttype WHERE id='".$row['document_type']."'";
                                $result3 = $mysqli->query($doctype);
                                $row3 = $result3->fetch_assoc();
                                echo $row3["document_type"];
                                ?>
                            </td>
                            <td>
                                <?php
                                $date = date_create($row["date"]);
                                echo date_format($date,"M d, Y H:ia");
                                ?>
                            </td>
                            <td><button class="btn w-50 p-0 border-dark" value ="<?php echo $row['id'];?>" onclick="processrequest(this.value)">Process</button><button class="btn w-50 p-0 border-dark ">Delete</button></td>
                        </tr>

                        <?php
                    }

                    ?>
                </table>
            </div>
            <!-- <div class="section1">
            <h5 class="w-100 text-center mt-4">Request History</h5>
            <table class="w-100 table">
               <thead class="thead-dark text-center">
                <tr>
                    <th>Requestor's Name</th>
                    <th>Contact No.</th>
                    <th>Document Requested</th>
                    <th>Date Requested</th>
                    <th>Action</th>
              </tr>
            </thead>
            </table>
        </div> -->


        </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script>
    function processrequest(id){
        window.location.href = "processrequest.php?id=" + id;
    }
    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }
</script>

</html>