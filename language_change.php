<?php
$lang = $_GET['lang'];
setcookie('lang', $lang);  
header("Location:".$_SERVER['HTTP_REFERRER']);
?>
