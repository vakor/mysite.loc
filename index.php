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
	$page = (int)$_GET['page']; 	
	if (empty($page))	
	{	
		$page = 1;	
	} 
	echo '<html>	
	<head></head>	
	<body>	
	<div style="width:100%; height:100;  border: 4px solid black;">	
	</div>	
	<p>	
	<div style="width:200; height:500; float: left;  border: 4px solid black;">	
	gfdfghjkl,kjhgf	
	</div>			
	<div style="width:400; height:500; float:left; border: 4px  solid black;">';	
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
	$strSQL = "SELECT id,title,author,data,short_text,text from post LIMIT ".$min.", 10";		
	$STH = $DBH->query($strSQL);  			
	while($row = $STH->fetch()) 	
	{  	
		echo '<div style="width:88%;  border: 4px  solid black;">';	
		echo"<b>".$row['title']."<b>";	
		echo '</div><div style="width:88%;  border: 4px  solid black;">';	
		echo $row['short_text'];	
		$s = "news.php?id=".$row['id'];	
		echo"<a href=".$s.">Read more</a>";	
		echo '</div><div style="width:88%;  border: 4px solid black;">';	
		echo "<p>avtor:".$row['author']."data: ".$row['data']."<p>";	
		echo '</div>';	
	}
	
	$previous_page = $page-1;
	$next_page = $page+1;
	echo "page=	 $page 	";
	
	echo " <a href=index.php?page=".$previous_page.">back  </a>	
	<a href=index.php?page=".$next_page.">next </a></div>	
	<div style='  width:400; height:500; float:left; border: 4px solid black;'>";	
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
		echo '<FORM ACTION="" METHOD="POST">	
		<input type="submit" name="create_news" value="Create News">	
		<input type="submit" name="exit" value="Exit">  </FORM>';	
	}	
	echo "</div></body></html>";	
  ?>
