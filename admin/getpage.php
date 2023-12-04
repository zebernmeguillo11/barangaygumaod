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

    $offset = ($_SESSION['page'] - 1) * $_SESSION['limit'];
    $sqlmax = "SELECT * FROM tbl_family";
    $resultmax = $mysqli->query($sqlmax);

    $sql = "SELECT * FROM tbl_family ORDER by householdName ASC LIMIT " . $offset . ", " . $_SESSION['limit'];
    $result = $mysqli->query($sql);
    $totalrows = mysqli_num_rows($resultmax);
    $result = $mysqli->query($sql);
    $totalpage = ceil($totalrows / $_SESSION['limit']) + 1;

    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><input type="checkbox" title="Select" class="famcheck" value="<?php echo $row["houseNumber"]; ?>"></td>

            <td id="houseno-<?php echo $row['houseNumber']; ?>">
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
<div id="pageholder" class="col-sm-12 col-md-12 col-md-12 mb-1" style="text-align: center;">
    <?php
    $buttonnum = 1;
    while ($buttonnum < $totalpage) {
        if ($_SESSION['page'] == $buttonnum) {
            ?>
            <button class="pagebutton btn btn-secondary" value="<?php echo htmlentities($buttonnum); ?>"
                onclick="setpage(this.value)">
                <?php echo $buttonnum; ?>
            </button>
            <?php
        } else {
            ?>
            <button class="pagebutton btn btn-primary" value="<?php echo htmlentities($buttonnum); ?>"
                onclick="setpage(this.value)">
                <?php echo $buttonnum; ?>
            </button>
            <?php
        }

        ?>




        <?php
        $buttonnum++;
    }



    ?>

</div>
<div class="w-75 my-2">
    <button class="btn bg-dark text-light w-25" onclick="showaddfam()">Add</button>
    <button class="btn bg-dark text-light w-25" onclick="deletefamily()">Delete</button>
    <button class="btn bg-dark text-light w-25" onclick="editfamily()">Edit</button>
</div>