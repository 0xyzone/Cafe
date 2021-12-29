<?php
include '../dbconnection.php';
include '../globalvar.php';
$qrypending = $db->query("SELECT * FROM orders WHERE kitchen = 'Processing' ORDER BY order_no ASC");
?>
<?php foreach ($qrypending as $row) : ?>
    <?php
    date_default_timezone_set('Asia/Kathmandu');
    $d = strtotime($row['created_on']);
    $dt = date('jS M, Y h:i A', $d);
    ?>
    <div class="flex flex-col gap-2 relative w-auto dark:text-gray-800 transform duration-300">
        <div class="2xl:px-4">
            <div class="bg-gray-300 rounded-lg px-4 py-4 flex flex-col gap-2">
                <div class="flex flex-col">
                    <span class="text-2xl font-bold">Order #<?php echo $row['order_no']; ?></span>
                    <?php echo $dt; ?>
                </div>
                <table class="table table-fixed w-full">
                    <thead>
                        <tr class="thead">
                            <th class="text-left pl-4 w-10/12">Items</th>
                            <th class="text-left pl-4">Qty.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ono = $row['order_no'];
                        $itemqry = $db->query("SELECT * FROM orderitems WHERE order_no=$ono");
                        foreach ($itemqry as $nrow){
                        ?>
                        <tr>
                            <td class="text-left pl-4"><?php echo $nrow['item']; ?></td>
                            <td class="text-left pl-4"><?php echo $nrow['qty']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="<?php echo $site . 'kitchen?order=' . $row['order_no'] . '&done=1' ?>" class="transform duration-300 btn-done absolute right-2 top-4 justify-self-center">Done</a>
    </div>
<?php endforeach; ?>