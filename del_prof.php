<?php
session_start();
	if(!empty($_GET['id'])){

		$id=(int)$_GET['id'];
		include("connect_db.php");
		$STH = $DBH->prepare('SELECT * from user WHERE id=:id');  
		$STH->bindValue(':id',$id,PDO::FETCH_ASSOC);
		$STH->execute();
		$row = $STH->fetch(PDO::FETCH_ASSOC);
		//print_r($row);exit;
		if(!empty($row)){
		if ($_SESSION['ent'] == 2  && $_SESSION['login'] == $row['login'] || in_array('admin',$_SESSION['roles']))
		{
			$STH = $DBH->prepare("DELETE FROM user WHERE id = ".$id);  
			$STH->execute();
			Header("Location:  index.php"); 
			echo "you  delete this profil<p><a href='index.php'>HOME</a>";
			$_SESSION['ent'] = 2;
		}
		}
	}else{
		echo "you can't delete this profil<p><a href=".$_SERVER['HTTP_REFERER'].">Back</a>";
	}	
?>
