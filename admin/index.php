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
    .main{
        height: 100vh;
    }
</style>
<body>
    <div class="container bg-light pt-5 main">
        <div class="mt-5 pt-4">
            <h2 class="text-center mt-5">Admin Login</h2>
        </div>
            <div div class="row">
                <div class="col-3">
                </div>
                <form action="action_page.php" class="needs-validation col" >
                <div class="mb-3 mt-3">
                    <label for="username" class="form-label w-100">Username<input  type="text" name="username" id="username" placeholder="Enter username" class="form-control" required></label>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="password" class="form-label w-100">Password<input type="password" name="password" id="password" placeholder="Enter password" class="form-control" required></label>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                  <div class="w-100 text-center pt-4">
                  <button class="btn-info w-25">Submit</button>
                </div>
                
                </form>
                <div class="col-3">
                </div>
                </div>
    </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
</html>