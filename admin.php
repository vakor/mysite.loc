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
	
	include('translate.php');
	include('set_lang.php');
	include('header.html');
	include('leftside.html');
	echo'<div class="center">';	
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

	include('rightside.php');
	echo "</body></html>";	
  ?>
