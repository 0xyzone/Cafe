<?php
$title = 'Admin - Dashboard';
include '../includes/datavars.php';
if ($_SESSION['user'] != 'admin'){
    header('location:'.$site);
}
?>
<div>

</div>