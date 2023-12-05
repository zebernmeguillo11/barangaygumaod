<?php
session_start();
include_once("connection.php");

?>


<table class="w-100 text-center table table-light table-striped">
    <thead class="thead-dark text-center">
        <tr>
            <th><input type="checkbox" title="Select All" id="selectallcheckbox" onclick="checkall(this)"></th>
            <th>Position</th>
            <th>Name</th>
        </tr>
    </thead>

    <?php
    $sql = "SELECT * FROM tbl_officials ORDER BY position_id ASC";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr class="align-middle">
            <td class="align-middle"> <input type="checkbox" title="Select" class="officecheck"  value="<?php echo $row['id'];?>" >
            </td>
            <td class="align-middle">
                <?php
                $sql1 = "SELECT * FROM tbl_position WHERE id = '" . $row["position_id"] . "'";
                $result1 = $mysqli->query($sql1);
                $row1 = $result1->fetch_assoc();
                echo $row1["name"];
                ?>

            </td>
            <td class="align-middle">
                <?php
                $sql2 = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row["resident_id"] . "'";
                $result2 = $mysqli->query($sql2);
                $row2 = $result2->fetch_assoc();
                ?>
                <img src="<?php echo htmlentities("pics1/" . $row['img']); ?>" class="img-thumbnail img-fluid"
                    style="height: 5rem;">

                <?php
                echo $row2["Lastname"] . ", " . $row2["Firstname"] . " " . $row2["Middlename"];
                ?>
            </td>
        </tr>







        <?php
    }


    ?>
</table>
<button class="btn-info w-25" onclick="showaddofficial()">Add</button>
<button class="btn-info w-25">Delete</button>
</div>