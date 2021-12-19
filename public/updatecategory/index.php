<?php
$title = 'Update Category';
include '../includes/dbconnection.php';
include '../includes/globalvar.php';
include '../includes/header.php';

//editing a category
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $category = $_POST['category'];
    $html_id = strtolower($category);
    $query = mysqli_query($db,"SELECT category FROM category WHERE category='$category'");
    $numrow = mysqli_num_rows($query);
    if ($numrow > 0){
        $err = "Item already exisits!";
    } else {
        $db->query("UPDATE category SET category='$category',html_id='$html_id' WHERE ID=$id");
        $_SESSION['catupdated'] = "Category updated successfully!";
    }
    
}


if (!isset($_SESSION['user'])){ //user validation
    header('location:'.$site);
} else {
    $usersql = mysqli_query($db,"SELECT * FROM category ORDER BY ID ASC");
?>

<!-- deleting an category -->
<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = mysqli_query($db,"SELECT * FROM category");
    $numrow = mysqli_num_rows($query);
    //check if there is only 1 category
    if ($numrow < 2){
        $err = "Atleast 1 category is reqired!";
    } else {
        $header = $site."updatecategory";
        $db->query("DELETE FROM category WHERE ID='$id'");
        $_SESSION['categorydeleted'] = "Category deleted successfully!";
        header("Location:".$header);
    }
}
?>
<!-- end deleting an category -->

<!-- editing an category -->
<?php if (isset($_GET['edit'])):?>
    <?php
    $id = $_GET['edit'];
    $result = $db->query("SELECT * FROM category WHERE ID=$id")  ;
    $row = $result->fetch_array();  
    ?>

    <div class="bodymain flex-col overflow-auto gap-4">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="forms fadeInTop">
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
<?php else: ?>
<!-- Notifications/Alerts -->
<?php if (isset($_SESSION['catupdated'])):?>
    <div class="w-full flex justify-center absolute top-16 lg:top-28 animate-bounce">
        <div id="updated" class="bg-green-100 dark:bg-lime-200 text-green-400 dark:text-lime-700 border-2 border-current text-lg px-4 py-2 rounded-lg w-max fadeInTop">
            <?php echo $_SESSION['catupdated']; unset($_SESSION['catupdated']); ?>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['categorydeleted'])):?>
    <div class="w-full flex justify-center absolute top-16 lg:top-28 animate-bounce">
        <div id="success" class="bg-green-100 dark:bg-lime-200 text-green-400 dark:text-lime-700 border-2 border-current text-lg px-4 py-2 rounded-lg w-max fadeInTop">
            <?php echo $_SESSION['categorydeleted']; unset($_SESSION['categorydeleted']); ?>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($err)):?>
    <div class="w-full flex justify-center absolute top-16 lg:top-28 animate-bounce">
        <div id="err" class="bg-rose-100 dark:bg-rose-200 text-rose-400 dark:text-rose-700 border-2 border-current text-lg px-4 py-2 rounded-lg w-max fadeInTop">
            <?php echo $err; ?>
        </div>
    </div>
<?php endif ?>
<script>
    setTimeout(function() {
        $('#err').fadeOut('slow');
    }, 3000); // <-- time in milliseconds
    setTimeout(function() {
        $('#success').fadeOut('slow');
    }, 3000); // <-- time in milliseconds
    setTimeout(function() {
        $('#updated').fadeOut('slow');
    }, 3000); // <-- time in milliseconds
</script>
<!-- end Notifications/Alerts -->

<!-- List of categories -->
<div class="bodymain flex-col overflow-auto gap-4">
    <div class="tables fadeInBottom">
        <div class="title">
            <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Update Category
        </div>
        
        <table class="table-auto border-collapse text-lg lg:text-2xl">
            <thead class="">
                <tr class="bg-green-700 text-gray-200 dark:bg-lime-600 rounded-lg font-bold">
                    <th class="px-4 py-2 rounded-l-lg">ID</th>
                    <th class=" px-2 text-left w-48 md:w-52 lg:w-64">Category</th>
                    <th class=" px-2 text-left">html_id</th>
                    <th class=" px-4 text-left rounded-r-lg" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody id="categories">
            </tbody>
        </table>
        <div class="flex w-full justify-end">
            <a href="<?php echo $site.'addcategory'?>" class="btn-primary" >Add Category</a>
        </div>
    </div>
</div>
<script>
    setInterval(function(){
        $.ajax({url: "<?php echo $site?>includes/ajax/categoryajax.php", success: function(response){
            $('#categories').html(response)
        }});
    }, 500);
</script>
<?php
endif; } 
?>