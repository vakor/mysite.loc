<?php
	session_start();
	$id = (int)$_GET['id']; 
	if( $id < 1  ) 
	{ 
		$id = 1; 
	} 
	include("connect_db.php");
	$STH = $DBH->query("SELECT (*)  FROM post WHERE id = ".$id); 
	if (!empty($STH)) 
	{ 
		$id = 1; 
	}	 
	$sq = "SELECT id,title,author,data,short_text,text from post WHERE id=".$id;  
	$STH = $DBH->query($sq); 
	if (isset($_POST['exit'])) 
	{ 
		$_SESSION['ent'] = 3; 
	} 
	if (isset($_POST['crn'])) 
	{ 
		Header("Location: addnews.html");  
	} 
	if (isset($_POST['regi'])) 
	{ 
		Header("Location: reg.html");  
	} 
	$STH->setFetchMode(PDO::FETCH_ASSOC); 
	if( empty($STH)) 
	{ 
		echo "POST EMPTY<P> <a href='index.php'>HOME</a>"; 
	} else 
	{ 
		echo '<html>	 
		<head></head> 
		<body> 
		<div style="width:100%; height:100;  border: 4px solid black;"> 
		<a href="index.php">HOME<a> 
		</div><p> 
		<div style="width:200; height:500; float: left;  border: 4px solid black;"> 
		</div> 
		<div style="width:400; height:500; float:left; border: 4px  solid black;">';   
		while($row = $STH->fetch()) 
		{ 
			echo '<div style="width:100%;  float:left; border: 4px  solid black;">'; 
			echo "<b>".$row['title']."<b><p>"; 
			echo '<div style="width:100%;  float:left; border: 4px  solid black;">';  
			echo $row['text']; 
			echo "</div>"; 
			echo '<div style="width:100%;  float:left; border: 4px  solid black;">';  
			echo"  <p><p>avtor:".$row['author']."data: ".$row['data']."<p></div>";  
			$s = "change.php?id=".$id; 
			if ($_SESSION['ent'] == 2 && $_SESSION['login'] == $row['author']) 
			{ 
				 echo"<a href=".$s.">CHANGE <a>"; 
                 $s = "delete.php?id=".$id;    
                 echo"<p><a href=".$s.">DELETE<a>"; 
			} 
		}  
		echo ' </div></div> <div style="  width:350;   float:right;  border: 4px solid black;">'; 
	} 
	if ($_SESSION['ent'] == 3) 
		{ 
			echo "  <FORM ACTION='' METHOD='POST'> 
			<a href='reg.html'>registation</a> 
			</FORM> "; 
			include( "login.html"); 
		}else  
		{
			echo '<FORM ACTION="" METHOD="POST"> 
			<input type="submit" name="crn" value="Create News"> 
			<input type="submit" name="exit" value="Exit">'; 
		}
		echo "</div>";    
?>