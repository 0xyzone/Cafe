<?php
$title = 'Add Category';
include '../includes/main.php';
if (!isset($_SESSION['user'])){
    header('location:'.$site);
} else {
    //sql query for data in category
    $usersql = mysqli_query($db,"SELECT * FROM category ORDER BY ID DESC LIMIT 3");
    //if form field is empty
    if ($_POST){
        if (($_POST['category']) == ""){
            $err = "Please type something in the field.";
        }else{
            if (isset($_POST['category'])){
            $category = $_POST['category'];
            $html_id = strtolower($category);
            //check if category already exists
            $check = mysqli_query($db,"SELECT * FROM category WHERE category = '$category'");
            if (mysqli_num_rows($check) > 0){
                $err = "Category already exists.";
            } else {
                $update = ("INSERT INTO category (category, html_id) VALUES ('$category', '$html_id')");
                if ($db->query($update) === TRUE){
                    $_SESSION['message'] = "Category added successfully";
                } else {
                    $err = "Error! Unable to add category.";
                }
            }
        };
        };
        
    }
    //if form submitted
?>
<?php include '../includes/alerts.php' ?>


<div class="bodymain flex-col overflow-auto gap-4">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="forms fadeInTop">
        <div class="title">
            <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Add Category
        </div>
        <div class="forminputs">
            <label for="category">Category Name</label>
            <input type="text" id="category" name="category" class="fields" autocomplete="off" autofocus>
        </div>
        <div class="buttons flex w-full gap-2">
            <button type="submit" class="btn-primary" name="add" value="add">Add</button>
            <a href="<?php echo $site.'updatecategory'?>" class="btn-primary" >Manage Category</a>
        </div>
    </form>
    <div class="tables fadeInBottom">
        <div class="secondtitle">
            Recent addition
        </div>
        <table class="table-auto border-collapse text-lg lg:text-2xl">
            <thead>
                <tr class="thead">
                    <th class="px-4 py-2 rounded-l-lg">ID</th>
                    <th class=" px-2 text-left w-48 md:w-52 lg:w-64">Category</th>
                    <th class=" px-4 text-left rounded-r-lg">html_id</th>
                </tr>
            </thead>
            <tbody id="categories">
                <?php foreach ($usersql as $row):?>
                    <tr class='tbrow'>
                        <td class="px-2 text-right"><?php echo $row['ID']; ?></td>
                        <td class="px-2 text-left"><?php echo $row['category']; ?></td>
                        <td class="px-2 text-left"><?php echo $row['html_id']; ?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php
}
?>
<script>
    setInterval(function(){
        $.ajax({url: "<?php echo $site?>includes/ajax/categories.php", success: function(response){
            $('#categories').html(response)
        }});
    }, 0);
</script>
