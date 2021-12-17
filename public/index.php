<?php
$title = "Homepage";
include 'includes/header.php';
include 'includes/globalvar.php';
?>
<?php if (isset($_SESSION['user'])): ?>
    <div></div>
<?php else: ?>
    <div class="w-full h-full flex flex-col justify-center items-center gap-10">
        <i class="fad fa-hand-sparkles text-9xl text-lime-700 dark:text-green-300 relative"><span class=" absolute top-0 right-0"><i class="fad fa-hand-sparkles text-9xl animate-ping text-gray-700 dark:text-gray-500 opacity-30"></i></span ></i>
        
        <span class="text-6xl lg:text-9xl font-bold text-center">RUKO ZARA!<br>SABAR KARO!</span>
        <span class="animate-bounce lg:text-2xl text-gray-500 dark:text-gray-600">Amazing stuffs coming soon!</span>
        
    </div>
<?php endif; ?>
