<?php
$title = 'Order list';
include '../includes/main.php';
if (isset($_GET['orderno'])) {
    $orderno = $_GET['orderno'];
    $sql = mysqli_query($db, "SELECT * FROM orderitems WHERE order_no='$orderno' ORDER BY order_no ASC");
    $sqlorder = mysqli_query($db, "SELECT * FROM orders WHERE order_no='$orderno'");
    $ressqlorder = mysqli_fetch_array($sqlorder);
    $status = $ressqlorder['status'];
}
if (isset($_POST['confirm'])) {
    $ono = $_POST['orderno'];
    $db->query("UPDATE orders SET status='Paid' WHERE order_no='$ono'");
    header('location:' . $site);
}
?>
<div class="bodymain flex-col gap-2">
    <div class="tables gap-10">
        <div class="flex justify-between gap-10">
            <div class="title flex flex-col">
                Order #<?php echo $orderno; ?>
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
                        <td class="px-4 text-left"><span>Rs. </span><?php echo $res['total_price']; ?></td>
                    </tr>
                <?php endforeach; ?>
                    <tr class="bg-slate-600 font-bold">
                        <td colspan="3" class="text-right px-4 py-2">Total</td>
                        <?php
                        $tpquery = mysqli_query($db, "SELECT total_price FROM orderitems WHERE order_no='$orderno'");
                        $tpres = mysqli_fetch_array($tpquery);
                        $tptotal = array_sum($tpres);
                        ?>
                        <td class="text-left px-4"><span>Rs. </span><?php echo $tptotal; ?></td>
                    </tr>
            </tbody>
        </table>
        <?php if ($status == "Pending") : ?>
            <div class="flex justify-between">
                <a href="<?php echo $site . 'orderitem/additem.php?orderno=' . $orderno; ?>" class="btn-secondary">Add item</a>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="flex justify-end gap-4">
                    <input type="text" name='orderno' id="orderno" value="<?php echo $orderno; ?>" hidden>
                    <button class="btn-primary" name='confirm'>Confirm order</button>
                    <a href="<?php echo $site . 'orderitem?delete=' . $orderno; ?>" class="btn-negetive">Cancel</a>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>