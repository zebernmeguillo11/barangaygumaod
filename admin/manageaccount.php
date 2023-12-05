<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
    .main {
        height: 100vh;
    }
    .nav{
        width: 4%;
        padding: 0px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: white;
    }
    #logoutbtn{
        transform: rotate(180deg);
    }


</style>

<body>
<div class="nav">
        <button class="btn btnnav p-0" title="Go to Home"  onClick="location.href='dashboard.php'"><img src="img/homepage.png"  class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout" onClick="logout()"><img src="img/logout.png"  class="img-thumbnail img-fluid"></button>
    </div>
    <div class="container bg-light pt-5 main">
        <div class="mt-5 pt-4">
            <h2 class="text-center mt-5">Change Password</h2>
        </div>
        <div div class="row">
            <div class="col-3">
            </div>
            <div class="needs-validation col">
                <div class="mb-3 mt-3">
                    <label for="username" class="form-label w-100">Old Password<input type="password" name="old"
                            id="old" placeholder="Enter old password" class="form-control" required
                            onkeyup="enablenew()"></label>
                    <div class="invalid-feedback" id="oldfeedback">Incorrect password.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="password" class="form-label w-100">New Password<input type="password" name="new"
                            id="newpass" placeholder="Enter new password" class="form-control" required
                            disabled></label>
                    <div class="valid-feedback">Valid.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="password" class="form-label w-100">Confirm Password<input type="password" name="new"
                            id="confirmpass" placeholder="Confirm password" class="form-control" required
                            onkeyup="checkpass()" disabled></label>
                    <div class="invalid-feedback" id="confirmpasswordfeedback">Password not match.</div>
                </div>

                <div class="w-100 text-center pt-4">
                    <button class="btn-info w-25" id="submitadminchangepass" disabled
                        onclick="submitchanges()">Submit</button>
                </div>
            </div>

            <div class="col-3">
            </div>
        </div>
    </div>

</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script>
    function logout(){
        var conf =confirm("Logout?");
        if(conf){
            window.location.href = "logout.php";
        }
    }
    function enablenew() {
        var oldpass = document.getElementById("old").value;
        if (oldpass.length > 0) {
            document.getElementById("newpass").disabled = false;
            document.getElementById("confirmpass").disabled = false;
        } else {
            document.getElementById("newpass").disabled = true;
            document.getElementById("confirmpass").disabled = true;
        }

    }
    function submitchanges() {
        var oldpass = document.getElementById("old").value;
        var newpass = document.getElementById("newpass").value;
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText.trim() == "1") {
                    $("#old").css("color", "red");
                    $("#old").css('border-color', 'red');
                    $("#oldfeedback").css("display", "inline-block");
                    document.getElementById("newpass").disabled = true;
                    document.getElementById("confirmpass").disabled = true;

                } else {
                   alert("Successfully Updated!");
                }
               
            }
        };
        xhttps.open("GET", "actionpage.php?oldpass=" + oldpass + "&newpass=" + newpass);
        xhttps.send();

    }
    function checkpass() {
        var pass1 = document.getElementById("newpass").value;
        var pass2 = document.getElementById("confirmpass").value;
        $("#confirmpasswordfeedback").css("display", "inline-block");

        if (pass1 != pass2) {
            $("#confirmpasswordfeedback").css("color", "red");
            $("#confirmpass").css('border-color', 'red');
            $("#confirmpasswordfeedback").css("display", "inline-block");
            document.getElementById("confirmpasswordfeedback").innerHTML = "Password does not match.";
            document.getElementById("submitadminchangepass").disabled = true;
        } else if (pass1 == "" || pass2 == "") {
            $("#confirmpasswordfeedback").css("color", "red");
            $("#confirmpass").css('border-color', 'red');
            $("#confirmpasswordfeedback").css("display", "inline-block");
            document.getElementById("confirmpasswordfeedback").innerHTML = "Please fill up fields.";
            document.getElementById("submitadminchangepass").disabled = true;
        } else {
            $("#confirmpasswordfeedback").css("color", "green");
            $("#confirmpass").css('border-color', 'green');
            $("#confirmpasswordfeedback").css("display", "inline-block");
            document.getElementById("confirmpasswordfeedback").innerHTML = "Password match.";
            document.getElementById("submitadminchangepass").disabled = false;
        }

    }
</script>

</html>