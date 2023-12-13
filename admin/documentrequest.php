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
        <div class="container bg-info ">
            <div class="w-75">
        <button class="btn w-25">Unprocessed Request</button>
        <button class="btn w-25">Processed Request</button>
        <button class="btn w-25">Onsite Request</button>
            </div>
        <div class="section1">
            <h5 class="w-100 text-center mt-4">Unprocessed Request</h5>
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
        </div>
        
        
    </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script>
        function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }
</script>
</html>