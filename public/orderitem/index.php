<?php
$title = 'Order list';
include '../includes/main.php';
if (isset($_GET['orderno'])) {
    $orderno = $_GET['orderno'];
    $sql = mysqli_query($db, "SELECT * FROM orderitems WHERE order_no='$orderno' ORDER BY order_no ASC");
    $sqlorder = mysqli_query($db, "SELECT * FROM orders WHERE order_no='$orderno'");
    $ressqlorder = mysqli_fetch_array($sqlorder);
    $status = $ressqlorder['status'];
    $numrow = mysqli_num_rows($sql);
    if ($numrow < 1) {
        header('location:' . $site);
    }
}
if (isset($_POST['confirm'])) {
    $ono = $_POST['orderno'];
    $tpt = $_POST['totalprice'];
    $db->query("UPDATE orders SET status='Paid',total_price='$tpt',kitchen='Notify' WHERE order_no='$ono'");
    header('location:' . $site.'orders');
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $odno = $_GET['orderno'];
    $header = $site . "orderitem?orderno=" . $odno;
    if ($numrow = 1){
        $db->query("DELETE FROM orders WHERE order_no='$odno'");
    }
    $db->query("DELETE FROM orderitems WHERE ID='$id'");
    header("Location:" . $header);
}
if (isset($_GET['cancel'])) {
    $id = $_GET['cancel'];
    $header = $site . "orders";
    $db->query("DELETE FROM orders WHERE order_no='$id'");
    $db->query("DELETE FROM orderitems WHERE order_no='$id'");
    header("Location:" . $header);
}
?>
<div class="bodymain flex-col gap-2">
    <div class="tables gap-10">
        <div class="flex justify-between gap-10">
            <div class="title flex flex-col gap-2">
                <div>
                    <?php if ($status == "Paid") : ?>
                        <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a>
                        <span class="text-gray-400 dark:text-gray-500">/</span>
                    <?php endif; ?>
                    Order #<?php echo $orderno; ?>
                </div>

                <span class="text-lg font-normal"><i class="fad fa-alarm-clock"></i> <?php echo $ressqlorder['created_on']; ?></span>
            </div>
            <div class="<?php if ($status == "Pending") {
                            echo 'btn-pending';
                        } else {
                            echo 'btn-paid';
                        }; ?>">
                <?php echo $status; ?>
            </div>
        </div>
        <table class="tablemain">
            <thead>
                <tr class="thead">
                    <th class="px-4 text-left w-48 md:w-52 lg:w-64 rounded-l-lg">Items</th>
                    <th class="px-2 text-left">Qty.</th>
                    <th class="px-2 text-left">Price</th>
                    <th class="px-4 text-left rounded-r-lg">Ammount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sql as $res) : ?>
                    <?php
                    $itm = $res['item'];
                    $querry = mysqli_query($db, "SELECT * FROM menu WHERE item_name='$itm'");
                    $resquerry = mysqli_fetch_array($querry);
                    ?>
                    <tr class="tbrow">
                        <td class="px-4 text-left"><?php echo $res['item']; ?></td>
                        <td class="px-2 text-left"><?php echo $res['qty']; ?></td>
                        <td class="px-2 text-left"><?php echo $resquerry['price']; ?></td>
                        <td class="px-4 text-left">
                            <span>Rs. </span><?php echo $res['total_price']; ?>
                            <?php if ($status == "Pending") : ?>
                                <a href="<?php echo $site . 'orderitem?orderno=' . $orderno . '&delete=' . $res['ID']; ?>" onclick="return confirm('Are you sure you want to delete?')">
                                    <i class="fad fa-times pl-2"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="font-bold text-gray-800 dark:text-stone-200">
                    <td colspan="3" class="text-right px-4 rounded-l-lg">Total</td>
                    <?php
                    $tpquery = mysqli_query($db, "SELECT total_price FROM orderitems WHERE order_no='$orderno'");
                    $tpres = array();
                    while ($row = mysqli_fetch_assoc($tpquery)) {
                        $tpres[] = $row;
                    }
                    $column = array_column($tpres, 'total_price');
                    $tptotal = array_sum($column);
                    ?>
                    <td class="text-left px-4 rounded-r-lg"><span>Rs. </span><?php echo $tptotal; ?></td>
                </tr>
            </tfoot>
        </table>
        <?php if ($status == "Pending") : ?>
            <div class="flex justify-between">
                <a href="<?php echo $site . 'orderitem/additem.php?orderno=' . $orderno; ?>" class="btn-secondary">Add item</a>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex justify-end gap-4">
                    <input type="text" name='orderno' id="orderno" value="<?php echo $orderno; ?>" hidden>
                    <input type="hidden" name="totalprice" value="<?php echo $tptotal; ?>">
                    <button class="btn-primary" name='confirm'>Confirm order</button>
                    <a href="<?php echo $site . 'orderitem?cancel=' . $orderno; ?>" class="btn-negetive">Cancel</a>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
?>