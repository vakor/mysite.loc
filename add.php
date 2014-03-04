<?php
	session_start();
	if ($_SESSION['ent'] == 2)
	{
		$title = $_POST['title'];
    $text = $_POST['text'];
    $author = $_SESSION['login'];
    include("connect_db.php");
    $data = array($title	,$author	,date("l dS of F Y ")	, substr($text, 0, 150)	,$text	);
    $STH = $DBH->prepare("INSERT INTO post (title	,author	,data	,short_text	,text	) values (?,?,?,?,?)");  
    $STH->execute($data);
		$s = "news.php?id=".$DBH->lastInsertId();
    Header("Location: ".$s); 
	}else
	{
	echo 'you not authorizate <p> <a href="index.php">HOME </a>' ;
	}
?>
