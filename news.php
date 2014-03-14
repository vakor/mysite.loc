<?php
	session_start();
	$id = (int)$_GET['id']; 
	if( $id < 1  ) { 
		$id = 1; 
	} 
	include("connect_db.php");
	include("translate.php");
	include('set_lang.php');
	$STH = $DBH->query("SELECT (*)  FROM post WHERE id = ".$id); 
	if (!empty($STH)) { 
		$id = 1; 
	}	 
	$sq = "SELECT * from post WHERE id=".$id;  
	$STH = $DBH->query($sq);
	$STH->setFetchMode(PDO::FETCH_ASSOC); 
	if( empty($STH)) { 
		echo "POST EMPTY<P> <a href='index.php'>HOME</a>"; 
	} else{ 
		include('header.html');
		include('leftside.html');
		echo'
		<div class="center">';   
		while($row = $STH->fetch()) 
		{ 
			echo '<div class="title"><p>'; 
			if($lang == 'eng'){
				echo "<b>".$row['title']."</b><p></div>";
			}else{
				echo "<b>".$row['title_ukr']."</b><p></div>";	
			}
			echo '<div class="text">';
			if($lang == 'eng'){
				echo $row['text']; 
			}else{
				echo $row['text_ukr'];
			}
			echo "</div>"; 
			echo '<div class="author">';
			$link_profil="profil.php?id=".$row['author_id'];
		echo"<p>".t($lang,'author').":<a href=".$link_profil.">".$row['author']."</a>".t($lang,'date').": ".$row['data']."<p></div>";
			$s = "change.php?id=".$id; 
			if ($_SESSION['ent'] == 2 && $_SESSION['login'] == $row['author']) 
			{ 
				 echo"<div style='bottom: 10px; margin-bottom:50px; '><p><a class='button' href=".$s.">".t($lang,'change')." </a>"; 
                 $s = "delete.php?id=".$id;    
                 echo"<a class='button' href=".$s.">".t($lang,'delete')."</a></div>"; 
			} 
		}
		echo '</div>';
		//include('comment.php');
		
		}
			include('rightside.php');
		echo"</body></html>";
		
?>
