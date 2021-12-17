<?php
$title = "Login";
include '../includes/header.php';
include '../includes/globalvar.php';
include '../security/validation.php';
?>
<?php if (isset($_SESSION['user'])){
    header('location:'.$site);
} else {?>
<?php if (isset($err)):?>
    <div class="w-full flex justify-center absolute top-20 animate-bounce">
        <div id="err" class="bg-rose-300 text-rose-500 dark:text-rose-700 border-2 border-current text-lg px-4 py-2 rounded-lg w-max fadeInTop">
            <?php echo $err; ?>
        </div>
    </div>
<?php endif ?>
<div class="bodymain">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="forms">
        <div class="text-4xl font-bold">
            <a href="<?php echo $site; ?>"><i class="fad fa-home-lg"></i></a> <span class="text-gray-400 dark:text-gray-500">/</span> Login
        </div>
        <div class="flex flex-col gap-4">
            <div class="forminputs">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="fields" placeholder="Enter your username..." autocomplete="off" autofocus>
            </div>
            <div class="forminputs">
                <label for="password">Password:</label>
                <div class="relative flex flex-col justify-center items-end">
                    <input type="password" name="password" id="password" class="fields" placeholder="**********" autocomplete="off" class="">
                    <div class="absolute right-2 text-gray-400 hover:text-gray-700 dark:text-gray-500 dark:hover:text-gray-300 transform duration-300 ease-in-out cursor-pointer" id="eye" title="Show password"><i class="fad fa-eye"></i></div>
                </div>
                
            </div>
        </div>
        
        <div class="buttons flex w-full gap-2">
            <button type="submit" class="btn-primary" name="login" value="Login">Login</button>
        </div>
    </form>
</div>

<script>
    setTimeout(function() {
        $('#err').fadeOut('slow');
    }, 3000); // <-- time in milliseconds

    $('#eye').click(function(){
        if($('#eye').html()=='<i class="fad fa-eye"></i>'){
            $('#eye').html('<i class="fad fa-eye-slash"></i>');
            $('#eye').attr('title','Hide password');
            $('#password').attr('type','text');
        }else{
            $('#eye').html('<i class="fad fa-eye"></i>');
            $('#eye').attr('title','Show password');
            $('#password').attr('type','password');
        }
    })
</script>
<?php } ?>