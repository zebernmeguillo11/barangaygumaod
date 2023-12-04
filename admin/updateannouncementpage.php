<?php
session_start();
include_once("connection.php");

?>


<?php
            $sql = "SELECT * FROM tbl_announcement ORDER BY date DESC";
            $result = $mysqli->query($sql);
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class=" row section bg-light border-right border-bottom my-1 py-2">
                    <div class="col-5 text-center ">
                        <img src="<?php echo "pics/" . $row["img"]; ?>" class="img-thumbnail img-fluid w-75"
                            style="height:35vh;">
                        <input type="hidden" value="<?php echo htmlentities($row["img"]); ?>"
                            id="<?php echo "pic" . htmlentities($row['id']); ?>">
                    </div>
                    <div class="col-7">
                        <div class="w-100">
                            <h5 class="pb-0 mb-0" id="<?php echo "title" . htmlentities($row['id']); ?>">
                                <?php echo $row["title"]; ?>
                            </h5>
                            <small class="text-muted">
                                <?php
                                $date = date_create($row['date']);
                                echo date_format($date, "M d, Y H:ia");

                                ?>
                            </small>
                        </div>
                        <div class="w-100">
                            <p class="post-desc" id="<?php echo "desc" . htmlentities($row['id']); ?>">
                                <?php
                                echo $row['description'];

                                ?>
                            </p>

                        </div>
                        <div class="postbtn w-50 text-right">
                            <button class="btn bg-info w-25 btn1" value="<?php echo $row["id"]; ?>"
                                onclick="showedit(this.value)">Edit</button>
                            <button class="btn bg-info w-25 btn1" value="<?php echo $row["id"]; ?>"
                                onclick="deleteannounce(this.value)">Delete</button>
                        </div>

                    </div>

                </div>
                <?php
            }
            ?>