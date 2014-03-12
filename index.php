<?php

	session_start();
	include('set_lang.php');
	echo $lang;
	include("connect_db.php");
	include("translate.php");
	if (isset($_POST['create_news'])){
		Header("Location: addnews.html"); 
	}
		
	if (empty($_GET['page']))	{	
		$page = 1;	
	}else{
		$page = $_GET['page'];	
	}
	include('header.html');
	include('leftside.html');
	echo '		
	<div class="center">';
	$STH = $DBH->query("SELECT COUNT(*) as count FROM post");	
	$STH->setFetchMode(PDO::FETCH_ASSOC);	
	$row = $STH->fetch();	
	$m = $row['count'];	
	$posts = $m;	
	$total = (int)(($posts - 1) / 10) + 1; 	
	$page = (int)($page);
	if(empty($page) or $page < 0) 	
	{	
		$page = 1;	
	}	
	if($page > $total)	
	{	
		$page = $total; 	
	}	
	$max = $page*10;	
	$min = $page*10 - 10;	
	$strSQL = "SELECT * from post LIMIT ".$min.", 10";		
	$STH = $DBH->query($strSQL);  			
	while($row = $STH->fetch()) 	
	{  	
		echo '<div class="title">';	
		if($lang == 'eng'){
		echo"<b>".$row['title']."</b>";	
		echo '</div><div class="text">';	
		echo $row['short_text'];
		}else{
			echo"<b>".$row['title_ukr']."</b>";	
			echo '</div><div class="text">';	
			echo $row['text_short_ukr'];
		}
		$s = "news.php?id=".$row['id'];	
		echo"<a href=".$s.">".t($lang,'read_more')."</a>";	
		echo '</div><div class="author">';
		$link_profil="profil.php?id=".$row['author_id'];
		echo"<p>author:<a href=".$link_profil.">".$row['author']."</a>data: ".$row['data']."<p></div>"; 
	}
	
	$previous_page = $page-1;
	$next_page = $page+1;
	echo "<div class='navigate'> <a href=index.php?page=".$previous_page.">back  </a>	
	<a href=index.php?page=".$next_page.">next </a></div></div>	";	
	include('rightside.php');
	echo "</body></html>";
	
  ?>
