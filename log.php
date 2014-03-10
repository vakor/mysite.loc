<?php
	session_start();
	$login = $_POST['log'];
	$password=$_POST['pass'];
	if($login=== '' || $password=== '')
	{
		$_SESSION['erlog']='not entered login or password';
	}else
	{
		include("connect_db.php");
		$STH = $DBH->query('SELECT * from user WHERE login='.$login);  
		if(!empty($STH)){
		$STH->setFetchMode(PDO::FETCH_ASSOC); 
		$row = $STH->fetch();	
		if ($row['password']==$password && $row['login']==$login){
			$_SESSION['relog']='your loginned';
			$_SESSION['ent'] = 2;   
			$_SESSION['login'] =$login;
			$_SESSION['profil_id']=$row['id'];
			$_SESSION['roles']=unserialize($row['roles']);
			if(in_array('locked',$_SESSION['roles'])){
				$_SESSION['ent'] = 2;
				$_SESSION['login'] ='';
				echo "you locked <a href='index.php'>Home</a>";
				exit;
			}
		  }else 
      {
        $_SESSION['ent'] = 3;
        $_SESSION['erlog'] = "Incorrect login or password"; 
  		}   
		}
	}	
	header("Location:". $_SERVER['HTTP_REFERER'] ); 
?>
