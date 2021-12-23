<?php
if (isset($_GET['orderno'])) {
    $orderno = $_GET['orderno'];
}
$title = "Add Item for Order# " . $orderno;
include '../includes/main.php';


$sql = mysqli_query($db, "SELECT * FROM menu");
if (isset($_POST['additem'])) {
    $orderno = $_POST['id'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];
    $ipricesql = mysqli_query($db, "SELECT * FROM menu WHERE item_name='$item'");
    $iprice = mysqli_fetch_array($ipricesql);
    $tprice = $qty * $iprice['price'];
    $itemquery = mysqli_query($db, "SELECT item FROM orderitems WHERE order_no='$orderno' && item='$item'");
    if (mysqli_num_rows($itemquery) > 0) {
        $itemquery = mysqli_query($db, "SELECT * FROM orderitems WHERE order_no='$orderno' && item='$item'");
        $iqres = mysqli_fetch_array($itemquery);
        $oldqty = $iqres['qty'];
        $newqty = $oldqty + $qty;
        $newtp = $newqty * $iprice['price'];
        $db->query("UPDATE orderitems SET qty='$newqty',total_price='$newtp' WHERE order_no='$orderno' && item='$item'");
        header('location:' . $site . 'orderitem?orderno=' . $orderno);
    } else {
        $stmt = $db->prepare('INSERT INTO orderitems(order_no, item, qty, total_price) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('isii', $orderno, $item, $qty, $tprice);
        $stmt->execute();
        $stmt->close();
        $db->close();
        header('location:' . $site . 'orderitem?orderno=' . $orderno);
    }
}

?>
<?php if (isset($_GET['orderno'])) : ?>
    <div class="bodymain fadeInTop">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="forms">
            <input type="text" name="id" value="<?php echo $orderno; ?>" hidden>
            <div class="flex gap-2 items-center text-4xl font-bold">
                <i class="fad fa-plus-circle fa-2x dark:text-lime-500 text-lime-600"></i>
                <div>
                    <p>Add Item</p>
                    <p class="text-lg dark:text-gray-500">Order #<?php echo $_GET['orderno']; ?></p>
                </div>
            </div>
            <div class="forminputs">
                <label for="item">Item</label>
                <select name="item" id="item" class="fields" required>
                    <option value="" hidden></option>
                    <?php foreach ($sql as $row) : ?>
                        <option value="<?php echo $row['item_name']; ?>"><?php echo $row['item_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="forminputs">
                <label for="qty">Qty.</label>
                <input type="number" name="qty" id="qty" class="fields" required>
            </div>
            <button class="btn-primary" name="additem" id="additem"><i class="fad fa-plus-square fa-swap-opacity"></i> Add</button>
        </form>
    </div>
<?php endif; ?>