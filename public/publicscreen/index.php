<?php
$title = "Public Screen";
include '../includes/main.php';
date_default_timezone_set('Asia/Kathmandu');
$date = date('Y-m-d');
$qry = $db->query("SELECT * FROM orders WHERE created_on LIKE '$date%' && kitchen = 'Done' ORDER BY order_no DESC");
?>
<div class="bodymain">
    <div class="container mx-auto">
        <div class="lg:w-6/12 mx-auto text-center flex flex-col gap-8">
            <div class="bg-lime-600 text-gray-100 dark:bg-lime-600 px-4 py-2 rounded-lg text-4xl font-bold w-full fadeInTop">
                Completed Orders
            </div>
            <div class="flex flex-col gap-2 relative w-auto dark:text-gray-800 transform duration-300 fadeInBottom" id="done">
                <?php foreach ($qry as $row) : ?>
                    <?php
                    date_default_timezone_set('Asia/Kathmandu');
                    $d = strtotime($row['created_on']);
                    $dt = date('jS M, Y h:i A', $d);
                    ?>

                    <div class="px-2">
                        <div class="bg-gray-300 rounded-lg px-4 py-4 flex gap-4 mainshadow">
                            <i class="fad fa-box-check fa-4x text-lime-600"></i>
                            <div class="flex flex-col items-start gap-2">
                                <span class="text-4xl font-bold">Order #<?php echo $row['order_no']; ?> is ready!</span>
                                <p class="text-2xl text-left">Please collect your order from take out window!</p>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
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