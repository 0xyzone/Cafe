<?php
include '../dbconnection.php';
include '../globalvar.php';
date_default_timezone_set('Asia/Kathmandu');
$date = date('Y-m-d H:i:s-1');
$sql = mysqli_query($db, "SELECT * FROM orders WHERE kitchen='Notify'");
$numrow = mysqli_num_rows($sql);
echo mysqli_num_rows($sql);
?>