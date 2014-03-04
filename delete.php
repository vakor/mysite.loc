<?php
	session_start();
	$id = (int)$_GET['id'];
	include("connect_db.php");
	$STH = $DBH->query('SELECT  author from post WHERE id='.$id);  
	$STH->setFetchMode(PDO::FETCH_ASSOC); 
	$row = $STH->fetch();
	if ($_SESSION['ent'] == 2 && $row['author'] == $_SESSION['login'] )
	{
		$STH = $DBH->prepare("DELETE FROM post WHERE id = ".$id);  
		$STH->execute();
		Header("Location:  index.php"); 
	}
	else
	{
		echo "you can't delete this news<p><a href='index.php'>HOME</a>";
	}	
?>
