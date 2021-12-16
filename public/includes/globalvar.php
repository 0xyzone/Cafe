<?php
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
    $url = "https://";
} else {
    $url = "http://";
};
$site = $url.$_SERVER['SERVER_NAME'].'/cafe/public/';
?>