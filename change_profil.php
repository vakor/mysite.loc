<?php 
	session_start();
	include("connect_db.php");
	if(empty($_SESSION['roles'])){
	$_SESSION['roles']=array();
	}
	if(!empty($_GET['id'])){
		$id=(int)$_GET['id'];
	}
	$_SESSION['id_roles'] = $id;
	//CHANGE
	if (!empty($_SESSION['error_change'])){
		foreach ($_SESSION['error_change'] as $value) {
		echo "<p><b>$value</b>";
		}
   $_SESSION['error_change']	 =array();
	}
	if (isset($_POST['change_profil'])){
		$login=$_POST['login'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		//$photo=$_POST['fname'];
		$error_change= array();
		//start
		$error=2;
		if (empty($login)){
			array_push($error_change,'not entered login');
			$error = 1;
		} else{
			$STH = $DBH->query("SELECT * from user WHERE login=".$login);
			//if(!empty($STH)){
				$STH->setFetchMode(PDO::FETCH_ASSOC);
				$row = $STH->fetch();
				if(!empty($row) && !($row['login'] == $_SESSION['login'])){
					array_push($error_change,'user with that login exist');
					$error = 1;
			//}
			}
		}
		
		if (empty($password)){
			array_push($error_change,'not entered password');
			$error = 1;
		}
		
   	if(empty($email)){
			array_push($error_change,'not entered email');
			$error = 1;
		}elseif(!preg_match("/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/",$email)){
			array_push($error_change,'email is incorrect format');
			$error = 1;
		}else{
			$STH = $DBH->prepare('SELECT login from user WHERE email=:email');
			//if(!empty($STH)){
				
			$STH->bindValue(":email", $email);
			$STH->execute();
			$row = $STH->fetch(PDO::FETCH_ASSOC);
			
			if(!empty($row) &&	 !($row['login'] === $_SESSION['login'])){
				array_push($error_change,'user with that email exist');
				$error = 1;
			}
		//}
		}
		if ($error == 2 ){
		//end
		$STH = $DBH->prepare("UPDATE user SET login= :login  WHERE id=$id");  
		$STH->bindParam(':login', $login, PDO::PARAM_STR);
		$STH->execute();
		$STH = $DBH->prepare("UPDATE user SET password= :password  WHERE id=$id");  
		$STH->bindParam(':password', $password, PDO::PARAM_STR);
		$STH->execute();
		$STH = $DBH->prepare("UPDATE user SET name= :name  WHERE id=$id");  
		$STH->bindParam(':name', $name, PDO::PARAM_STR);
		$STH->execute();
		$STH = $DBH->prepare("UPDATE user SET surname= :surname  WHERE id=$id");  
		$STH->bindParam(':surname', $surname, PDO::PARAM_STR);
		$STH->execute();
		$STH = $DBH->prepare("UPDATE user SET email= :email  WHERE id=$id");  
		$STH->bindParam(':email', $email, PDO::PARAM_STR);
		$STH->execute();
		
		//upload photo
				
		//
		if(empty($photo)){
			$photo = $row['photo'];
		}
		$STH = $DBH->prepare("UPDATE user SET photo= :photo  WHERE id=$id");  
		$STH->bindParam(':photo', $photo, PDO::PARAM_STR);
		$STH->execute();
		$s = "profil.php?id=".$id;
		Header("Location: ".$s); 
		}else{
			$_SESSION['error_change']=$error_change;
			$s ="change_profil.php?id=".$id;
			Header("Location: ".$s); 
		}
	}
	//END
	if(!empty($_GET['id'])){
		$id=(int)$_GET['id'];
		
		if(!($id == $_SESSION['profil_id'])){
			echo "1you can't change this profil<p><a href=index.php>HOME	</a>";
		exit;
		}
		echo'<html>
		<head> <link rel="stylesheet" type="text/css" href="style.css"></head>
		<body>
		<div  class="head">
		<a href="index.php">HOME<a>';
		include('language.html');
		
			echo'</div>
		<p>
		<div class="leftside">
		gfdfghjkl,kjhgf
		</div>
		<div class="center">';
		$strSQL = "SELECT * from user WHERE id=".$id;		
		$STH = $DBH->query($strSQL);  			
		$row = $STH->fetch();
		if(!empty($row)){
			$photo=$row['photo'];
			echo "<form ACTION='' METHOD='POST' enctype='multipart/form-data'>";
			echo "<p><img height='150' width='150' src=img/".$row['photo'].">";
			echo '<input type="file" name="file">';
			echo "<p>Login:<input type='text' name='login' value=".$row['login'].">";
			echo "<p>Email:<input type='text' name='email' value=".$row['email'].">";
			echo "<p>Password:<input type='password' name='password' value=".$row['password'].">";
			echo "<p>Name:<input type='text' name='name' value=".$row['name']."> <p>Surname:<input type='text' name='surname' value=".$row['surname'].">";
			echo	"<p><input type='submit' name='change_profil' value='Change'>";
			echo	"</form>";
			//admin
			if(in_array('admin',$_SESSION['roles'])){
				$link_roles="roles.php?id=".$id;
				echo'<FORM ACTION="roles.php" METHOD="POST">';
				$check='';
				if(in_array('user',$_SESSION['roles'])){
				$check=' checked ';
				}
				echo'<input type="checkbox" name="user" value="user"'.$check.'>User<br>';
				$check='';
				if(in_array('user',$_SESSION['roles'])){
				$check=' checked ';
				}
				echo'<input type="checkbox" name="admin" value="admin"'.$check.'>Admin<br>';
				$check='';
				if(in_array('user',$_SESSION['roles'])){
				$check=' checked ';
				}
				echo'<input type="checkbox" name="moderator" value="moderator"'.$check.'>Moderator<br>';
				$check='';
				if(in_array('user',$_SESSION['roles'])){
				$check=' checked ';
				}
				echo'<input type="checkbox" name="locked" value="locked"'.$check.'>Locked<br>';
				
				echo'<input	type="submit" >
				</form>';
			}//
		}else{
			echo"User with that id not exist";
		}
		echo "</div></div><div class='rightside'> ";
		if (!isset($_SESSION['ent'])){	
			$_SESSION['ent'] = 3;	
		}	
		if ($_SESSION['ent'] == 3){	
			if (!empty($_SESSION['erreg'])){	
				echo $_SESSION['erreg'];	
				$_SESSION['erreg'] = '';	
			}	
			if (!empty($_SESSION['erlog'])){	
				echo $_SESSION['erlog'];	
				$_SESSION['erlog']='';	
			}	
			echo "  <FORM ACTION='' METHOD='POST'>	
			<a href='reg.html'>registation</a>	
			</FORM> ";		
			include( "login.html");	
		}	
		else 	
		{	
			echo '<FORM ACTION="" METHOD="POST">	
			<input type="submit" name="create_news" value="Create News">	
			<input type="submit" name="exit" value="Exit">  </FORM>';	
		}	
		echo "</div></body></html>";	
		}else{
			echo "2you can't change this profil<p><a href=".$_SERVER['HTTP_REFERER'].">Back</a>";
		}
?>