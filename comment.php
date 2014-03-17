<?php
//
//  
include('form_add_com.php');
if (empty($_GET['page_com']))	{	
		$page_com = 1;	
	}else{
		$page_com = $_GET['page_com'];	
	}
	include('connect_db.php');
	$sql = "SELECT COUNT(*) FROM comment WHERE post_id =:id AND lang= :lang";
	
	$result = $DBH->prepare($sql); 
	$result->bindValue(':id',$id);
	$result->bindValue(':lang',$lang);
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
		$page_com = $total; 	
	}
	
	$max = $page_com*10;	
	$min = $page_com*10 - 10;
	if ($min < 0){
		$min = 0;
	}
	$SQL = "SELECT * FROM comment WHERE post_id =:id AND lang= :lang LIMIT ".$min.", 10 " ;
	$STH = $DBH->prepare($SQL);
	$STH->bindValue(':id',$id);
	$STH->bindValue(':lang',$lang);
	$STH->execute();
	while($row = $STH->fetch(PDO::FETCH_ASSOC)){  	
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
	
	$link =$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."&page_com=";	
	if($m > 10){
		echo " <a href=news.php?page_com=".$link.$previous_page.">back  </a>	
		<a href=news.php?page_com=".$link.$next_page.">next </a></div>";
	}	
?>
