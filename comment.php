<?php
//
$id=3;
$lang='ukr';	 
//  

if (empty($_GET['page_com']))	{	
		$page_com = 1;	
	}else{
		$page_com = $_GET['page_com'];	
	}
	include('connect_db.php');
	$sql = "SELECT COUNT(*) FROM comment"; 
	$result = $DBH->prepare($sql); 
	$result->execute(); 
	$number_of_rows = $result->fetchColumn(); 
	$m = $number_of_rows;
	$posts = $m;	 
	$total = (int)(($posts - 1) / 10) + 1; 	
	$page_com = (int)($page_com);
	if(empty($page_com) or $page_com < 0) 	
	{	
		$page_com = 1;	
	}	
	if($page_com > $total)	
	{	
		$page = $total; 	
	}	
	$max = $page_com*10;	
	$min = $page_com*10 - 10;	
	$strSQL = "SELECT * from comment WHERE post_id=".$id." and lang=".$lang." LIMIT ".$min.", 10";		
	$STH = $DBH->prepare($strSQL); 
	$STH->execute(); 			
	while($row = $STH->fetch(PDO::FETCH_ASSOC)) 	
	{  	
		echo '<div class="post">';	
		echo"<b>".$row['title']."</b>";	
		echo '</div><div class="post">';	
		echo $row['text'];
		echo '</div><div class="post">';
		$link_profil="profil.php?id=".$row['author_id'];
		echo"<p>author:<a href=".$link_profil.">".$row['author']."</a>data: ".$row['date']."<p></div>"; 
	}
	
	$previous_page = $page_com-1;
	$next_page = $page_com+1;
	echo " <a href=news.php?page_com=".$previous_page.">back  </a>	
	<a href=news.php?page_com=".$next_page.">next </a></div>";
		
?>
