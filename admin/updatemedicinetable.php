<?php
session_start();
include_once("connection.php");
?>


<table class="w-100 text-center table table-light table-striped">
    <thead class="thead-dark text-center">
        <tr>
            <th><input type="checkbox" title="Select All" id="selectallcheckbox" onclick="checkall(this)"></th>
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
                <td><input type="checkbox" title="Select." id="<?php echo "med" . htmlentities($row["medicine_id"]); ?>"
                        class="medcheck" value="<?php echo $row["medicine_id"] ?>"></td>
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