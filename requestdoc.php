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

</head>
<style>
    .nav li {
        box-shadow: 2px 2px 2px black;
    }

    .section1 {

        width: 100%;
        height: 100vh;

    }

    .gender {
        background-color: rgba(255, 255, 255, 0.7);
    }

    .navsection ul li {
        list-style: none;
        background-color: white;
    }

    .main ul li {
        list-style: none;
        padding-top: 5px;
        padding-bottom: 5px;

    }



    .section {
        height: 100vh;

    }

    .navsection ul li a {
        color: black;
    }

    .navsection {
        background-color: rgb(100, 150, 100);
    }

    .main {

        margin: 0px;
        margin-left: 0px;
        width: 99.9%;
        height: 90vh;


    }

    .sidebar {
        background-color: white;
        box-shadow: 2px 2px 2px black;
    }

    .lastname label {
        font-weight: bold;
    }

    .dropdown {
        overflow-y: scroll;
        display: none;
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
    <div>
        <div class="main">
            <div>
                <h4 class=" text-center ">Request Document</h4>

                <h6 class="w-100 text-center">Type of Document</h6>
                <div class="d-flex align-content-center justify-content-center">
                    <div class=" w-75 d-flex align-content-center justify-content-start">
                        <ul class="w-50 align-content-center">
                            <li><input type="radio" name="typeofdoc" class="typeofdoc" value="2"> Barangay Clearance</li>
                            <li><input type="radio" name="typeofdoc" class="typeofdoc" value="3"> Certificate of Indigency</li>
                            <li><input type="radio" name="typeofdoc" class="typeofdoc" value="8"> Wood Cutting Permit
                            </li>
                        </ul>
                        <ul class="w-50 align-content-center">
                            <li><input type="radio" name="typeofdoc" class="typeofdoc" value="7"> Good Moral Certificate</li>
                            <li><input type="radio" name="typeofdoc" class="typeofdoc" value="4"> Certificate of Residency</li>
                            <li><input type="radio" name="typeofdoc" class="typeofdoc" value="1"> Animal Transport Certificate</li>
                        </ul>


                    </div>
                </div>

            </div>
            <hr class="w-100">
            <div>
                <h4 class="w-100 text-center">Requestor's Information</h4>
                <div class="d-flex align-content-center justify-content-center">
                    <label for="lastname" class="form-label w-25">Search your name
                        <input type="text" name="lastname" id="lastname" placeholder="Enter lastname"
                            class="form-control" onkeyup="showdropdown(this)" required></label>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback" id="resfeedback">Please fill out this field.</div>
                </div>
                <div class="dropdown d-flex align-content-center justify-content-center" id="dropdown">

                </div>
                <input type="hidden" id="residentidhidden" value="0">


                <div class="d-flex align-content-center justify-content-center">
                    <button class="btn btn-info w-25" style="float: right;" onclick="submitrequest()">Submit</button>
                </div>
            </div>
            <div class="col"></div>





        </div>

    </div>


    </div>

</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="admin/jquery.js"></script>


<script>
    function submitrequest() {
        var id = document.getElementById("residentidhidden").value;
        var typeofdoc = 0;
        $(".typeofdoc").each(function () {
            
            if (this.checked) {
                typeofdoc = this.value;
                
            }


        });
        if(typeofdoc==0){
            alert("Please choosethe type of document.");
        }else if(id=="0"){
            alert("Please choose your name from dropdown results.");

        }else{
        window.location.href = "sumbitrequest.php?doctype=" + typeofdoc + "&resid=" + id;
            
        }

    }
    function showdropdown(e) {
        var searchkey = e.value.trim();
        if (searchkey.length >= 2) {
            $("#dropdown").slideDown(400);
            var xhttps = new XMLHttpRequest();

            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("dropdown").innerHTML = this.responseText;
                }
            };
            xhttps.open("GET", "searchres4.php?searchkey=" + searchkey);
            xhttps.send();

        }
    }


    function chooseres1(e) {
        var fullname = document.getElementById("fullname1" + e).innerHTML;
        document.getElementById("lastname").value = fullname.trim();
        document.getElementById("residentidhidden").value = e;

    }

</script>

</html>