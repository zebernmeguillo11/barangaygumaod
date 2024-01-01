<?php
session_start();
include_once("admin/connection.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Request Successful</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
</head>
<body>
    <div style="margin-top: 20%;"  class="d-flex align-content-center justify-content-center"><br>
    <div ><p>Your request have been recorded. Please head to the barangay office to provide additional necessary information. </p></div>
    <div><p> Your Queue No.:<b><?php echo $_GET['id']; ?></b>     </p></div>
    </div>
    <a  href="index.php" style="float: right; margin-right: 20%;">Return To Home</a>


    
</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="admin/jquery.js"></script>

</html>