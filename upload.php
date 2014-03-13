<?php
session_start();
include('connect_db.php');
$id = (int)$_SESSION['profil_id'];
$uploaddir = 'img/';
if ((($_FILES["userfile"]["type"] == "image/gif") 
    || ($_FILES["userfile"]["type"] == "image/jpeg") 
    || ($_FILES["userfile"]["type"] == "image/png") 
    || ($_FILES["userfile"]["type"] == "image/pjpeg")
    || ($_FILES["userfile"]["type"] == "image/jpg"))) {
    $type = $_FILES["userfile"]["type"];
    $pos_slash = strpos($_FILES["userfile"]["type"],"/");
    $uploadfile = time().chr(rand(65,90)).chr(rand(97,122)).".".substr($type,$pos_slash+1,strlen($type)-$pos_slash);
    if (move_uploaded_file($_FILES['userfile']['tmp_name'],$uploaddir.$uploadfile)) {
        $STH = $DBH->prepare("SELECT * FROM user WHERE id=$id");  
        $STH->execute();
        $row = $STH->fetch(PDO::PARAM_STR);
       
        if( !$row['photo'] == "empty.jpg"){
            $photo = "img/".$row['photo'];  
            unlink($photo);
        }
    echo "Файл корректен и был успешно загружен.\n";
		$STH = $DBH->prepare("UPDATE user SET photo= :photo  WHERE id=$id");  
		$STH->bindParam(':photo', $uploadfile, PDO::PARAM_STR);
		$STH->execute();
    }
}else{
    echo 'wrong data';
    exit;
}
header('Location:'.$_SERVER['HTTP_REFERER']);
?>