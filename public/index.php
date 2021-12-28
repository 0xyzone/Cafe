<?php
$title = "Homepage";
include 'includes/main.php';
$date = date('Y-m-d');
$tpquery = mysqli_query($db, "SELECT total_price FROM orders WHERE created_on LIKE '$date%'");
$tpres = array();
while ($row = mysqli_fetch_assoc($tpquery)) {
    $tpres[] = $row;
}
$column = array_column($tpres, 'total_price');
$today_total_income = array_sum($column);
$month = date('Y-m');
$monthquery = mysqli_query($db, "SELECT total_price FROM orders WHERE created_on LIKE '$month%'");
$mqres = array();
while ($row2 = mysqli_fetch_assoc($monthquery)) {
    $mqres[] = $row2;
}
$column2 = array_column($mqres, 'total_price');
$monthly_total_income = array_sum($column2);
?>
<?php if (isset($_SESSION['user'])) : ?>
    <?php
    if ($_SESSION['user'] == "kitchenmaster"){
        header('location:'.$site.'kitchen');
    }
    ?>
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
            <div class="flex flex-wrap gap-4 items-center text-gray-500 dark:text-gray-400 transform delay-300">
                <p class="flex gap-2">
                    <i class="fad fa-calendar-week fa-swap-opacity text-lime-600"></i> <?php echo date('d') . 'th ' . date('F') . ' ' . date('Y') . ' | ' . date('l') ?>
                </p>
                <p class="flex gap-2 ls-2">
                    <i class="fad fa-clock fa-swap-opacity text-lime-600"></i> <span id="time"></span>
                </p>
            </div>
            <div class="w-full flex flex-wrap sm:flex-nowrap justify-around gap-2">
                <div class="totals">
                    <p class="flex gap-2 2xl:text-2xl">
                        <i class="fas fa-cash-register dark:text-lime-600 text-lime-600"></i>
                        <span>Today's Total Earning: </span>
                        <span class="font-bold text-lime-600" id="todaytotal">
                            <?php echo $today_total_income; ?>
                        </span>
                    </p>
                </div>
                <div class="totals">
                    <p class="flex gap-2 2xl:text-2xl">
                        <i class="fad fa-sack-dollar dark:text-lime-600 text-lime-600 fa-swap-opacity"></i>
                        <span>This month's Earning: </span>
                        <span class="font-bold text-lime-600" id="monthtotal">
                            <?php echo $monthly_total_income; ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="w-full grid grid-cols-1 2xl:grid-cols-2 lg:gap-4 gap-2 mx-auto fadeInBottom py-10">
            <?php if ($_SESSION['user'] == "admin") : ?>
                <?php foreach ($superadmin as $btn) : ?>
                    <a href="<?php echo $site . 'admin?option=' . $btn['2'] ?>" class="bigbtn first:bg-lime-600 first:col-span-0 first:2xl:col-span-2 first:2xl:justify-center" id="<?php echo $btn['3'] ?>">
                        <?php echo $btn['1'] ?>
                        <?php echo $btn['0'] ?>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($reception as $btn) : ?>
                    <a href="<?php echo $site . 'admin?option=' . $btn['2'] ?>" class="bigbtn first:bg-lime-800 first:col-span-0 first:2xl:col-span-2 first:justify-center" id="<?php echo $btn['3'] ?>">
                        <?php echo $btn['1'] ?>
                        <?php echo $btn['0'] ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
<?php else : ?>
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
            <div class="w-full flex flex-wrap sm:flex-nowrap justify-around gap-2">
                <div class="totals">
                    <p class="flex gap-2 2xl:text-2xl">
                        <i class="fas fa-cash-register dark:text-lime-600 text-lime-600"></i>
                        <span>Today's Total Earning: </span>
                        <span class="font-bold text-lime-600" id="todaytotal">
                            <?php echo $today_total_income; ?>
                        </span>
                    </p>
                </div>
                <div class="totals">
                    <p class="flex gap-2 2xl:text-2xl">
                        <i class="fad fa-sack-dollar dark:text-lime-600 text-lime-600 fa-swap-opacity"></i>
                        <span>This month's Earning: </span>
                        <span class="font-bold text-lime-600" id="monthtotal">
                            <?php echo $monthly_total_income; ?>
                        </span>
                    </p>
                </div>
            </div>
            <p class="text-gray-500 text-center animate-pulse">Login to view more!</p>
        </div>
    </div>
<?php endif; ?>
<script>
    setInterval(function() {
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/time.php",
            success: function(response) {
                $('#time').html(response);
            }
        });
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/todaytotal.php",
            success: function(response) {
                $('#todaytotal').html(response);
            }
        });
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/monthlytotal.php",
            success: function(response) {
                $('#monthtotal').html(response);
            }
        });
    }, 500);
</script>