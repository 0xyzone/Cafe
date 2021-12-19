<?php
include 'globalvar.php';
$superadmin = array(
    // [0] = Button Text
    // [1] = Button Icon
    // [2] = Button Link (route)
    // [3] = Button id
    array('Add Category','<i class="fad fa-sitemap"></i>','addcategory','addcategory'),
    array('Update Category','<i class="fad fa-project-diagram"></i>','updatecategory','take_orders'),
    array('Update Users','<i class="fad fa-users-cog fa-swap-opacity"></i>','updateusers','take_orders'),
    array('Take Orders','<i class="fad fa-edit"></i>','take_orders','take_orders'),
)
?>