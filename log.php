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
		$STH = $DBH->query('SELECT  password from user WHERE login='.$login);  
		$STH->setFetchMode(PDO::FETCH_ASSOC); 
		while($row = $STH->fetch())
		{  
			if ($row['password']==$password)
		  {
				$_SESSION['relog']='your loginned';
				$_SESSION['ent'] = 2;   
				$_SESSION['login'] =$login;
		  }else 
      {
        $_SESSION['ent'] = 3;
        $_SESSION['erlog'] = "Incorrect login or password"; 
  		}   
		}
	}	
	header("Location:". $_SERVER['HTTP_REFERER'] ); 
?>
