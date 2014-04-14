<?php
	session_start();
	$login = $_POST['log'];
	$password=$_POST['pass'];
	if($login=== '' || $password=== '')
	{
		$_SESSION['erlog']='not entered login or password';
	}else{
		include("connect_db.php");
		$STH = $DBH->prepare('SELECT * from user WHERE login=:login');  
		$STH->bindValue(':login',$login,PDO::FETCH_ASSOC);
		$STH->execute();
		$row = $STH->fetch(PDO::FETCH_ASSOC);
		if ($row['password']==$password && $row['login']==$login){
			$_SESSION['relog']='your loginned';
			$_SESSION['ent'] = 2;   
			$_SESSION['login'] =$login;
			$_SESSION['profil_id']=$row['id'];
			$STH = $DBH->prepare("UPDATE user SET date_log= CURRENT_TIMESTAMP  WHERE id=".$row['id']);  
			//$STH->bindParam(':date_log', time());
			$STH->execute();
			$_SESSION['roles'] = array();	
			$_SESSION['roles']= unserialize($row['roles']);
			//print_r($_SESSION['roles']);exit;
			//print_r($_SESSION['roles']);exit;
			if(in_array('locked',$_SESSION['roles'])){
				$_SESSION['ent'] = 2;
				$_SESSION['login'] ='';
				echo "you locked <a href='index.php'>Home</a>";
				exit;
			}
		}else{
        		$_SESSION['ent'] = 3;
        		$_SESSION['erlog'] = "Incorrect login or password"; 
  		}   
	}
		
	header("Location:". $_SERVER['HTTP_REFERER'] ); 
?>
