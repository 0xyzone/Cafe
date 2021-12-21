<?php
include 'globalvar.php';
$superadmin = array(
    // [0] = Button Text
    // [1] = Button Icon
    // [2] = Button Link (route)
    // [3] = Button id
    array('Add Users','<i class="fad fa-users-medical fa-swap-opacity"></i>','adduser','take_orders'),
    array('Manage Users','<i class="fad fa-users-cog fa-swap-opacity"></i>','updateusers','take_orders'),
    array('Add Category','<i class="fad fa-sitemap"></i>','addcategory','addcategory'),
    array('Manage Category','<i class="fad fa-project-diagram"></i>','updatecategory','take_orders'),
    array('Add Items','<i class="fad fa-salad"></i>','additem','addcategory'),
    array('Manage Items','<i class="fad fa-tasks"></i>','manageitem','take_orders'),
    array('Take Orders','<i class="fad fa-edit"></i>','take_orders','take_orders'),
)
?>