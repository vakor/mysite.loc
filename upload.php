<?php
session_start();
include('connect_db.php');
$id = (int)$_SESSION['profil_id'];
$uploaddir = 'img/';
    $type = $_FILES["userfile"]["type"];
    
 
if ((($type == "image/jpeg") 
    || ($type == "image/png"))) {
    $type = $_FILES["userfile"]["type"];
    $pos_slash = strpos($_FILES["userfile"]["type"],"/");
    $uploadfile = time().chr(rand(65,90)).chr(rand(97,122)).".".substr($type,$pos_slash+1,strlen($type)-$pos_slash);
    if (move_uploaded_file($_FILES['userfile']['tmp_name'],$uploaddir.$uploadfile)) {
        $STH = $DBH->prepare("SELECT * FROM user WHERE id=$id"); 
        $STH->execute();
        $row = $STH->fetch(PDO::PARAM_STR);
        if( !($row['photo'] == "empty.jpg")){
            $photo = "img/".$row['photo'];  
            unlink($photo);
        }
    //echo "Файл корректен и был успешно загружен.\n";
    //
    $width = 150;
    $height = 150;
    $size = getimagesize($uploaddir.$uploadfile);
    $width_orig = $size[0];
    $height_orig = $size[1];
    $image_p = imagecreatetruecolor($width, $height);
    if ($type == "image/jpeg"){
        $image = imagecreatefromjpeg($uploaddir.$uploadfile);
    }elseif ($type == "image/png"){
        $image = imagecreatefrompng($uploaddir.$uploadfile);  
    }
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
   
    if ($type == "image/jpeg"){
        imagejpeg($image_p,$uploaddir.$uploadfile);
    }elseif ($type == "image/png"){
        imagepng($image_p,$uploaddir.$uploadfile);  
    }
    
		$STH = $DBH->prepare("UPDATE user SET photo= :photo  WHERE id=$id");  
		$STH->bindParam(':photo', $uploadfile, PDO::PARAM_STR);
		$STH->execute();
    }   
 
}else{
 
    echo '<a href='.$_SERVER['HTTP_REFERER'].'>BACK</a>wrong type';
    exit;
}
header('Location:'.$_SERVER['HTTP_REFERER']);
?>