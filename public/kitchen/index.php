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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="notifyfields">
</form>
<div id="notify">

</div>
<audio autoplay loop=off id="audio">
    <source src="<?php echo $site . '/includes/audio/ding.wav'; ?>" type="audio/wav">
</audio>
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
                $('#notifyfields').html(response);
            }
        });
    }, 1000);
    if ($('#notify').html() > 0) {
        $('#audio').play();
    } else {
        $('#audio').pause();
    }
</script>