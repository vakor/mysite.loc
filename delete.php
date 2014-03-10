<?php

	session_start();
	if(!empty($_GET['id'])){
		$id = (int)$_GET['id'];
		include("connect_db.php");
		$STH = $DBH->query('SELECT  author from post WHERE id='.$id);  
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row = $STH->fetch();
		if(!empty($row)){
		if (($_SESSION['ent'] == 2 && $row['author'] == $_SESSION['login']) || in_array('admin',$_SESSION['roles'])){
			$STH = $DBH->prepare("DELETE FROM post WHERE id = ".$id);  
			$STH->execute();
			Header("Location:  index.php"); 
		}
		}
	}
	else{
		echo "you can't delete this news<p><a href=".$_SERVER['HTTP_REFERER'].">Back</a>";
	}	
?>
