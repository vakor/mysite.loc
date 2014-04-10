<?php
if (!in_array('admin',$_SESSION['roles'])){
	echo "you not admin<p><a href=".$_SERVER['HTTP_REFERER'].">back</a>";exit;
}
include("connect_db.php");
$sql = "DELETE FROM comment WHERE id= :id";
$STH = $DBH->prepare($sql);
$STH->bindValue(':id',(int)$_GET['id']);
$STH->execute();
?>
