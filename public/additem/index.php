<?php
$title = "Add Item";
include '../includes/main.php';
if (!isset($_SESSION['user'])) {
    header('location:' . $site);
} else {
    //sql query for data in category
    $usersql = mysqli_query($db, "SELECT * FROM menu ORDER BY ID DESC LIMIT 3");
    //if form field is empty
    if ($_POST) {
        $stmt = $db->prepare("INSERT INTO menu(item_name, category, price, created_on) VALUES (?, ?, ?, ?)");
        $item = $_POST['item'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $date = date('Y-m-d H:i:s');
        $check = mysqli_query($db, "SELECT * FROM menu WHERE item_name='$item'");
        $numrow = mysqli_num_rows($check);
        if ($numrow > 0) {
            $err = "Item already exisits!";
        } else {
            $stmt->bind_param('ssis', $item, $category, $price, $date);
            $stmt->execute();
            $stmt->close();
            $db->close();
            $_SESSION['message'] = "Item added successfully";
            $_SESSION['msg_time'] = time();
            header('location:' . $site . 'manageitem');
        }
    };
    //if form submitted

?>
    <?php include '../includes/alerts.php' ?>
    <div class="bodymain flex-col overflow-auto gap-4">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="forms fadeInTop">
            <div class="text-4xl font-bold">
                <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Add Item
            </div>
            <div class="formcontents">
                <div class="forminputs">
                    <label for="item">
                        Item Name
                    </label>
                    <input type="text" class="fields peer " name="item" id="item" placeholder="Type item name..." autocomplete="off" autofocus value="">
                </div>
                <div class="forminputs">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="fields" required>
                        <option value="" hidden></option>
                        <option value="" disabled class="text-lg disabled:text-lime-600 font-bold">Choose a category</option>
                        <?php
                        $catquery = mysqli_query($db, "SELECT * FROM category ORDER BY ID ASC")
                        ?>
                        <?php foreach ($catquery as $row) : ?>
                            <option value="<?php echo $row['category']; ?>" class="text-xl dark:odd:bg-gray-500 even:bg-gray-700" id="<?php echo $row['html_id']; ?>"><?php echo $row['category']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="forminputs">
                    <label for="price">
                        Item Price
                    </label>
                    <div class="flex gap-2 items-center relative">
                        <input type="number" class="fields pl-8 pr-3 " name="price" id="price" placeholder="Type item price..." autocomplete="off" maxlength="4" value="" required>
                        <div class="absolute inset-y-0 left-0 flex items-center px-2 pointer-events-none">
                            ₹
                        </div>
                    </div>
                </div>
                <div class="buttons flex w-full gap-2">
                    <button type="submit" class="btn-primary" name="additem" value="additem">Add</button>
                    <a href="<?php echo $site . 'manageitem' ?>" class="btn-primary">Manage Items</a>
                </div>
            </div>
        </form>
        <div class="tables fadeInBottom">
            <div class="secondtitle">
                Recent addition
            </div>
            <table class="tablemain">
                <thead>
                    <tr class="thead">
                        <th class="px-4 py-2 rounded-l-lg">ID</th>
                        <th class=" px-2 text-left w-48 md:w-52 lg:w-64">Item</th>
                        <th class=" px-6 text-left">Category</th>
                        <th class=" px-8 text-left rounded-r-lg 2xl:rounded-none">Price</th>
                        <th class=" px-8 text-center rounded-r-lg smhidden">Added on</th>
                    </tr>
                </thead>
                <tbody id="categories">
                    <?php foreach ($usersql as $row) : ?>
                        <tr class='tbrow'>
                            <td class="px-2 text-right"><?php echo $row['ID']; ?></td>
                            <td class="px-2 text-left"><?php echo $row['item_name']; ?></td>
                            <td class="px-6 text-left"><?php echo $row['category']; ?></td>
                            <td class="px-2 text-center"><span>₹ </span><?php echo $row['price']; ?></td>
                            <td class="px-2 text-center smhidden"><?php echo $row['created_on']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>