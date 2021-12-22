<?php
if (isset($_GET['orderno'])) {
    $orderno = $_GET['orderno'];
}
$title = "Add Item for Order# " . $orderno;
include '../includes/main.php';
?>
<?php if (isset($_GET['orderno'])) : ?>
    <div class="">

    </div>
<?php endif; ?>