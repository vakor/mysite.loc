<?php
session_start();
	if($_SESSION['ent'] == 2 ){
    $post_id =  $_GET['id'];
		$title = $_POST['title'];
    $text = $_POST['text'];
    $author = $_SESSION['login'];
    $lang = $_COOKIE['lang']; 
		$author_id = $_SESSION['profil_id'];
		include("connect_db.php");
		$STH = $DBH->prepare("INSERT INTO comment (title,text,author,author_id,post_id,lang) values (?,?,?,?,?,?)");
    $STH->execute(array($title,$text,$author,$author_id,(int)$post_id,$lang));
		Header("Location: ".$_SERVER['HTTP_REFERER']); 
	}else
	{
	echo 'you not authorizate <p> <a href="index.php">HOME </a>' ;
	}
?>


?>