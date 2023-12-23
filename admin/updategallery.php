<?php
session_start();
include_once("connection.php");
?>

<p class="col-12"><b>Note: </b> Only 3 images would load at the website and would be chosen randomly</p>
        <div class=" addimage col-12 my-2">
            <button class="btn btn-dark" onclick="showaddmodal()">Add Image</button>
            <button class="btn btn-dark" onclick="deleteppic()">Delete Image</button>

        </div>


        <?php
        $sql = "SELECT * FROM tbl_picturegallery";
        $result = $mysqli->query($sql);
        while ($row = $result->fetch_assoc()) {

            ?>

            <div class="col-2 img" onclick="<?php echo "checkradio(" . $row['id'] . ")"; ?>"
                id="<?php echo "picture-" . $row["id"]; ?>">
                <img src="<?php echo "gallery/" . $row['picture_source']; ?>" alt="" class="img-thumbnail img-fluid">
                <input type="radio" name="picselector" class="picselector" id="<?php echo "houseselector-" . $row["id"]; ?>"
                    style="display:none;" value="<?php echo $row["id"]; ?>">


            </div>






            <?php
        }


        ?>

