<?php
$title = "Kitchen";
include '../includes/main.php';
if (!isset($_SESSION['user'])) {
    header('location:' . $site);
}
$qry = $db->query("SELECT * FROM orders WHERE kitchen = 'Notify'");
if ($_POST) {
    if (isset($_POST['process'])) {
        $process = "Processing";
        $ordernum = $_POST['order'];
        $db->query("UPDATE orders SET kitchen='$process' WHERE order_no='$ordernum'");
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<?php if (mysqli_num_rows($qry) >= 1){ ?>
    <?php foreach ($qry as $rw) : ?>
        <input type="hidden" name="order" value="<?php echo $rw['order_no']; ?>">
        <button name="process">Process</button>
    <?php endforeach; } ?>
</form>
<div id="notify">

</div>

<script>
    setInterval(function() {
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/kitchen.php",
            success: function(response) {
                $('#notify').html(response);
            }
        });
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/kitchen_orders.php",
            success: function(response) {
                $('#notify').html(response);
            }
        });
    }, 1000);
</script>