<?php
$title = "Kitchen";
include '../includes/main.php';
if (!isset($_SESSION['user'])) {
    header('location:' . $site);
}
$qry = $db->query("SELECT * FROM orders WHERE kitchen = 'Notify'");
$qryres = mysqli_fetch_array($qry);

if (isset($_GET['process'])) {
    $process = "Processing";
    $ordernum = $_GET['order'];
    $db->query("UPDATE orders SET kitchen='$process' WHERE order_no='$ordernum'");
}
if (isset($_GET['done'])) {
    $process = "Done";
    $ordernum = $_GET['order'];
    $db->query("UPDATE orders SET kitchen='$process' WHERE order_no='$ordernum'");
}

?>
<div class="bodymain">
    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 ">
        <div class="flex flex-col gap-4">
            <div class="bg-stone-700 text-gray-100 dark:bg-gray-700 px-4 py-2 rounded-lg text-xl font-bold">
                New Orders
            </div>
            <div class="flex flex-col gap-2 relative w-auto dark:text-gray-800 transform duration-300" id="neworders">
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <div class="bg-stone-700 text-gray-100 dark:bg-gray-700 px-4 py-2 rounded-lg text-xl font-bold">
                Processing Orders
            </div>
            <div class="flex flex-col gap-2 relative w-auto dark:text-gray-800 transform duration-300" id="processing">
            </div>
        </div>
    </div>
</div>

<script>
    setInterval(function() {
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/neworder.php",
            success: function(response) {
                $('#neworders').html(response);
            }
        });
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/pending.php",
            success: function(response) {
                $('#processing').html(response);
            }
        });
    }, 1000);
</script>