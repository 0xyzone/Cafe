<?php
$title = "Public Screen";
include '../includes/main.php';

?>
<div class="bodymain">
    <div class="container mx-auto grid grid-cols-1">
        <div class="grid grid-col-1 justify-center gap-4 container mx-auto">
            <div class="bg-lime-600 text-gray-100 dark:bg-lime-600 px-4 py-2 rounded-lg text-4xl font-bold">
                Completed Orders
            </div>
            <div class="flex flex-col gap-2 relative w-auto dark:text-gray-800 transform duration-300" id="done">
            </div>
        </div>
    </div>
</div>

<script>
    setInterval(function() {
        $.ajax({
            url: "<?php echo $site ?>includes/ajax/done.php",
            success: function(response) {
                $('#done').html(response);
            }
        });
    }, 1000);
</script>