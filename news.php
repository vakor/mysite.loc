<?php
	session_start();
	$id = (int)$_GET['id']; 
	if( $id < 1  ) 
	{ 
		$id = 1; 
	} 
	include("connect_db.php");
	include("translate.php");
	include('set_lang.php');
	$STH = $DBH->query("SELECT (*)  FROM post WHERE id = ".$id); 
	if (!empty($STH)) 
	{ 
		$id = 1; 
	}	 
	$sq = "SELECT id,title,author,data,short_text,text,author_id from post WHERE id=".$id;  
	$STH = $DBH->query($sq);
	$STH->setFetchMode(PDO::FETCH_ASSOC); 
	if (isset($_POST['exit'])) 
	{ 
		$_SESSION['ent'] = 3; 
	} 
	if (isset($_POST['crn'])) 
	{ 
		Header("Location: addnews.html");  
	} 
	if (isset($_POST['regi'])) 
	{ 
		Header("Location: reg.html");  
	} 
	if( empty($STH)) 
	{ 
		echo "POST EMPTY<P> <a href='index.php'>HOME</a>"; 
	} else 
	{ 
		echo '<html>	 
		<head><link rel="stylesheet" type="text/css" href="style.css"></head></head> 
		<body> 
		<div class="head"> 
		<a href="index.php">HOME<a> ';
		include('language.php');
			echo'</div><p> 
		<div class="leftside"> 
		</div> 
		<div class="center">';   
		while($row = $STH->fetch()) 
		{ 
			echo '<div class="post">'; 
			echo "<b>".$row['title']."</b><p></div>"; 
			echo '<div class="post">';  
			echo $row['text']; 
			echo "</div>"; 
			echo '<div class="post">';
			$link_profil="profil.php?id=".$row['author_id'];
		echo"<p>author:<a href=".$link_profil.">".$row['author']."</a>data: ".$row['data']."<p></div>";
			$s = "change.php?id=".$id; 
			if ($_SESSION['ent'] == 2 && $_SESSION['login'] == $row['author']) 
			{ 
				 echo"<a href=".$s.">CHANGE <a>"; 
                 $s = "delete.php?id=".$id;    
                 echo"<p><a href=".$s.">DELETE<a>"; 
			} 
		}
		include('comment.php');
		echo '</div>';
		
		echo'</div><div class="rightside">'; 
	} 
	if ($_SESSION['ent'] == 3) 
		{ 
			echo "  <FORM ACTION='' METHOD='POST'> 
			<a href='reg.html'>registation</a> 
			</FORM> "; 
			include( "login.html"); 
		}else  
		{
			include('rightside_enter.php');
		}
		echo "</div>";
		
?>