<?php
	session_start();
	if($_SESSION['ent'] == 2 && (in_array('moderator', $_SESSION['roles']) ||  in_array('admin',$_SESSION['roles']))){
		$title = $_POST['title'];
    $text = $_POST['text'];
    $author = $_SESSION['login'];
    $title_ukr = $_POST['title_ukr'];
		$date = new DateTime();
		$timestamp=$date->getTimestamp();
    $text_ukr = $_POST['text_ukr'];
		$text_short_ukr =substr($text_ukr,0,149);
		$author_id = $_SESSION['profil_id'];
		include("connect_db.php");
    $data = array($title, $author, date("l dS of F Y "), substr($text, 0, 150), $text, $_SESSION['profil_id'], $text_ukr, $title_ukr, $text_short_ukr);
    //$STH = $DBH->prepare("INSERT INTO post (
		//									 title, author, data, short_text, text, author_id, text_ukr, title_ukr, text_short_ukr) values (?,?,?,?,?,?,?,?,?)");
    //$STH->execute($data);
		$STH = $DBH->prepare("INSERT INTO post (title, author,  text, author_id, text_ukr, title_ukr,short_text,text_short_ukr) values (?,?,?,?,?,?,?,?)");
    $STH->execute(array($title,$author,$text,(int)$author_id, $text_ukr,$title_ukr,substr($text, 0, 149),$text_short_ukr));
		$s = "news.php?id=".$DBH->lastInsertId();
    Header("Location: ".$s); 
	}else
	{
	echo 'you not authorizate <p> <a href="index.php">HOME </a>' ;
	}
?>