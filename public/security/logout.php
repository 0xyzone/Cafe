<?php
include "../includes/globalvar.php";
include "../includes/header.php";
unset($_SESSION['user']);
session_destroy();
header('location: '.$site);
?>