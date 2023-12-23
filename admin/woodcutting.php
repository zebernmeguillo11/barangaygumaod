<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Request - Wood Cutting Permit</title>
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

    .section1 {
        background-color: #00A1A1;
        box-shadow: 2px 2px 2px black;
        width: 50%;
        margin: auto;
    }
</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home" onClick="location.href='dashboard.php'"><img
                src="img/homepage.png" class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onclick="logout()"><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
    </div>
    <h4 class="w-100 text-center">Request Details</h4>
    <div class="container">
        <div class="section1 p-4">
            <div class="inputdiv container">
                <b> <label for="treename" class="form-label">Tree Variety
                    </label></b>
                <input type="text" class="form-control w-100" id="treename" required>
                <div class="invalid-feedback" id="treenamefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container">
                <b> <label for="treelocation" class="form-label">Tree Location
                       </label></b>
                <input type="text" class="form-control w-100" id="treelocation" required>
                <div class="invalid-feedback" id="treelocationfeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container">
                <b> <label for="purpose" class="form-label">Purpose
                        </label></b>
                <input type="text" class="form-control w-100" id="purpose" required>
                <div class="invalid-feedback" id="purposefeed">
                    Required!
                </div>
            </div>
            <div class="col-12 text-right mt-2">
                <button class="btn btn-dark" value="<?php echo $_GET["id"]; ?>"
                    onclick="proceedwoodcutting(this.value)">Procceed>></button>
            </div>
        </div>
    </div>


</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script>

    function proceedwoodcutting(id) {
        var treename = document.getElementById("treename").value;
        var treelocation = document.getElementById("treelocation").value;
        var purpose = document.getElementById("purpose").value;
        if (treename.trim() == "" || treelocation == "" || purpose == "") {
            if (purpose.trim() == "") {
                $("#purposefeed").css("display", "inline-block");
            }
            if (treename.trim() == "") {
                $("#treenamefeed").css("display", "inline-block");

            }
            if (treelocation.trim() == "") {
                $("#treelocationfeed").css("display", "inline-block");

            }
        }
        else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    window.location.href = "printwoodcutpermit.php?id=" + id + "&purpose=" + purpose + "&variety=" + treename + "&location=" + treelocation;
                }
            };
            xhttps.open("GET", "actionpage1.php?doctype=8&id=" + id + "&purpose=" + purpose + "&variety=" + treename + "&location=" + treelocation);
            xhttps.send();
        }
    }
    function logout() {
        var conf = confirm("Logout?");
        if (conf) {
            window.location.href = "logout.php";
        }
    }
</script>

</html>