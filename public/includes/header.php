<?php
session_start();
date_default_timezone_set('Asia/Kathmandu');
include "globalvar.php";
include "btns.php";
$tailwind = $site . 'css/tailwind.css';
$customcss = $site . 'css/custom.css';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="" id="html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $tailwind; ?>">
    <link rel="stylesheet" href="<?php echo $customcss; ?>">
    <link rel="stylesheet" href="<?php echo $site . 'css/css/all.css' ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../js/push.js"></script>
    <script src="../js/push.js.map"></script>
    <script src="../js/push.min.js"></script>
    <script src="../js/push.min.js.map"></script>
    <script src="../js/serviceWorker.min.js"></script>
    <script src="../js/serviceWorker.min.js.map"></script>
    <link rel="shortcut icon" href="<?php echo $site; ?>includes/img/logo.ico" type="image/x-icon">
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

<body class="w-full h-full bg-slate-200 dark:bg-gray-800 dark:text-gray-100 relative transform duration-300 selection:bg-lime-500 selection:text-green-800 bg-gif overflow-x-hidden overflow-y-scroll scrolls">
    
    <div class="">
        <button class="darkmodetoggle <?php $currenturl = $_SERVER["PHP_SELF"]; if ($currenturl == "/cafe/public/login/index.php") { echo " right-5"; } else { echo " right-20"; } ?>" id="toggle" value="dark"><i class="far fa-moon-stars text-2xl"></i></button>
    </div>
    <?php if (isset($_SESSION['user'])) : ?>
        <a href="<?php echo $site . 'security/logout.php' ?>" class="loginout" id="toggle" title="Logout"><i class="fad fa-sign-out-alt text-2xl"></i></a>
    <?php else : ?>
        <a href="<?php echo $site . 'login' ?>" class="loginout <?php if ($currenturl == "/cafe/public/login/index.php") { echo "hidden"; } ?>" id="toggle"><i class="fad fa-sign-in-alt text-2xl"></i></a>
    <?php endif; ?>
    <script src="<?php echo $site . 'js/darkmode.js'; ?>"></script>