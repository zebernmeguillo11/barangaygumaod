<?php
session_start();
require_once("connection.php");
?>

<table class="w-100 text-center table table-striped table-hover table-light">
    <thead class="thead-dark text-center">
        <tr>

            <th><input type="checkbox" title="Select All" id="selectallcheckbox3" onclick="checkall1(this)"></th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Gender</th>
            <th>Birthdate</th>
            <th>Marital Status</th>
        </tr>
    </thead>
    <?php
    $sqlmax1 = "SELECT * FROM tbl_resident";
    $resultmax1 = $mysqli->query($sqlmax1);
    $offset1 = ($_SESSION['page1'] - 1) * $_SESSION['limit1'];
    $sql1 = "SELECT * FROM tbl_resident ORDER by Lastname LIMIT " . $offset1 . ", " . $_SESSION['limit1'];
    $result1 = $mysqli->query($sql1);
    $totalrows1 = mysqli_num_rows($resultmax1);
    $result1 = $mysqli->query($sql1);
    $totalpage1 = ceil($totalrows1 / $_SESSION['limit1']) + 1;

    while ($row1 = $result1->fetch_assoc()) {
        ?>
        <tr>
            <td><input type="checkbox" title="Select" class="rescheck" value="<?php echo $row["resident_id"]; ?>"></td>
            <td id="<?php echo "lastname".$row1["resident_id"];?>">
                <?php echo $row1["Lastname"]; ?>
            </td>
            <td id="<?php echo "firstname".$row1["resident_id"];?>">
                <?php echo $row1["Firstname"]; ?>
            </td>
            <td id="<?php echo "middlename".$row1["resident_id"];?>">
                <?php echo $row1["Middlename"]; ?>
            </td>
            <td id="<?php echo "gender".$row1["resident_id"];?>">
                <?php echo $row1["Gender"]; ?>
            </td>
            <td >
            <input id="<?php echo "bday".$row1["resident_id"];?>" type="date" value="<?php echo $row1["Birthdate"]; ?>" style="display:none;">
                <?php
                $date = date_create($row1['Birthdate']);
                echo date_format($date, "M d, Y"); ?>
            </td>
            <td id="<?php echo "status".$row1["resident_id"];?>">
                <?php echo $row1["m_status"]; ?>
            </td>
        </tr>
        <?php


    }


    ?>
</table>
<div id="pageholder" class="col-sm-12 col-md-12 col-md-12 mb-1" style="text-align: center;">

    <?php
    $buttonnum1 = 1;
    while ($buttonnum1 < $totalpage1) {
        if ($_SESSION['page1'] == $buttonnum1) {
            ?>
            <button class="pagebutton btn btn-secondary" value="<?php echo htmlentities($buttonnum1); ?>"
                onclick="setpage1(this.value)">
                <?php echo $buttonnum1; ?>
            </button>
            <?php
        } else {
            ?>
            <button class="pagebutton btn btn-primary" value="<?php echo htmlentities($buttonnum1); ?>"
                onclick="setpage1(this.value)">
                <?php echo $buttonnum1; ?>
            </button>
            <?php
        }

        ?>




        <?php
        $buttonnum1++;
    }



    ?>
</div>

<div class="w-75 my-2">
    <button class="btn bg-dark text-light w-25" onclick="showaddres()">Add</button>
    <button class="btn bg-dark text-light w-25" onclick="deleteres()">Delete</button>
    <button class="btn bg-dark text-light w-25" onclick="editres()">Edit</button>
</div>