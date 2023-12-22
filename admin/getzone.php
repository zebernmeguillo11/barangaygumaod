<?php
session_start();
include_once("connection.php");
$sql = "SELECT * FROM tbl_family WHERE purok = '" . $_GET["zone"] . "'";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    $sql1 = "SELECT * FROM tbl_houseincanvas WHERE housenumber = '" . $row['houseNumber'] . "'";
    $result1 = $mysqli->query($sql1);
    if (mysqli_num_rows($result1) == 0) {
        ?>
        <div class="house col-12" onclick="<?php echo "checkradio(".$row['houseNumber'].")";?>" id="<?php echo htmlentities("houseno-".$row["houseNumber"]);?>" >
            <input type="radio" name="houseselector" class="houseselector" id="<?php echo "houseselector-".$row["houseNumber"];?>" style="display:none;" value="<?php echo $row["houseNumber"]; ?>">
            <img src="img/house.png" class="img-thumbnail img-fluid my-2 bg-info">

            <p class="text-center w-100 householdname" id="<?php echo htmlentities("householdname-".$row["houseNumber"]);?>"><?php echo $row["householdName"]." family";?></p>
        </div>


        <?php

    }
}
?>