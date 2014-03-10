<?php
session_start();
if(!empty($_SESSION['id_roles'])){
	$id=$_SESSION['id_roles'];
	include("connect_db.php");
	$roles = array();
	if (isset($_POST['user'])){
		array_push($roles,$_POST['user']);	
	}
	if (isset($_POST['admin'])){
		array_push($roles,$_POST['admin']);	
	}
	if (isset($_POST['moderator'])){
		array_push($roles,$_POST['moderator']);	
	}
	if (isset($_POST['locked'])){
		array_push($roles,$_POST['locked']);	
	}
	$sql_roles = serialize($roles);		
	$STH = $DBH->prepare("UPDATE user SET roles= :roles  WHERE id=".$id);  
	$STH->bindParam(':roles', $sql_roles, PDO::PARAM_STR);
	$STH->execute();
	unset($_SESSION['id_roles']);
}else{

}
header("Location:". $_SERVER['HTTP_REFERER']);
?>