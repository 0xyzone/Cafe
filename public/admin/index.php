<?php
$title = "Admin Panel";
include '../includes/globalvar.php';
include '../includes/dbconnection.php';
include '../includes/header.php';

$usersql = mysqli_query($db,"SELECT * FROM userbase ORDER BY ID ASC");
//routing
if (isset($_GET['option'])){
    if ($_GET['option'] == "take_orders"){
        $option = $site.'orders';
        header('location:'.$option);
    }
    if ($_GET['option'] == "addcategory"){
        $option = $site.'addcategory';
        header('location:'.$option);
    }
    if ($_GET['option'] == "updatecategory"){
        $option = $site.'updatecategory';
        header('location:'.$option);
    }
}

//deleting a user
if (isset($_GET['delete'])){
    $delid = $_GET['delete'];
    //check if there is only one user
    $userquery = mysqli_query($db, "SELECT * FROM userbase");
    $numrow = mysqli_num_rows($userquery);
    if ($numrow == 1){
        $err = "Aleast 1 user is required!";
    } else {
        $db->query("DELETE FROM userbase WHERE id=$delid");
        $_SESSION['message'] = "Item deleted successfully!";
        header('location:'.$site.'admin?option=updateusers');
    }
    
}

//updating a user
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $uname = $_POST['username'];
    $pw = $_POST['password'];
    $db->query("UPDATE userbase SET username='$uname', password='$pw'");
    $_SESSION['message'] = "User updated successfully!";
}
?>



<!-- Users list -->
<?php if (isset($_GET['option']) || (isset($_SESSION['message'])) || (isset($err))): ?>
<?php if (isset($err)):?>
    <div class="w-full flex justify-center absolute top-20 lg:top-48 animate-bounce">
        <div id="err" class="bg-rose-100 dark:bg-rose-200 text-rose-400 dark:text-rose-700 border-2 border-current text-lg px-4 py-2 rounded-lg w-max fadeInTop">
            <?php echo $err; ?>
        </div>
    </div>
<?php endif ?>

<?php if (isset($_SESSION['message'])):?>
    <div class="w-full flex justify-center absolute top-20 lg:top-48 animate-bounce">
        <div id="success" class="bg-green-100 dark:bg-lime-200 text-green-400 dark:text-lime-700 border-2 border-current text-lg px-4 py-2 rounded-lg w-max fadeInTop">
            <?php echo $_SESSION['message']; unset($_SESSION['message']) ?>
        </div>
    </div>
<?php endif; ?>    
    <div class="bodymain fadeInTop">
        <div class="tables">
            <div class="text-4xl font-bold">
                <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Users
            </div>
            <table class="table-auto border-collapse text-lg lg:text-2xl">
                <head>
                    <tr class="bg-green-700 text-gray-200 dark:bg-lime-600 rounded-lg font-bold">
                        <th class="px-4 rounded-l-lg">ID</th>
                        <th class=" px-2 text-left">Username</th>
                        <th class=" px-2 text-left">Password</th>
                        <th class="px-4 rounded-r-lg text-left" colspan="2">Actions</th>
                    </tr>
                </head>
                <body>
                    <?php foreach ($usersql as $row):?>
                    <tr>
                        <td class="px-4 text-right"><?php echo $row['ID']; ?></td>
                        <td class="px-2 text-left select-all"><?php echo $row['username']; ?></td>
                        <td class="px-2 text-left select-all"><?php echo $row['password']; ?></td>
                        <td class="px-4 text-center text-lime-500 dark:text-lime-500"><a href="<?php echo $site.'admin/?edit='.$row['ID']; ?>"><i class="fad fa-pencil-alt"></i></a></td>
                        <td class="px-4 text-center text-red-500 dark:text-rose-500"><a href="<?php echo $site.'admin/?delete='.$row['ID']; ?>"><i class="fad fa-trash"></i></a></td>
                    </tr>
                    <?php endforeach;?>
                </body>
            </table>
        </div>
    </div>
<?php endif; ?>
<!-- end Users list -->

<!-- Editing a user -->
<?php if (isset($_GET['edit'])): ?>
    <?php
    $id = $_GET['edit'];
    $newsql = mysqli_query($db, "SELECT * FROM userbase WHERE ID = '$id'");
    $res = mysqli_fetch_array($newsql);
    ?>
    <div class="bodymain">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="forms">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="text-4xl font-bold">
                <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> User update
            </div>
            <div class="flex flex-col gap-4">
                <div class="forminputs">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="fields" placeholder="Enter your username..." autocomplete="off" autofocus value="<?php echo $res['username'] ;?>">
                </div>
                <div class="forminputs">
                    <label for="password">Password:</label>
                    <div class="relative flex flex-col justify-center items-end">
                        <input type="text" name="password" id="password" class="fields" placeholder="**********" autocomplete="off" class="" value="<?php echo $res['password'] ;?>">
                    </div>
                </div>
            </div>
            <div class="buttons flex w-full gap-2">
                <button type="submit" class="btn-primary" name="update" value="update">Update</button>
            </div>
        </form>

    </div>
<?php endif; ?>
<!-- end Editing a user -->

<script>
    setTimeout(function() {
        $('#err').fadeOut('slow');
    }, 3000); // <-- time in milliseconds
    setTimeout(function() {
        $('#success').fadeOut('slow');
    }, 3000); // <-- time in milliseconds
</script>