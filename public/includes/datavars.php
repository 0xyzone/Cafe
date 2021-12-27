<?php
include '../includes/main.php';
$date = date('Y-m-d');
$month = date('Y-m');
$tpquery = mysqli_query($db, "SELECT total_price FROM orders WHERE created_on LIKE '$date%'");
$monthquery = mysqli_query($db, "SELECT total_price FROM orders WHERE created_on LIKE '$month%'");
$tpres = array();
while ($row = mysqli_fetch_assoc($tpquery)) {
    $tpres[] = $row;
};
$mqres = array();
while ($row2 = mysqli_fetch_assoc($monthquery)) {
    $mqres[] = $row2;
}
$column = array_column($tpres, 'total_price');
$column2 = array_column($mqres, 'total_price');
$today_total_income = array_sum($column);
$monthly_total = array_sum($column2);
?>