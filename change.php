<?php
	session_start();
	if (($_SESSION['ent'] == 2 && $row['author'] == $_SESSION['login']) || in_array('admin',$_SESSION['roles'])){
	$id = (int)$_GET['id'];
	if ($id < 1) 
	{
		$id = 1;
	}
	include("connect_db.php");
	if (isset($_POST['exit']))
	{
		$_SESSION['ent'] = 3;
	}
	if (isset($_POST['change'])) 
	{
		$text = $_POST['text'];
		$short_text = substr($text,0,150);
		$title = $_POST['title'];
		$STH = $DBH->prepare("UPDATE post SET text= :text  WHERE id=$id");  
		$STH->bindParam(':text', $text, PDO::PARAM_STR);
		$STH->execute();
		$STH = $DBH->prepare("UPDATE post SET  title= :title  WHERE id=$id");
		$STH->bindParam(':title', $title, PDO::PARAM_STR);
		$STH->execute();
		$STH = $DBH->prepare("UPDATE post SET  short_text= :short_text WHERE id=$id");
		$STH->bindParam(':short_text', $short_text, PDO::PARAM_STR);
		$STH->execute();
		$s = "news.php?id=".$id;
		Header("Location: ".$s); 
	}
	$STH = $DBH->query('SELECT id,title,author,data,short_text,text from post WHERE id='.$id);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $STH->fetch()) 
	{
		echo '
		<html>	
		<head><link rel="stylesheet" type="text/css" href="style.css"></head>	
		<div class="head">
		<a href="index.php">HOME<a>
		</div>
		<p>
		<div class="leftside">
		gfdfghjkl,kjhgf
		</div>
		<div class="center">';
		if ($_SESSION['ent'] == 2 && $_SESSION['login'] == $row['author'])
		{
			echo'
			<FORM ACTION="" METHOD="POST">
			<input type="text" name="title" value='.$row['title'].'>
			<p>
			<textarea name="text">'.$row['text'].'</textarea>
			<input type="submit" name="change" value="Change">';
		}else
		{
			echo 'you cant change this news';	
		}
			echo'</div>';  
	}
	echo ' </div> <div class="rightside">';
	$_SESSION['ent'] = 2;
	if ($_SESSION['ent'] == 3 )
	{
		include( "login.html");
		echo "<p>";
		include("reg.html");
		echo $_SESSION['regf'];
	}else
	{
		echo '
		<FORM ACTION="" METHOD="POST"><p>
		<a href="addnews.html">Add news</a>
		<input type="submit" name="exit" value="Exit">';
	}
	echo "</div>";
	}else{
		echo"you cant change this post<a href='index.php'>Home</a>";
	}

?>
