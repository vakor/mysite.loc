<?php
session_start();
$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];
include("connect_db.php");
$roles = array();
$user='user';
array_push($roles,$user);
$data = array($login,$password	,$email,"empty.jpg",serialize($roles));
$STH = $DBH->prepare("INSERT INTO user (login,password,email,photo,roles) values (?, ?, ?, ?, ?)");  
$STH->execute($data);
$STH = $DBH->prepare('SELECT * from user WHERE login=:login');
$STH->bindValue(':login',$login);
$STH->execute();
while($row = $STH->fetch(PDO::FETCH_ASSOC)){
	$_SESSION['profil_id']=$row['id'];
}	
$_SESSION['login']=$login;
$_SESSION['ent'] = 2;
echo 'usrer registr';
?>
