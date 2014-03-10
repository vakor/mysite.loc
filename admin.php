<?php
	session_start();
	include("connect_db.php");
	if (isset($_POST['exit']))
	{
		$_SESSION['ent'] = 3;
	}
	if (isset($_POST['create_news']))
	{
		Header("Location: addnews.html"); 
	}
	
	echo '<html>	
	<head><link rel="stylesheet" type="text/css" href="style.css"></head>	
	<body>	
	<div class="head">';
	include('language.php');
	echo '</div>	
	<p>	
	<div class="leftside">	
	gfdfghjkl,kjhgf	
	</div>			
	<div class="center">';	
	$STH = $DBH->query("SELECT *  FROM user");	
	$STH->setFetchMode(PDO::FETCH_ASSOC);		
	while($row = $STH->fetch()) 	
	{  
		$link_profil="profil.php?id=".$row['id'];
		$link_change = "change_profil.php?id=".$row['id'];
		$link_delete = "delete_profil.php?id=".$row['id'];	
		echo '<div class="post">';		
		echo"Login:<a href=".$link_profil.">".$row['login']."</a>";
		echo '<div class="post">';			
		echo"<a href=".$link_change.">Change</a>";	
		echo"<a href=".$link_delete.">Delete</a>";		
		echo '</div></div>'; 
	}
	echo '</div>';
	
	echo"<div class='rightside'>";	
	if (!isset($_SESSION['ent']))	
	{	
		$_SESSION['ent'] = 3;	
	}	
	if ($_SESSION['ent'] == 3)	
	{	
		if (!empty($_SESSION['erreg']))	
		{	
			echo $_SESSION['erreg'];	
			$_SESSION['erreg'] = '';	
		}	
		if (!empty($_SESSION['erlog']))	
		{	
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
