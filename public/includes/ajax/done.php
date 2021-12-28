<?php
include '../dbconnection.php';
include '../globalvar.php';
date_default_timezone_set('Asia/Kathmandu');
$date = date('Y-m-d');
$qry = $db->query("SELECT * FROM orders WHERE created_on LIKE '$date%' && kitchen = 'Done'");
?>
<?php foreach ($qry as $row) : ?>
    <?php
    date_default_timezone_set('Asia/Kathmandu');
    $d = strtotime($row['created_on']);
    $dt = date('jS M, Y h:i A', $d);
    ?>
    <div class="flex flex-col items-center gap-2 relative w-auto dark:text-gray-800 transform duration-300">
        <div class="px-4">
            <div class="bg-gray-300 rounded-lg px-4 py-4 flex gap-4 mainshadow">
            <i class="fad fa-box-check fa-3x text-lime-600"></i>
                <div class="flex flex-col">
                    <span class="text-2xl font-bold">Order #<?php echo $row['order_no']; ?> is ready!</span>
                <p class="text-2xl">Please collect your order from take out window!</p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>