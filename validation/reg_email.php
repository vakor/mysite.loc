<?php

$email = $_POST['email'];
$error = 2;
include("connect_db.php");
$STH = $DBH->prepare('SELECT * from user WHERE email=:email');
$STH->bindValue(":email", $email, PDO::FETCH_ASSOC);
$STH->execute();
$res = $STH->fetchAll();
if(!empty($res)){
	$error = 1;
}
if ($error == 1 ){
	echo 'user_with_thant_email_exist'.$res['name'];
}else {
	echo 'user_with_thant_email_not_exist';
}

?>
