<?php 
	session_start();
	include("connect_db.php");
	include("translate.php");
	include("set_lang.php");
	
	if( empty($_GET['id'])){
		$id=1;
	}else{
		$id=(int)$_GET['id'];
	}
	include("header.html");
	include("leftside.html");
	echo'	<div class="center">';
	$strSQL = "SELECT * from user WHERE id=".$id;		
	$STH = $DBH->query($strSQL);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	$row = $STH->fetch();
	if(!empty($row)){
		$login=$row['login'];
		echo "<p><img src=img/".$row['photo'].">";
		echo "<p>".t($lang,'login').":".$row['login'];
		if ($_SESSION['ent'] == 2  && $_SESSION['login'] == $login){
			echo "<p>".t($lang,'email').":".$row['email'];
		}
		echo "<p>".t($lang,'name').":".$row['name'];
		echo "<p> ".t($lang,'surname').":".$row['surname'];
		echo "<p>".t($lang,'date_of_registration').":".$row['date_reg'];
		echo "<p>".t($lang,'date_of_login').":".$row['date_log'];
		if ($_SESSION['ent'] == 2 && $_SESSION['login'] == $login){
			$link="change_profil.php?id=".$row['id'];
			echo "<p><a href=".$link.">".t($lang,'change')."</a>";
			$link="del_prof.php?id=".$row['id'];
			echo "<p><a href=".$link.">".t($lang,'delete')."	</a>";
		}		
	}else{
		echo t($lang,'user_id_not_exist');
	}
	echo "</div> ";
	include('rightside.php');
	echo "</div></body></html>";	
	
 

?>
