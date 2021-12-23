<?php
include '../dbconnection.php';
include '../globalvar.php';
$usersql = mysqli_query($db,"SELECT * FROM userbase ORDER BY ID ASC");

?>
<?php foreach ($usersql as $row):?>
    <tr class="tbrow">
        <td class="px-4 text-right"><?php echo $row['ID']; ?></td>
        <td class="px-2 text-left select-all"><?php echo $row['username']; ?></td>
        <td class="px-2 text-left select-all smhidden"><?php echo $row['password']; ?></td>
        <td class="edit"><a href="<?php echo $site.'admin/?edit='.$row['ID']; ?>"><i class="fad fa-pencil-alt"></i></a></td>
        <td class="delete"><a href="<?php echo $site.'admin/?delete='.$row['ID']; ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fad fa-trash"></i></a></td>
    </tr>
<?php endforeach;?>