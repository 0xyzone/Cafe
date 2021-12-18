<?php
$title = "Admin Panel";
include '../includes/globalvar.php';
include '../includes/dbconnection.php';
include '../includes/header.php';

if (isset($_GET['option'])){
    if ($_GET['option'] == "take_orders"){
        $orders = $site.'orders';
        header('location:'.$orders);
    }
}

$usersql = mysqli_query($db,"SELECT * FROM userbase ORDER BY ID ASC");

if (isset($_GET['delete'])){
    $delid = $_GET['delete'];
    $delete = 
}
?>

<!-- Users list -->
<?php if (isset($_GET['option']) && ($_GET['option'] == "updateusers")): ?>
    
    <div class="bodymain">
        <div class="tables">
            <div class="text-4xl font-bold">
                <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Users
            </div>
            <table class="table-auto border-collapse text-lg lg:text-2xl">
                <head>
                    <tr class="bg-green-700 text-gray-200 dark:bg-lime-600 rounded-lg font-bold">
                        <th class="px-2 rounded-l-lg">ID</th>
                        <th class=" px-2 text-left">Username</th>
                        <th class=" px-2 text-left">Password</th>
                        <th class="px-2 rounded-r-lg text-left" colspan="2">Actions</th>
                    </tr>
                </head>
                <body>
                    <?php foreach ($usersql as $row):?>
                    <tr>
                        <td class="px-2 text-right"><?php echo $row['ID']; ?></td>
                        <td class="px-2 text-left select-all"><?php echo $row['username']; ?></td>
                        <td class="px-2 text-left select-all"><?php echo $row['password']; ?></td>
                        <td class="px-2 text-center text-lime-500 dark:text-lime-500"><a href="<?php echo $site.'admin/?edit='.$row['ID']; ?>"><i class="fad fa-pencil-alt"></i></a></td>
                        <td class="px-5 text-center text-red-500 dark:text-rose-500"><a href="<?php echo $site.'admin/?delete='.$row['ID']; ?>"><i class="fad fa-trash"></i></a></td>
                    </tr>
                    <?php endforeach;?>
                </body>
            </table>
        </div>
    </div>
<?php endif; ?>
<!-- end Users list -->

<!-- Updating a user -->
<?php if (isset($_GET['edit'])): ?>
    <?php
    $id = $_GET['edit'];
    $newsql = mysqli_query($db, "SELECT * FROM userbase WHERE ID = '$id'");
    $res = mysqli_fetch_array($newsql);
    ?>
    <div class="bodymain">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="forms">
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
<!-- end Updating a user -->