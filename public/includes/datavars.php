<?php
include '../includes/main.php';
$date = date('Y-m-d');
$tpquery = mysqli_query($db, "SELECT total_price FROM orders WHERE created_on LIKE '$date%'");
$tpres = array();
while ($row = mysqli_fetch_assoc($tpquery)) {
    $tpres[] = $row;
}
$column = array_column($tpres, 'total_price');
$today_total_income = array_sum($column);
print_r($today_total_income);
?>