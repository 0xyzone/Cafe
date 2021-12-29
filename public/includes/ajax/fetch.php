<?php
include '../dbconnection.php';
include '../globalvar.php';
$sql = "SELECT * FROM orders WHERE order_no LIKE '%".$_POST['search']."%' LIMIT 3";
$result = mysqli_query($db, $sql);
$output = '';
if (mysqli_num_rows($result) > 0){
    $output .= '<div class="absolute pt-10 w-full grid grid-cols-1">';
    while($row = mysqli_fetch_array($result)){
        $oid = $row['order_no'];
        $output .= '
        <div class="searchresults">
            <div class="flex justify-between items-center ">
                <p class="font-bold text-2xl">Order #'.$row["order_no"].'</p>
                <input type="text" name="itemid" value="'.$oid.'" hidden>
                <a href="'.$site.'orderitem?orderno='.$oid.'&search=1" id="item'.$oid.'" class="btn-primary"><i class="fad fa-eye"></i> View</a>
            </div>
        </div>
        ';
        
    }
    $output .= '</div>';
    echo $output;
} else {
    echo '
    <div class="absolute pt-10 w-full grid grid-cols-1">
        <div class="searchresults">
            <p class="font-bold ">No Results Found!</p>
        </div>
    </div>
    ';
}
?>