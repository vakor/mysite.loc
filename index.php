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
		
	if (empty($_GET['page']))	
	{	
		$page = 1;	
	}else
	{
	$page = $_GET['page'];	
	}
	
	echo '<html>	
	<head><link rel="stylesheet" type="text/css" href="style.css"></head>	
	<body>	
	<div class="head">';
	include("language.php");
		echo'</div>	
	<p>	
	<div class="leftside">	
	gfdfghjkl,kjhgf	
	</div>			
	<div class="center">';	
	$STH = $DBH->query("SELECT COUNT(*) as count FROM post");	
	$STH->setFetchMode(PDO::FETCH_ASSOC);	
	$row = $STH->fetch();	
	$m = $row['count'];	
	$posts = $m;	
	echo $posts;	
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
	$strSQL = "SELECT id,title,author,data,short_text,text,author_id from post LIMIT ".$min.", 10";		
	$STH = $DBH->query($strSQL);  			
	while($row = $STH->fetch()) 	
	{  	
		echo '<div class="post">';	
		echo"<b>".$row['title']."</b>";	
		echo '</div><div class="post">';	
		echo $row['short_text'];	
		$s = "news.php?id=".$row['id'];	
		echo"<a href=".$s.">Read more</a>";	
		echo '</div><div class="post">';
		$link_profil="profil.php?id=".$row['author_id'];
		echo"<p>author:<a href=".$link_profil.">".$row['author']."</a>data: ".$row['data']."<p></div>"; 
	}
	
	$previous_page = $page-1;
	$next_page = $page+1;
	echo " <a href=index.php?page=".$previous_page.">back  </a>	
	<a href=index.php?page=".$next_page.">next </a></div>	
	<div class='rightside'>";	
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
		$link_profil="profil.php?id=".$_SESSION['profil_id'];
		echo "<a href=".$link_profil.">Profils</a>";
		echo '<FORM ACTION="" METHOD="POST">	
		<input type="submit" name="create_news" value="Create News">	
		<input type="submit" name="exit" value="Exit">  </FORM>';	
	}	
	echo "</div></body></html>";	
  ?>
