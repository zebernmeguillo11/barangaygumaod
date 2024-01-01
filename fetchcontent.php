<?php
include_once("admin/connection.php");
$sql = "SELECT * FROM tbl_family WHERE houseNumber = '".$_GET['houseno']."'";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$sql1 = "SELECT * FROM tbl_familymember WHERE houseNumber = '".$_GET['houseno']."'";
$result1 = $mysqli->query($sql1);
$member = mysqli_num_rows($result1);

?>
<div class = 'marker-desc'>
<p><b>House No.:</b> <?php echo $row['houseNumber'];?></p>
<p><b>Family Name:</b><?php echo $row['householdName'];?></p>
<p><b>No. of Member:</b><?php echo $member;?></p>

</div>