<?php 
	session_start();
	include("connect_db.php");
	include("translate.php");
	include("set_lang.php");
	
	if( empty($_GET['id'])){
		$id=1;
	}else{
		$id=(int)$_GET['id'];
	}
	echo'<html>
	<head> <link rel="stylesheet" type="text/css" href="style.css"></head>
	<body>
	<div  class="head">
	<a href="index.php">HOME<a>';
	include('language.php');
		echo'</div>
	<p>
	<div class="leftside">
	gfdfghjkl,kjhgf
	</div>
	<div class="center">';
	$strSQL = "SELECT * from user WHERE id=".$id;		
	$STH = $DBH->query($strSQL);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	$row = $STH->fetch();
	if(!empty($row)){
		$login=$row['login'];
		echo "<p><img src=img/".$row['photo'].">";
		echo "<p>".t($lang,'login').":".$row['login'];
		if ($_SESSION['ent'] == 2  && $_SESSION['login'] == $login){
			echo "<p>".t($lang,'email').":".$row['email'];
		}
		echo "<p>".t($lang,'name').":".$row['name'];
		echo "<p> ".t($lang,'surname').":".$row['surname'];
		echo "<p>".t($lang,'date_of_registration').":".$row['date_reg'];
		echo "<p>".t($lang,'date_of_login').":".$row['date_log'];
		if ($_SESSION['ent'] == 2 && $_SESSION['login'] == $login){
			$link="change_profil.php?id=".$row['id'];
			echo "<p><a href=".$link.">".t($lang,'change')."</a>";
			$link="delete_profil.php?id=".$row['id'];
			echo "<p><a href=".$link.">".t($lang,'delete')."	</a>";
		}		
	}else{
		echo t($lang,'user_id_not_exist');
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
		echo "<div class='rightside'>  
		<a href='reg.html'>registation</a>	";		
		include( "login.html");	
	}	
	else 	
	{
		echo "<div class='rightside'>"; 
		include('rightside_enter.php');
	}	
	echo "</div></body></html>";	
	
 

?>