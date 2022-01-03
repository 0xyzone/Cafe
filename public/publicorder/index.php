<?php
include '../includes/main.php';
$itemqry = $db->query("SELECT * FROM menu ORDER BY ID ASC");

?>
<div class="bodymain flex-col gap-4">
    <div class="">
        <div class="title">
            Place your order
        </div>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <?php foreach ($itemqry as $row) : ?>
                <div class="flex flex-col gap-4">
                    <label for="<?php echo $row['ID'] ?>"><?php echo $row['item_name'] ?></label>
                    <input type="number" class="fields" id="<?php echo $row['ID'] ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </form>
</div>