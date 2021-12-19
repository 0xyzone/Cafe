<?php
$title = "Homepage";
include 'includes/header.php';
include 'includes/globalvar.php';
?>
<?php if (isset($_SESSION['user'])): ?>
    <div class="lg:w-6/12 w-8/12 h-full mx-auto flex flex-col justify-center gap-10">
        <div class="flex flex-col gap-2 fadeInLeft">
            <h1 class="text-6xl">
                <?php
                    date_default_timezone_set('Asia/Kathmandu');
                    if (date("H") < 12){
                        echo "Good Morning!";
                    } else if ((date("H") > 12) && (date("H") < 17)){
                        echo "Good Afternoon!";
                    } else if (date("H") > 17){
                        echo "Good Evening!";
                    }
                ?>
            </h1>
            <div class="flex gap-4 items-center">
                <p>
                  <i class="fad fa-calendar-week"></i> <?php echo date('d').'th '.date('F').' '.date('Y').' | '.date('l') ?>
                </p>
                <p class="space-2">
                  <i class="fad fa-clock"></i> <span id="time"></span>
                </p>
            </div>
        </div>
        
        
        <div class="w-full grid grid-cols-1 lg:grid-cols-2 lg:gap-4 gap-2 mx-auto fadeInBottom">
            <?php foreach($superadmin as $btn):?>
                <a href="<?php echo $site.'admin?option='.$btn['2'] ?>" class="bigbtn flex gap-2 items-center" id="<?php echo $btn['3']?>">
                    <?php echo $btn['1'] ?>
                    <?php echo $btn['0'] ?>
                </a>
            <?php endforeach;?>
        </div>
    </div>

    
<?php else: ?>
    <div class="w-full h-full flex flex-col justify-center items-center gap-10">
        <i class="fad fa-hand-sparkles text-9xl text-lime-700 dark:text-green-300 relative"><span class=" absolute top-0 right-0"><i class="fad fa-hand-sparkles text-9xl animate-ping text-gray-700 dark:text-gray-500 opacity-30"></i></span ></i>
        
        <span class="text-6xl lg:text-9xl font-bold text-center">RUKO ZARA!<br>SABAR KARO!</span>
        <span class="animate-bounce lg:text-2xl text-gray-500 dark:text-gray-600">Amazing stuffs coming soon!</span>
        
    </div>
<?php endif; ?>
<script>
    setInterval(function(){
        $.ajax({url: "<?php echo $site?>includes/ajax/time.php", success: function(response){
            $('#time').html(response)
        }});
    }, 50);
</script>
