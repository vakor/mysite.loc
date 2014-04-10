<?php
session_start();
include('connect_db.php');
$post_id = $_GET['id'];
$mark = (int)$_POST['mark'];
$marks = array(1,2,3,4,5);
if (!in_array($mark,$marks)){
	echo "Wrong mark";
	echo "<p><a href=".$_SERVER['HTTP_REFERER'].">back </a>";	
	exit;
}
$user_id = $_SESSION['profil_id'];
$sql = "INSERT INTO vote (user_id, post_id,mark) VALUES(:user_id, :post_id, :mark)";
$STH = $DBH->prepare($sql);
$STH->bindValue(':user_id',$user_id);
$STH->bindValue(':post_id',$post_id);
$STH->bindValue(':mark',$mark);
$STH->execute();
$sql = "SELECT * FROM post WHERE id =:post_id";
$STH = $DBH->prepare($sql);

$STH->bindValue(':post_id',$post_id);
$STH->execute();
$row = $STH->fetch(PDO::FETCH_ASSOC);
$sum =(int)$row['sum'];
$count =(int)$row['count'];
//echo $sum;exit;
$sum = $sum + $mark;
$count = $count+1;
$sql = "UPDATE post SET sum = :sum, count= :count WHERE id = :post_id ";
$STH = $DBH->prepare($sql);
$STH->bindValue(':post_id',$post_id);
$STH->bindValue(':sum',$sum);
$STH->bindValue(':count',$count);
$STH->execute();
header('Location:'.$_SERVER['HTTP_REFERER']);
?>
