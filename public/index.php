<?php
$title = "Homepage";
include 'includes/header.php';
include 'includes/globalvar.php';
?>
<?php if (isset($_SESSION['user'])) : ?>
    <div class="lg:w-6/12 w-8/12 h-full mx-auto">
        <div class="flex flex-col gap-4 fadeInLeft pt-10 lg:pt-20">
            <h1 class="text-4xl lg:text-6xl">
                <?php
                date_default_timezone_set('Asia/Kathmandu');
                if (date("H") < 5) {
                    echo "Hey! Night Owl!";
                } else if ((date("H") >= 5) && (date("H") < 12)) {
                    echo "Good Morning!";
                } else if ((date("H") >= 12) && (date("H") < 17)) {
                    echo "Good Afternoon!";
                } else if (date("H") >= 17) {
                    echo "Good Evening!";
                }
                ?>
            </h1>
            <div class="flex flex-wrap gap-4 items-center text-gray-500 dark:text-gray-400 transform delay-200">
                <p class="flex gap-2">
                    <i class="fad fa-calendar-week fa-swap-opacity text-lime-600"></i> <?php echo date('d') . 'th ' . date('F') . ' ' . date('Y') . ' | ' . date('l') ?>
                </p>
                <p class="flex gap-2 ls-2">
                    <i class="fad fa-clock fa-swap-opacity text-lime-600"></i> <span id="time"></span>
                </p>
            </div>
        </div>
        <div class="w-full grid grid-cols-1 2xl:grid-cols-2 lg:gap-4 gap-2 mx-auto fadeInBottom py-10 lg:my-20">
            <?php foreach ($superadmin as $btn) : ?>
                <a href="<?php echo $site . 'admin?option=' . $btn['2'] ?>" class="bigbtn first:bg-lime-800 first:col-span-2 first:justify-center" id="<?php echo $btn['3'] ?>">
                    <?php echo $btn['1'] ?>
                    <?php echo $btn['0'] ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php else : ?>
    <div class="w-full h-full flex flex-col justify-center items-center gap-10">
        <i class="fad fa-hand-sparkles text-9xl text-lime-700 dark:text-green-300 relative"><span class=" absolute top-0 right-0"><i class="fad fa-hand-sparkles text-9xl animate-ping text-gray-700 dark:text-gray-500 opacity-30"></i></span></i>

        <span class="text-6xl lg:text-9xl font-bold text-center">RUKO ZARA!<br>SABAR KARO!</span>
        <span class="animate-bounce lg:text-2xl text-gray-500 dark:text-gray-600">Amazing stuffs coming soon!</span>

    </div>
<?php endif; ?>
<script>
    setInterval(function() {
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/time.php",
            success: function(response) {
                $('#time').html(response)
            }
        });
    }, 50);
</script>