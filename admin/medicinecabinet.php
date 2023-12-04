<?php
session_start();
require_once("connection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
</head>
<style>
    .custommodal {
        position: fixed;
        left: 50%;
        top: 50%;
        width: 400px;
        height: 650px;
        margin-left: -200px;
        margin-top: -325px;
        background-color: white;
        box-shadow: 2px 10px 10px black;
        z-index: 10;
        display: none;

    }

    .feedback {
        float: left;
        color: green;
        display: none;
    }

    .inputdiv {
        float: left;
    }

    .custommodal h5 {
        float: left;
    }

    .closebtn {
        border: none;
        background-color: white;
        float: right;

    }

    .closebtn:hover {
        cursor: pointer;
        background-color: rgb(100, 100, 100);
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

    .btnnav:hover {
        background-color: rgb(150, 150, 150);
    }
</style>

<body>
    <div class="nav">
        <button class="btn btnnav p-0" title="Go to Home"><img src="img/homepage.png"
                class="img-thumbnail img-fluid"></button>
        <button class="btn btnnav p-0" id="logoutbtn" title="Logout"><img src="img/logout.png"
                class="img-thumbnail img-fluid"></button>
    </div>

    <div class="main">
        <h1 class="w-100 text-center">Medicine Cabinet</h1>
        <div class="container bg-info ">
            <div class="section1 p-4" id="section1">

                <table class="w-100 text-center table table-light table-striped">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th><input type="checkbox" title="Select All" id="selectallcheckbox"
                                    onclick="checkall(this)"></th>
                            <th>Brand Name</th>
                            <th>Generic Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>

                        </tr>
                        <?php
                        $sql = "SELECT * FROM tbl_medicine";
                        $result = $mysqli->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><input type="checkbox" title="Select."
                                        id="<?php echo "med" . htmlentities($row["medicine_id"]); ?>" class="medcheck"
                                        value="<?php echo $row["medicine_id"] ?>"></td>
                                <td id="<?php echo "brand" . htmlentities($row["medicine_id"]); ?>">
                                    <?php echo $row["brandname"]; ?>
                                </td>
                                <td id="<?php echo "gen" . htmlentities($row["medicine_id"]); ?>">
                                    <?php echo $row["genericname"]; ?>
                                </td>
                                <td id="<?php echo "quan" . htmlentities($row["medicine_id"]); ?>">
                                    <?php echo $row["quantity"]; ?>
                                </td>
                                <td id="<?php echo "unit" . htmlentities($row["medicine_id"]); ?>">
                                    <?php echo $row["unit"]; ?>
                                </td>

                            </tr>
                            <?php
                        }

                        ?>



                </table>
                <div class="w-75">
                    <button class="btn w-25" onclick="showaddmed()">Add</button>
                    <button class="btn w-25" onclick="deletemed()">Delete</button>
                    <button class="btn w-25" onclick="editmed()">Edit</button>
                </div>

            </div>

        </div>

        <div class="custommodal p-2" id="addmed">
            <h5 class="w-50 p-3">Add Medicine</h5>
            <div class="w-25 p-2 " style="float:right">
                <button class="closebtn w-50 py-1" onclick="closeaddmed()"><img src="img/close.png"
                        class="img-thumbnail img-fluid"></button>
            </div>
            <div class="inputdiv container w-100">
                <label for="brandname" class="form-label">Brand Name</label>
                <input type="text" class="form-control w-100" id="brandname" required>
                <div class="invalid-feedback" id="brandnamefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="genname" class="form-label">Generic Name</label>
                <input type="text" class="form-control w-100" id="genname" required>
                <div class="invalid-feedback" id="gennamefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" class="form-control w-100" id="quantity" required>
                <div class="invalid-feedback" id="quantityfeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="medunit" class="form-label">Unit</label>
                <input type="text" class="form-control w-100" id="medunit" required>
                <div class="invalid-feedback" id="medunitfeed">
                    Required!
                </div>
            </div>

            <div class="w-100 text-center text-center" style="float:left;">
                <button class="btn btn-dark w-25 my-4" onclick="inserttomed()">Add</button>
            </div>
            <div class="feedback w-100 text-center" id="successfeedback">
                Successfully added!
            </div>


        </div>
        <div class="custommodal p-2" id="updatemed">
            <h5 class="w-50 p-3">Update Medicine</h5>
            <div class="w-25 p-2 " style="float:right">
                <button class="closebtn w-50 py-1" onclick="closeeditmed()"><img src="img/close.png"
                        class="img-thumbnail img-fluid"></button>
            </div>
            <div class="inputdiv container w-100">
                <label for="editbrandname" class="form-label">Brand Name</label>
                <input type="text" class="form-control w-100" id="editbrandname" required>
                <div class="invalid-feedback" id="editbrandnamefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="editgenname" class="form-label">Generic Name</label>
                <input type="text" class="form-control w-100" id="editgenname" required>
                <div class="invalid-feedback" id="editgennamefeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="editquantity" class="form-label">Quantity</label>
                <input type="text" class="form-control w-100" id="editquantity" required>
                <div class="invalid-feedback" id="editquantityfeed">
                    Required!
                </div>
            </div>
            <div class="inputdiv container w-100">
                <label for="editmedunit" class="form-label">Unit</label>
                <input type="text" class="form-control w-100" id="editmedunit" required>
                <div class="invalid-feedback" id="editmedunitfeed">
                    Required!
                </div>
            </div>

            <div class="w-100 text-center text-center" style="float:left;">
                <button class="btn btn-dark w-25 my-4" onclick="updatemed(this)" id="submitbtn">Update</button>
            </div>
            <div class="feedback w-100 text-center" id="successfeedback1">
                Successfully updated!
            </div>


        </div>




</body>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>

<script>

    function updatemed(e){
        var id = e.value;
        var brand = document.getElementById("editbrandname").value;
        var genericname = document.getElementById("editgenname").value;
        var quantity = document.getElementById("editquantity").value;
        var unit = document.getElementById("editmedunit").value;
        if (brand.trim() == "" || genericname.trim() == "" || quantity == "" || unit == "") {
            if (brand.trim() == "") {
                $("#editbrandnamefeed").css('display', 'inline-block');
            }
            if (genericname.trim() == "") {
                $("#editgennamefeed").css('display', 'inline-block');
            }
            if (quantity.trim() == "") {
                $("#editquantityfeed").css('display', 'inline-block');
            }

            if (unit.trim() == "") {
                $("#editmedunitfeed").css('display', 'inline-block');
            }


        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    $("#successfeedback1").fadeIn(500).fadeOut(8000);

                }
            };
            xhttps.open("GET", "actionpage.php?medid="+ id + "&editbrand=" + brand + "&genname=" + genericname + "&quantity=" + quantity + "&unit=" + unit);
            xhttps.send();
        }
    }
    function checkall(e) {
        $(':checkbox.medcheck').prop('checked', e.checked);
    }

    function closeeditmed(){
        $("#updatemed").slideUp(500);
        updatetable();
    }

    function closeaddmed() {
        $("#addmed").slideUp(500);

    }

    function showaddmed() {
        $("#addmed").slideDown(500);

    }
    function inserttomed() {
        var brand = document.getElementById("brandname").value;
        var genericname = document.getElementById("genname").value;
        var quantity = document.getElementById("quantity").value;
        var unit = document.getElementById("medunit").value;
        if (brand.trim() == "" || genericname.trim() == "" || quantity == "" || unit == "") {
            if (brand.trim() == "") {
                $("#brandnamefeed").css('display', 'inline-block');
            }
            if (genericname.trim() == "") {
                $("#gennamefeed").css('display', 'inline-block');
            }
            if (quantity.trim() == "") {
                $("#quantityfeed").css('display', 'inline-block');
            }

            if (unit.trim() == "") {
                $("#medunitfeed").css('display', 'inline-block');
            }


        } else {
            var xhttps = new XMLHttpRequest();
            xhttps.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    updatetable();
                    $("#successfeedback").fadeIn(500).fadeOut(8000);
                    $('#brandname').val('');
                    $('#genname').val('');
                    $('#quantity').val('');
                    $('#medunit').val('');
                }
            };
            xhttps.open("GET", "actionpage.php?addmedbrand=" + brand + "&genname=" + genericname + "&quantity=" + quantity + "&unit=" + unit);
            xhttps.send();
        }

    }

    function deletemed() {
        var conf = confirm("Are you sure you want to delete this entries?");
        if (conf) {
            $(".medcheck").each(function () {
                if (this.checked) {
                    var id = this.value;
                    var xhttps = new XMLHttpRequest();
                    xhttps.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            location.reload();

                        }
                    }
                    xhttps.open("GET", "actionpage.php?deletemed=" + id);
                    xhttps.send();
                }


            });

        }
    }

    function showmedmodal(id){
        $("#updatemed").slideDown(500);
       
        var brand = document.getElementById("brand" + id).innerHTML.trim();
        var gen = document.getElementById("gen" + id).innerHTML.trim();
        var quantity = document.getElementById("quan" + id).innerHTML.trim();
        var unit = document.getElementById("unit" + id).innerHTML.trim();

        document.getElementById("editbrandname").value = brand;
        document.getElementById("editgenname").value = gen;
        document.getElementById("editquantity").value = quantity;
        document.getElementById("editmedunit").value = unit;
        document.getElementById("submitbtn").value = id;
        

    }

    function editmed() {
        var count = 0;
        var id = "";

        $(".medcheck").each(function () {
            if (this.checked) {
                count++;
                id = this.value;
            }

        });
        if (count != 1) {
            alert("Select only 1 to edit");
        } else {
            showmedmodal(id);
        }

    }
    
    function updatetable() {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("section1").innerHTML = this.responseText;
            }
        };
        xhttps.open("GET", "updatemedicinetable.php");
        xhttps.send();
    }

 
</script>

</html>