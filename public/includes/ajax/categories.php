<?php
include '../dbconnection.php';
$usersql = mysqli_query($db,"SELECT * FROM category ORDER BY ID DESC LIMIT 3");

?>
<?php foreach ($usersql as $row):?>
    <tr class='border-y-8 border-y-transparent'>
        <td class="px-2 text-right"><?php echo $row['ID']; ?></td>
        <td class="px-2 text-left"><?php echo $row['category']; ?></td>
        <td class="px-2 text-left"><?php echo $row['html_id']; ?></td>
    </tr>
<?php endforeach;?>