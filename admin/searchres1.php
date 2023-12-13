<?php
session_start();
include_once("connection.php");

$sql = "SELECT * FROM tbl_resident WHERE Lastname LIKE '%" . $_GET['searchkey'] . "%' LIMIT 10";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    ?>
    <div class="form-check ml-2 my-0 dropdownlist">
        <input type="radio" name="officialsearch" value="<?php echo $row["resident_id"]; ?>"
            onclick="chooseres(this.value)">

        <label class="form-check-label" id="<?php echo "fullname" . $row["resident_id"]; ?>">
            <?php
            echo $row["Lastname"] . ", " . $row["Firstname"] . " " . $row["Middlename"];
            ?>
        </label>
    </div>

    <?php

}

?>