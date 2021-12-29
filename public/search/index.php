<?php
$title = "Search";
include '../includes/main.php';
?>
<div class="bodymain">
    <div class="w-10/12 lg:w-4/12 h-full bg-transparent rounded-full text-xl gap-2 relative">
        <input type="number" name="searchitem" id="isearch" class="fields" placeholder="Search for orders..." autofocus="on" autocomplete="off">
        <button class="text-gray-600 dark:text-stone-200 absolute top-2 right-4 z-30 transform duration-300" name="search" id="sbox"><i class="fas fa-telescope"></i></button>
        <div class="w-full absolute top-5" id="result"></div><!-- search results -->
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#isearch').keyup(function() {
            var txt = $(this).val();
            if (txt != '') {
                $.ajax({
                    url: "<?php echo $site ?>includes/ajax/fetch.php",
                    method: "post",
                    data: {
                        search: txt
                    },
                    dataType: "text",
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            } else {
                $('#result').html('');
            }
        });
    });
</script>