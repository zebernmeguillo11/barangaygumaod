<?php
session_start();
require_once("connection.php");
$error = "";


if (isset($_POST['username'])) {

    $user = $_POST['username'];
    $pass = $_POST['password'];


    $sql = "select*from tbl_account where accountName = '" . $user . "' AND accountType = '1'";

    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
    $rowcount = mysqli_num_rows($result);


    if ($rowcount == 0) {
        $error = "Account does not exist";

    } else {
        if ($pass != $row["accountPassword"]) {
            $error = "Incorrect Password";

        } else {
            $_SESSION['authadmin'] = true;


            header('Location:dashboard.php');
        }

    }
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
    .main {
        height: 100vh;
        background-image: url("../img/bg1.png");
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 100vh;

    }

    .sec {
        box-shadow: 2px 2px 2px black;
    }

    form label {
        font-size: 20px;
        font-weight: bold;
    }

    form input {
        box-shadow: 2px 2px 2px black;
    }

    .logo{
        position: fixed;
   
        top: 0;
        left: 0;
    }

    .logo img{
        width: 45%;
        
    }
</style>

<body>
<div class="logo">

<img src="../img/logo1.png" class="mt-4">
</div>
    <div class=" bg-light p-5 main">

        <div style="background-color: white; height: 50vh; width: 40%;" class="container rounded sec mt-5">
            <div class="w-100 p-3">
                <h2 class="text-center w-100">Admin Login</h2>
            </div>
            <div div class="w-100">

                <div class="container w-100">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" autocomplete="off"
                        class="w-75 ml-5">
                        <div class="mb-3 mt-3">
                            <label for="username" class="form-label w-100">Username<input type="text" name="username"
                                    id="username" placeholder="Enter username" class="form-control" required></label>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="password" class="form-label w-100">Password<input type="password"
                                    name="password" id="password" placeholder="Enter password" class="form-control"
                                    required></label>
                            <p id="error" class="text-center" style="color: red; ">
                                <?php echo $error; ?>
                            </p>

                        </div>

                        <div class="w-100 text-center pt-4">
                            <button class="btn-info rounded w-50">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>