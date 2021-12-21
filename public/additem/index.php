<?php
$title = "Add Item";
include '../includes/globalvar.php';
include '../includes/dbconnection.php';
include '../includes/header.php';
include '../includes/alerts.php';
?>
<div class="bodymain fadeInTop">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="forms">
        <div class="text-4xl font-bold">
            <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Add Item
        </div>
        <div class="formcontents">
            <div class="forminputs">
                <label for="item">
                    Item Name
                </label>
                <input type="text" class="fields" name="item" id="item" placeholder="Type item name..." autocomplete="off" autofocus>
            </div>
            <div class="forminputs">
                <label for="price">
                    Item Price
                </label>
                <div class="flex gap-2 ">
                    <span>Rs.</span><input type="number" class="fields " name="price" id="price" placeholder="Type item price..." autocomplete="off">
                </div>
                
            </div>
        </div>
    </form>

</div>