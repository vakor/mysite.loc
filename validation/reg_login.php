<?php

$login = $_POST['login'];
$error = 2;
include("connect_db.php");
$STH = $DBH->prepare('SELECT * from user WHERE login=:login');
$STH->bindValue(":login", $login, PDO::FETCH_ASSOC);
$STH->execute();
$res = $STH->fetchAll();
if(!empty($res)){
	$error = 1;
}
if ($error == 1 ){
	echo 'user_with_thant_name_exist'.$res['name'];
}else {
	echo 'user_with_thant_name_not_exist';
}


?>
