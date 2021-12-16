<?php
$title = "Login";
include '../includes/header.php';
include '../includes/globalvar.php';
include '../security/validation.php';
?>
<?php if (isset($_SESSION['user'])){
    header('location:'.$site);
} else {?>
<div class="bodymain">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="forms">
        <div class="text-4xl font-bold">
            <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-300">/</span> Login
        </div>
        <div class="flex flex-col gap-4">
            <div class="forminputs">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="fields" placeholder="Enter your username..." autocomplete="off" autofocus>
            </div>
            <div class="forminputs">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="fields" placeholder="**********" autocomplete="off">
            </div>
        </div>
        <?php if (isset($err)):?>
        <div id="err" class="bg-rose-300 text-rose-700 dark:text-rose-700 border-2 border-current w-full text-xl px-4 py-2">
            <?php echo $err; ?>
        </div>
        <?php endif ?>
        <div class="buttons flex w-full gap-2">
            <button class="btn-primary">Login</button>
        </div>
        
    </form>
</div>
<script>
    setTimeout(function() {
        $('#err').fadeOut('slow');
    }, 3000); // <-- time in milliseconds
</script>
<?php } ?>