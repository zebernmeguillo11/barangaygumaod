<?php
session_start();
require_once("connection.php");
?>
<table class="w-100 text-center table table-striped table-hover table-light">
    <thead class="thead-dark text-center">
        <tr>
            <th><input type="checkbox" title="Select All" class="selectallcheckbox" onclick="checkall(this)"></th>
            <th>Household No.</th>
            <th>Family Name</th>
            <th>Purok</th>
        </tr>
    </thead>
    <?php

  
    $sql = "SELECT * FROM tbl_family WHERE householdName  LIKE '%" . $_GET['searchkey'] . "%'";
    $result = $mysqli->query($sql);

    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><input type="checkbox" title="Select" class="famcheck" value="<?php echo $row["houseNumber"]; ?>"></td>

            <td id="houseno-<?php echo $row['houseNumber']; ?>" class="familydata" onclick="showfamily(this.id)">
                <?php echo $row["houseNumber"]; ?>
            </td>
            <td id="housename-<?php echo $row['houseNumber']; ?>">
                <?php echo $row["householdName"]; ?>
            </td>
            <td id="purok-<?php echo $row['houseNumber']; ?>">
                <?php echo $row["purok"]; ?>
            </td>
        </tr>
        <?php


    }


    ?>
</table>

<div class="w-75 my-2">
    <button class="btn bg-dark text-light w-25" onclick="showaddfam()">Add</button>
    <button class="btn bg-dark text-light w-25" onclick="deletefamily()">Delete</button>
    <button class="btn bg-dark text-light w-25" onclick="editfamily()">Edit</button>
</div>