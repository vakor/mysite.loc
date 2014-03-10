<?php 
	session_start();
	include("connect_db.php");
	if( empty($_GET['id'])){
		$id=1;
	}else{
		$id=(int)$_GET['id'];
	}
	echo'<html>
	<head> <link rel="stylesheet" type="text/css" href="style.css"></head>
	<body>
	<div  class="head">
	<a href="index.php">HOME<a>
	</div>
	<p>
	<div class="leftside">
	gfdfghjkl,kjhgf
	</div>
	<div class="center">';
	$strSQL = "SELECT * from WHERE id=".$id;		
	$STH = $DBH->query($strSQL);  			
	$row = $STH->fetch()
	if(!empty($row)){
		echo "<p><img src=".$row['image']." >";
		echo "<p>Login:$row['login']";
		if ($_SESSION['ent']==2){
			echo "<p>Email:$row['email']";
		}
		echo "<p>Name:$row['name'] Surname:$row['surname']";
		echo "<p>Date of registration:$row['date_reg']";
		echo "<p>Date of last loginned:$row['date_log']";
		echo "<p>Date of registration:$row['date_reg']";
		if ($_SESSION['ent']==2){
			echo "<p><a href=edit.php?id=".$row['id']."></a>";
		}		
	}else{
		echo"User with that id not exist";
	}
	echo "</div> ";
	if (!isset($_SESSION['ent'])){	
		$_SESSION['ent'] = 3;	
	}	
	if ($_SESSION['ent'] == 3){	
		if (!empty($_SESSION['erreg'])){	
			echo $_SESSION['erreg'];	
			$_SESSION['erreg'] = '';	
		}	
		if (!empty($_SESSION['erlog'])){	
			echo $_SESSION['erlog'];	
			$_SESSION['erlog']='';	
		}	
		echo "  <FORM ACTION='' METHOD='POST'>	
		<a href='reg.html'>registation</a>	
		</FORM> ";		
		include( "login.html");	
	}	
	else 	
	{	
		echo '<FORM ACTION="" METHOD="POST">	
		<input type="submit" name="create_news" value="Create News">	
		<input type="submit" name="exit" value="Exit">  </FORM>';	
	}	
	echo "</div></body></html>";	
	
 

?>