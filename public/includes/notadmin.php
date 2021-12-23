<?php
if (isset($_SESSION['user'])){
    if (($_SESSION['user']) != "admin"){
        header('location:'.$site);
    }
}
?>