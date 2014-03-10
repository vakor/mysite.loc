<?php
		session_start();
    $login = $_POST['login'];
    $password = $_POST['password'];
		$email = $_POST['email'];
		$re_password = $_POST['re_password'];
		$error_reg = array();
		$error = 2;
		include("connect_db.php");
    if (empty($login)){
			array_push($error_reg,'not entered login');
			$error = 1;
		} else{
			$STH = $DBH->query('SELECT * from user WHERE login='.$login);  
			if(!empty($STH)){
			$STH->setFetchMode(PDO::FETCH_ASSOC);
			$row = $STH->fetch();
			
				array_push($error_reg,'user with that login exist');
				$error = 1;
			}
		}
		if (empty($password)){
			array_push($error_reg,'not entered password');
			$error = 1;
		}
		if (empty($re_password)){
			array_push($error_reg,'not entered RE password');
			$error = 1;
		}
    if(!($password === $re_password)){
			array_push($error_reg,'Password and RE password different');
			$error = 1;
		}
		if(empty($email)){
			array_push($error_reg,'not entered email');
			$error = 1;
		}elseif(!preg_match("/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/",$email)){
			array_push($error_reg,'email is incorrect format');
			$error = 1;
		}else{
			$STH = $DBH->prepare('SELECT * from user WHERE email=:email');
			$STH->bindValue(":email", $email, PDO::FETCH_ASSOC);
			$STH->execute();
			$res = $STH->fetchAll();
			if(!empty($res)){
				array_push($error_reg,'user with that email exist');
				$error = 1;
			}
		}
		if ($error == 2 ){
				$date_reg=date("l dS of F Y ");		
				$roles = array();
				$user='user';
				array_push($user,$roles);
				$data = array($login,$password	,$email,$date_reg,"img/empty.jpg",serialize($roles));
				$STH = $DBH->prepare("INSERT INTO user (login,password,email,date_reg,photo,roles) values (	?, ?,?,?,?,?)");  
				$STH->execute($data);
				$_SESSION['ent'] = 2;   
				$_SESSION['login'] = $login;
				//$_SESSION['profil_id']=;
				Header("Location: index.php");			
		}else{
				$_SESSION['erreg'] = $error_reg;
				Header("Location: reg.html"); 
		}
?>
