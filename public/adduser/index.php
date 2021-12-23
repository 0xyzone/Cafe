<?php
$title = 'Add User';
include '../includes/main.php';
include '../includes/notadmin.php';
if (!isset($_SESSION['user'])) {
    header('location:' . $site . 'login');
}
$sql = mysqli_query($db, "SELECT * FROM userbase ORDER BY ID ASC");

if ($_POST) {
    //form validation
    if ($_POST['add']) {
        if ($_POST['username'] == "") {
            $err = "<strong>Error:</strong> Empty <strong>username</strong>";
        }
        if ($_POST['password'] == "") {
            $err = "<strong>Error:</strong> Empty <strong>password</strong>";
        }
        if (($_POST['username'] == "") && ($_POST['password'] == "")) {
            $err = "<strong>Error:</strong> Feilds are left empty!";
        }
    }
    //Adding user to database
    if ((($_POST['username']) != "") && (($_POST['password']) != "")) {
        $uname = $_POST['username'];
        //check if user already exisits
        $check = mysqli_query($db, "SELECT * FROM userbase WHERE username='$uname'");
        $numrow = mysqli_num_rows($check);
        if ($numrow > 0) {
            $err = "User already exisits!";
        } else {
            $stmt = $db->prepare("INSERT INTO userbase(created_on, username, password) VALUES (?, ?, ?)");
            $usrname = $_POST['username'];
            $pw = $_POST['password'];
            date_default_timezone_set('Asia/Kathmandu');
            $date = date('Y-m-d H:i:s');
            $stmt->bind_param('sss', $date, $usrname, $pw);
            $stmt->execute();
            $stmt->close();
            $db->close();
            $_SESSION['message'] = "User added successfully";
            $_SESSION['msg_time'] = time();
            header('location:' . $site . 'admin?option=updateusers');
        }
    }
}
?>
<div class="bodymain fadeInTop">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="forms">
        <div class="title">
            <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a>
            <span class="text-gray-400 dark:text-gray-500">/</span> Add User
        </div>
        <div class="flex flex-col gap-4">
            <div class="forminputs">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="fields" placeholder="Create a username..." autocomplete="off" autofocus>
            </div>
            <div class="forminputs">
                <label for="password">Password:</label>
                <div class="relative flex flex-col justify-center items-end">
                    <input type="text" name="password" id="password" class="fields" placeholder="**********" autocomplete="off" class="">
                </div>
            </div>
        </div>
        <div class="buttons flex w-full gap-2">
            <button type="submit" class="btn-primary" name="add" value="add">Add</button>
            <a href="<?php echo $site . 'admin?option=updateuser' ?>" class="btn-primary">Update User</a>
        </div>
    </form>
</div>
<?php
include '../includes/alerts.php';
?>