<?php
	session_start();
    $login = $_POST['logr'];
    $password=$_POST['passr'];
    if ($login === '' || $password === '' )
    {
		$_SESSION['erreg']='not entered login or password';
    Header("Location: reg.html");
		}else
    {
		include("connect_db.php");
		$STH = $DBH->query('SELECT login, password from user');  
		$ui = 0;
		$STH->setFetchMode(PDO::FETCH_ASSOC); 
		while($row = $STH->fetch())
		{  
			if ( $row['login'] == $login)
			{
			$ui = 1;
			}
		}
		if($ui==0)
		{
			$data = array($login,$password);
			$STH = $DBH->prepare("INSERT INTO user (login,password) values (?, ?)");  
			$STH->execute($data);
			$_SESSION['erreg']='you registration';
			Header("Location: index.php"); 
		}else
		{
			$_SESSION['erreg']='user with that name exist';
			Header("Location: reg.html"); 
		}
    }
	
?>
