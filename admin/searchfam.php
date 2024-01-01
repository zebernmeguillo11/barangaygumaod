<?php
session_start();
include_once("connection.php");
$select = "SELECT * FROM tbl_family WHERE householdName LIKE '%" . $_GET['searchkey'] . "%' LIMIT 10";
$result = $mysqli->query($select);
while ($row = $result->fetch_assoc()) {
$select1 = "SELECT * FROM tbl_coordinates WHERE houseno ='".$row['houseNumber']."'";
$result1 = $mysqli->query($select1);
if(mysqli_num_rows($result1)==0){


    ?>
    <div class="form-check ml-2 my-0 dropdownlist">
        <input type="radio" name="familyhead" value="<?php echo $row["houseNumber"]; ?>"
            onclick="choosefam(this.value)">

        <label class="form-check-label" for="familyhead" id="family_<?php echo $row["houseNumber"];?>">
            <?php
            echo $row["householdName"];
            ?>


        </label>
    </div>

    <?php
}

}

?>

