<?php
include('connect_db.php'); 
session_start();
if (!in_array('admin',$_SESSION['roles'])){
	echo "you haven't permissions <p><a href=".$_SERVER['HTTP_REFERRER'].">back</a>"; exit;
}
$post_id = (int)$_GET['id'];
//echo $mark ; exit;
$sql = "DELETE FROM vote WHERE post_id= :post_id";
$STH = $DBH->prepare($sql);
$STH->bindValue(':post_id',$post_id);
$STH->execute();
$sql = "UPDATE post SET sum = :sum, count= :count WHERE id = :post_id ";
$STH = $DBH->prepare($sql);
$STH->bindValue(':post_id',$post_id);
$STH->bindValue(':sum',0);
$STH->bindValue(':count',0);
$STH->execute();
header('Location:'.$_SERVER['HTTP_REFERER']);
?>

