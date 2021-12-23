<?php
include '../dbconnection.php';
include '../globalvar.php';
$usersql = mysqli_query($db, "SELECT * FROM menu ORDER BY ID ASC");

?>
<?php foreach ($usersql as $row) : ?>
    <tr class="tbodyrow">
        <td class="px-4 py-2 rounded-l-lg smhidden"><?php echo $row['ID']; ?></th>
        <td class="px-4 2xl:px-2 text-left w-48 md:w-52 lg:w-64"><?php echo $row['item_name']; ?></td>
        <td class="px-2 2xl:px-6 text-left smhidden"><?php echo $row['category']; ?></td>
        <td class="px-2 2xl:px-8 text-left"><?php echo $row['price']; ?></td>
        <td class="edit"><a href="<?php echo $site . 'manageitem?edit=' . $row['ID']; ?>"><i class="fad fa-pencil-alt"></i></a></td>
        <td class="delete"><a href="<?php echo $site . 'manageitem?delete=' . $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fad fa-trash"></i></a></td>
    </tr>
<?php endforeach; ?>