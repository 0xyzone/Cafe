<?php
include '../dbconnection.php';
include '../globalvar.php';
date_default_timezone_set('Asia/Kathmandu');
$date = date('Y-m-d');
$qry = $db->query("SELECT * FROM orders WHERE created_on LIKE '$date%' && kitchen = 'Done' ORDER BY order_no DESC LIMIT 3");
?>
<?php foreach ($qry as $row) : ?>
    <?php
    date_default_timezone_set('Asia/Kathmandu');
    $d = strtotime($row['created_on']);
    $dt = date('jS M, Y h:i A', $d);
    ?>

    <div class="px-2">
        <div class="bg-gray-300 rounded-lg px-4 py-4 flex gap-4 mainshadow">
            <i class="fad fa-box-check fa-4x text-lime-600"></i>
            <div class="flex flex-col items-start gap-2">
                <span class="text-4xl font-bold">Order #<?php echo $row['order_no']; ?> is ready!</span>
                <p class="text-2xl text-left">Please collect your order from take out window!</p>
            </div>
        </div>
    </div>

<?php endforeach; ?>