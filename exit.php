<?php
session_start();
$_SESSION['ent'] = 3;
header('Location:'.$_SERVER['HTTP_REFERER']);

?>