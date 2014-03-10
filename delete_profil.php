<?php
	session_start();
	if(!empty($_GET['id']){
		$id=$_GET['id'];
		include("connect_db.php");
		$strSQL = "SELECT * from user WHERE id=".$id;		
		$STH = $DBH->query($strSQL);  			
		$row = $STH->fetch()
		if(!empty($row)){
		if ($_SESSION['ent'] == 2  && $_SESSION['login'] == $row['login'] || in_array('admin',$_SESSION['roles']))
		{
			$STH = $DBH->prepare("DELETE FROM user WHERE id = ".$id);  
			$STH->execute();
			Header("Location:  index.php"); 
			echo "you  delete this profil<p><a href='index.php'>HOME</a>";
		}
		}
	}
	else{
		echo "you can't delete this news<p><a href=".$_SERVER['HTTP_REFERER'].">Back</a>";
	}	
?>
