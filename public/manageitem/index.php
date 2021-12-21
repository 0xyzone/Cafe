<?php
$title = "Manage Item";
include '../includes/main.php';
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
            $db->query("DELETE FROM category WHERE ID='$id'");
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
        $result = $db->query("SELECT * FROM menu WHERE ID=$id");
        $row = $result->fetch_array();
        include '../includes/alerts.php';
        ?>
        <div class="bodymain flex-col overflow-auto gap-4">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="forms fadeInTop">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="title">
                    <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Edit Category
                </div>
                <div class="forminputs">
                    <label for="category">Category Name</label>
                    <input type="text" id="category" name="category" class="fields" autocomplete="off" autofocus value="<?php echo $row['category']; ?>">
                </div>
                <div class="buttons flex w-full gap-2">
                    <button type="submit" class="btn-primary" name="update" value="update">Update</button>
                </div>
            </form>
        </div>
    <?php else : ?>
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
                                <td class="px-4 text-center text-lime-500 dark:text-lime-500"><a href="<?php echo $site . 'updatecategory/?edit=' . $row['ID']; ?>"><i class="fad fa-pencil-alt"></i></a></td>
                                <td class="px-4 text-center text-red-500 dark:text-rose-500"><a href="<?php echo $site . 'updatecategory/?delete=' . $row['ID']; ?>"><i class="fad fa-trash"></i></a></td>
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