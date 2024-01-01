<?php
session_start();
include_once("connection.php");

$sql = "SELECT * FROM tbl_resident WHERE Lastname LIKE '%" . $_GET['searchkey'] . "%' LIMIT 10";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    ?>
    <div class="form-check ml-2 my-0 dropdownlist">
        <input type="radio" name="familyhead" value="<?php echo $row["houseNumber "]; ?>"
            onclick="chooseres(this.value)">

        <label class="form-check-label" id="<?php echo "family" . $row["houseNumber "]; ?>">
            <?php
            echo $row["householdName"];
            ?>
        </label>
    </div>

    <?php

}

?>