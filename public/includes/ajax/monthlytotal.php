<?php
include '../dbconnection.php';
date_default_timezone_set('Asia/Kathmandu');
$month = date('Y-m');
$monthquery = mysqli_query($db, "SELECT total_price FROM orders WHERE created_on LIKE '$month%'");
$mqres = array();
while ($row2 = mysqli_fetch_assoc($monthquery)) {
    $mqres[] = $row2;
}
$column2 = array_column($mqres, 'total_price');
$monthly_total_income = array_sum($column2);
echo $monthly_total_income;
?>