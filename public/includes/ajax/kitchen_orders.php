<?php
include '../dbconnection.php';
include '../globalvar.php';
date_default_timezone_set('Asia/Kathmandu');
$date = date('Y-m-d H:i:s-1');
$qry = $db->query("SELECT * FROM orders WHERE kitchen = 'Notify'");
$sql = mysqli_query($db, "SELECT * FROM orders WHERE kitchen='Notify'");
$numrow = mysqli_num_rows($sql);
if (mysqli_num_rows($sql) > 0){
    foreach ($qry as $raw){
        $odrno = $raw['order_no'];
        echo '<input type="hidden" name="order" value="'.$odrno.'">
        <button class="btn-primary" name="process">Process</button>';
    }
}
?>