<?php
	session_start();
	include('set_lang.php');
	include('translate.php');
	include("connect_db.php");
	$id = (int)$_GET['id'];
	if ($id < 1) {
		$id = 1;
	}
	$STH = $DBH->query('SELECT * from post WHERE id='.$id);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	$row = $STH->fetch(); 
	if (($_SESSION['ent'] == 2 && $row['author'] == $_SESSION['login']) || in_array('admin',$_SESSION['roles'])){
	if (isset($_POST['exit'])){
		$_SESSION['ent'] = 3;
	}
	if (isset($_POST['change'])){
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
		$text_ukr = $_POST['text_ukr'];
		$short_text_ukr = substr($text_ukr,0,150);
		$title_ukr = $_POST['title_ukr'];
		$STH = $DBH->prepare("UPDATE post SET text_ukr= :text_ukr  WHERE id=$id");  
		$STH->bindParam(':text_ukr', $text_ukr, PDO::PARAM_STR);
		$STH->execute();
		$STH = $DBH->prepare("UPDATE post SET  title_ukr= :title_ukr  WHERE id=$id");
		$STH->bindParam(':title_ukr', $title_ukr, PDO::PARAM_STR);
		$STH->execute();
		$STH = $DBH->prepare("UPDATE post SET  text_short_ukr= :short_text WHERE id=$id");
		$STH->bindParam(':short_text', $short_text_ukr, PDO::PARAM_STR);
		$STH->execute();

		$s = "news.php?id=".$id;
		Header("Location: ".$s); 
	}
	$STH = $DBH->query('SELECT * from post WHERE id='.$id);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	while($row = $STH->fetch()){
		include('header.html');
		include('leftside.html');
		echo '<div class="center">';
		if ($_SESSION['ent'] == 2 && $_SESSION['login'] == $row['author']){
			echo'
			<FORM ACTION="" METHOD="POST">
			<input type="text" name="title" value='.$row['title'].'>
			<p>
			<textarea name="text">'.$row['text'].'</textarea>
			<p>
			<input type="text" name="title_ukr" value='.$row['title_ukr'].'>
			<p>
			<textarea name="text_ukr">'.$row['text_ukr'].'</textarea>
			<p>
			<input type="submit" name="change" value='.t($lang,'change').'>';
		}else{
			echo 'you cant change this news';	
		}
			echo'</div>';  
	}
	echo ' </div>';
	include('rightside.php');
	}else{
		echo"you cant change this news<a href='index.php'>Home</a>";
	}

?>
