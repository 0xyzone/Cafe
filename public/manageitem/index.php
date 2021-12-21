<?php
$title = "Manage Item";
include '../includes/main.php';

//updating an item
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $item = $_POST['item'];
    $cat = $_POST['category'];
    $prc = $_POST['price'];
    $sql = mysqli_query($db, "SELECT item_name FROM menu WHERE item_name='$item'");
    $numrow = mysqli_num_rows($sql);
    if ($numrow > 0) {
        $err = "Item already exisits!";
    } else {
        $db->query("UPDATE menu SET item_name='$item',category='$cat',price='$prc' WHERE ID=$id");
        $_SESSION['message'] = "Item updated successfully!";
        $_SESSION['msg_time'] = time();
    }
}

if (!isset($_SESSION['user'])) {
    header('location:' . $site);
} else {
    //sql query for data in menu
    $usersql = mysqli_query($db, "SELECT * FROM menu ORDER BY ID ASC");
?>
    <!-- deleting an item -->
    <?php
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = mysqli_query($db, "SELECT * FROM category");
        $numrow = mysqli_num_rows($query);
        //check if there is only 1 category
        if ($numrow < 2) {
            $err = "Atleast 1 category is reqired!";
        } else {
            $header = $site . "updatecategory";
            $db->query("DELETE FROM menu WHERE ID='$id'");
            $_SESSION['message'] = "Category deleted successfully!";
            $_SESSION['msg_time'] = time();
            header("Location:" . $header);
        }
    }
    ?>
    <!-- end deleting an item -->
    <!-- editing an item -->
    <?php if (isset($_GET['edit'])) : ?>
        <?php
        $id = $_GET['edit'];
        $res = $db->query("SELECT * FROM menu WHERE ID=$id");
        $rowres = $res->fetch_array();
        include '../includes/alerts.php';
        ?>
        <div class="bodymain flex-col overflow-auto gap-4">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="forms fadeInTop">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="title">
                    <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Edit Item
                </div>
                <div class="forminputs">
                    <label for="category">Item Name</label>
                    <input type="text" id="item" name="item" class="fields" autocomplete="off" autofocus value="<?php echo $rowres['item_name']; ?>">
                </div>
                <div class="forminputs">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="fields" required>
                        <option value="<?php echo $rowres['category']; ?>" selected hidden><?php echo $rowres['category']; ?></option>
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
                        <input type="number" class="fields pl-8 pr-3 " name="price" id="price" placeholder="Type item price..." autocomplete="off" value="<?php echo $rowres['price'] ?>">
                        <div class="absolute inset-y-0 left-0 flex items-center px-2 pointer-events-none">
                            ₹
                        </div>
                    </div>
                </div>
                <div class="buttons flex w-full gap-2">
                    <button type="submit" class="btn-primary" name="update" value="update">Update</button>
                    <a href="<?php echo $site.'manageitem'; ?>" class="btn-primary"><i class="fad fa-angle-left" style="--fa-primary-opacity: 0.20"></i> Back</a>
                </div>
            </form>
        </div>
    <?php else : ?>
        <?php include '../includes/alerts.php'; ?>
        <div class="bodymain">
            <div class="tables fadeInBottom">
                <div class="text-4xl font-bold">
                    <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a>
                    <span class="text-gray-400 dark:text-gray-500">/</span> Manage Item
                </div>
                <table class="tablemain">
                    <thead>
                        <tr class="thead">
                            <th class="px-4 py-2 rounded-l-lg smhidden">ID</th>
                            <th class="px-4 2xl:px-2 text-left w-48 md:w-52 lg:w-64 rounded-l-lg 2xl:rounded-none">Item</th>
                            <th class="px-2 2xl:px-6 text-left">Category</th>
                            <th class="px-2 2xl:px-8 text-left">Price</th>
                            <th class="px-2 2xl:px-8 text-center rounded-r-lg" colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usersql as $row) : ?>
                            <tr class="tbodyrow">
                                <td class="px-4 py-2 rounded-l-lg smhidden"><?php echo $row['ID']; ?></th>
                                <td class="px-4 2xl:px-2 text-left w-48 md:w-52 lg:w-64"><?php echo $row['item_name']; ?></td>
                                <td class="px-2 2xl:px-6 text-left"><?php echo $row['category']; ?></td>
                                <td class="px-2 2xl:px-8 text-left"><?php echo $row['price']; ?></td>
                                <td class="px-4 text-center text-lime-500 dark:text-lime-500"><a href="<?php echo $site . 'manageitem?edit=' . $row['ID']; ?>"><i class="fad fa-pencil-alt"></i></a></td>
                                <td class="px-4 text-center text-red-500 dark:text-rose-500"><a href="<?php echo $site . 'manageitem?delete=' . $row['ID']; ?>"><i class="fad fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="flex w-full justify-end">
                    <a href="<?php echo $site . 'additem' ?>" class="btn-primary">Add Item</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php } ?>