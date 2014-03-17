<?php
include('connect_db.php'); 
session_start();
$post_id = $_GET['id'];
$user_id = $_SESSION['profil_id'];
$sql = "SELECT mark FROM vote WHERE user_id=:user_id AND post_id=:post_id";
$STH = $DBH->prepare($sql);
$STH->bindValue(':user_id',$_SESSION['profil_id']);
$STH->bindValue(':post_id',$post_id);
$STH->execute();
$row = $STH->fetch();
$mark=$row['mark'];
//echo $mark ; exit;
$sql = "DELETE FROM vote WHERE post_id= :post_id AND user_id= :user_id";
$STH = $DBH->prepare($sql);
$STH->bindValue(':user_id',$user_id);
$STH->bindValue(':post_id',$post_id);
$STH->execute();
$sql = "SELECT * FROM post WHERE id =:post_id";
$STH = $DBH->prepare($sql);
$STH->bindValue(':post_id',$post_id);
$STH->execute();
$row = $STH->fetch(PDO::FETCH_ASSOC);
$sum = $row['sum'];
$count = $row['count'];
$sum = $sum - $mark;
$count = $count - 1;
$sql = "UPDATE post SET sum = :sum, count= :count WHERE id = :post_id ";
$STH = $DBH->prepare($sql);
$STH->bindValue(':post_id',$post_id);
$STH->bindValue(':sum',$sum);
$STH->bindValue(':count',$count);
$STH->execute();
header('Location:'.$_SERVER['HTTP_REFERER']);
?>

