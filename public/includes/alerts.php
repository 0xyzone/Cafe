<!-- Notifications/Alerts -->
<?php if (isset($_SESSION['message'])) : ?>
    <div class="w-full flex justify-center absolute top-10 lg:top-24 animate-bounce z-50">
        <div id="success" class="bg-green-100 dark:bg-lime-200 text-green-400 dark:text-lime-700 border-2 border-current text-lg px-4 py-2 rounded-lg w-max fadeInTop mainshadow">
            <?php
            echo $_SESSION['message'];
            if ((time() - $_SESSION['msg_time']) > 3){
                unset($_SESSION['message']);
            } else {
                
            }
            ?>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($err)) : ?>
    <div class="w-full flex justify-center absolute top-10 lg:top-24 animate-bounce z-50">
        <div id="err" class="bg-rose-100 dark:bg-rose-200 text-rose-400 dark:text-rose-700 border-2 border-current text-lg px-4 py-2 rounded-lg w-max fadeInTop  mainshadow">
            <?php echo $err; ?>
        </div>
    </div>
<?php endif ?>

<script>
    setTimeout(function() {
        $('#err').fadeOut('slow');
    }, 3000); // <-- time in milliseconds
    setTimeout(function() {
        $('#success').fadeOut('slow');
    }, 3000); // <-- time in milliseconds
</script>
<!-- end Notifications/Alerts -->