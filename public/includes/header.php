<script>
    
</script>
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
<body class="w-screen h-screen bg-gray-200 dark:bg-gray-800 dark:text-gray-100 relative transform duration-300">
    
    <button class="absolute top-2 right-2 bg-gray-800 text-white dark:bg-gray-200 font-bold dark:text-gray-800 w-8 h-8 flex gap-2 rounded-full justify-center items-center" id="toggle" value="dark">
    <i class="far fa-moon-stars"></i>
    </button>
    
    
    <script src="js/darkmode.js">
        
    </script>
    