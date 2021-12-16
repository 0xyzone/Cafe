<?php
session_start();
include "globalvar.php";
$tailwind = $site.'css/tailwind.css';
$customcss = $site.'css/custom.css';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="" id="html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $tailwind; ?>">
    <link rel="stylesheet" href="<?php echo $customcss; ?>">
    <link rel="stylesheet" href="<?php echo $site.'css/css/all.css'?>">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <title>
        <?php
        if (isset($title)) {
            echo $title;
        } else {
            echo "Default Title";
        }
        ?>
    </title>
</head>
<body class="w-screen h-screen bg-gray-200 dark:bg-gray-800 dark:text-gray-100 relative transform duration-300 selection:bg-lime-500 selection:text-gray-100">
    <div class="">
        <button class="absolute top-4 right-5 bg-gray-800 text-white dark:bg-gray-200 font-bold dark:text-gray-800 rounded-full w-10 h-10" id="toggle" value="dark"><i class="far fa-moon-stars text-2xl"></i></button>
        
    </div>
    <?php if (isset($_SESSION['user'])):?>
    <a href="<?php echo $site.'security/logout.php'?>" class="absolute top-16 right-5 bg-gray-400 text-gray-800 dark:bg-gray-200 font-bold dark:text-gray-800 rounded-full w-10 h-10 flex justify-center items-center " id="toggle" title="Logout"><i class="fad fa-sign-out-alt text-2xl"></i></a>
    <?php else: ?>
    <a href="<?php echo $site.'login'?>" class="absolute top-16 right-5 bg-gray-400 text-gray-800 dark:bg-gray-200 font-bold dark:text-gray-800 rounded-full w-10 h-10 flex justify-center items-center <?php $currenturl = $_SERVER["PHP_SELF"]; if ($currenturl == "/cafe/public/login/index.php") { echo "hidden"; } ?>" id="toggle" ><i class="fad fa-sign-in-alt text-2xl"></i></a>
    <?php endif; ?>
<script src="<?php echo $site.'js/darkmode.js';?>"></script>

    
    
   