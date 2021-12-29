<?php
$title = "Take Order";
include '../includes/main.php';
$sql = mysqli_query($db, "SELECT * FROM menu");
$last = mysqli_query($db, "SELECT * FROM orders ORDER BY order_no DESC LIMIT 1");
$reslast = mysqli_fetch_array($last);
$numrowlast = mysqli_num_rows($last);
if ($numrowlast < 1) {
    $rowLastId = 0;
} else {
    $rowLastId = $reslast['order_no'];
};
if (isset($_POST['neworder'])) {
    $stmt = $db->prepare("INSERT INTO orders(created_on, status) VALUE (?, ?)");
    $created_on = date('Y-m-d H-i-s');
    $status = "Pending";
    $stmt->bind_param('ss', $created_on, $status);
    $stmt->execute();
    $stmt->close();
    $db->close();
    header('location:' . $site . 'orders?option=neworder');
}
if (isset($_POST['addorderitem'])) {
    $stmt = $db->prepare("INSERT INTO orderitems(order_no, item, qty, total_price) VALUES (?, ?, ?, ?)");
    $item = $_POST['item'];
    $qty = $_POST['qty'];
    $ipricesql = mysqli_query($db, "SELECT * FROM menu WHERE item_name='$item'");
    $iprice = mysqli_fetch_array($ipricesql);
    $tprice = $qty * $iprice['price'];
    $stmt->bind_param('issi', $rowLastId, $item, $qty, $tprice);
    $stmt->execute();
    $stmt->close();
    $db->close();
    header('location:' . $site . 'orderitem?orderno=' . $rowLastId);
}
if (isset($_GET['cancel'])) {
    $id = $_GET['cancel'];
    $header = $site . "orders";
    $db->query("DELETE FROM orders WHERE order_no='$id'");
    header("Location:" . $header);
}
?>
<?php if (isset($_GET['option'])) : ?>
    <?php if ($_GET['option'] == "neworder") : ?>
        <div class="bodymain fadeInBottom">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="forms">
                <div class="flex gap-2 items-center text-4xl font-bold">
                    <i class="fad fa-notes-medical fa-2x dark:text-lime-500 text-lime-600"></i>
                    <div>
                        <p>Take Order</p>
                        <p class="text-lg dark:text-gray-500">Order #<?php echo $rowLastId; ?></p>
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
                    <input type="text" name="qty" id="qty" class="fields" required autocomplete="off">
                </div>
                <div class="flex gap-2 mt-4">
                    <button class="btn-primary" name="addorderitem" id="addorderitem"><i class="fad fa-plus-square fa-swap-opacity"></i> Add</button>
                    <a href="<?php echo $site . 'orderitem?cancel=' . $rowLastId; ?>" class="btn-negetive"  onclick="return confirm('Are you sure you want to cancel?')">Cancel</a>
                </div>

            </form>
        </div>
    <?php endif; ?>
    <?php
    if ($_GET['option'] == "orderlist") {
        header('location:' . $site . 'manageorder');
    }
    ?>
<?php else : ?>
    <div class="bodymain fadeInBottom">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="forms">
            <div class="title">
                <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Take Order
            </div>
            <div class="flex flex-col gap-2">
                <button name="neworder" class="bigbtn">
                    <i class="fad fa-notes-medical"></i> New Order
                </button>
            </div>
        </form>
    </div>
<?php endif; ?>