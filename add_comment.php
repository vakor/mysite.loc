<?php
session_start();
include('set_lang.php');
	if($_SESSION['ent'] == 2 ){
		$post_id =  $_GET['id'];
		$title = $_POST['title'];
		if (empty($title)){
			$title = substr($text,0,15);
		}
		$text = $_POST['text'];
		$author = $_SESSION['login'];
		$author_id = $_SESSION['profil_id'];
		include("connect_db.php");
		$STH = $DBH->prepare("INSERT INTO comment (title,text,author,author_id,post_id,lang) values (?,?,?,?,?,?)");
		$STH->execute(array($title,$text,$author,$author_id,(int)$post_id,$lang));
		Header("Location: ".$_SERVER['HTTP_REFERER']); 
	}else{
		echo 'you not authorizate <p> <a href="index.php">HOME </a>' ;
	}
?>

