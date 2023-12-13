<?php
session_start();
include_once("connection.php");


?> 
 
 
 <table class="w-100 text-center table table-striped table-hover table-light">
                <thead class="thead-dark text-center">
                    <tr>
                        <th><input type="checkbox" onchange="checkall(this)"></th>
                        <th>Name</th>
                        <th>Relation</th>
                    </tr>
                </thead>
                <?php
                $query = "SELECT * FROM tbl_familymember WHERE houseNumber = '" . $_GET['famid'] . "'";
                $result1 = $mysqli->query($query);
                while ($row1 = $result1->fetch_assoc()) {
                    $select = "SELECT * FROM tbl_resident WHERE resident_id = '" . $row1['resident_id'] . "'";
                    $result2 = $mysqli->query($select);
                    $row2 = $result2->fetch_assoc();
                    $fullname = $row2["Lastname"] . ", " . $row2["Firstname"];
                    ?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $row1["id"]; ?>" class="famcheck"></td>
                        <td>
                            <?php echo $fullname; ?>
                        </td>
                        <td>
                            <?php echo $row1['Position']; ?>
                        </td>
                    </tr>
                    <?php
                }

                ?>
            </table>
            <div class="w-75">
                <button class="w-25 btn btn-info" onclick="showaddmember()">Add</button>
                <button class="w-25 btn btn-info" onclick="deleteres()">Delete</button>
            </div>
        </div>