<?php

echo "<div class='post'>";
$sql = "SELECT * FROM post WHERE id=:id";
$STH = $DBH->prepare($sql);
$STH->bindValue(':id',$id);
$STH->execute();
$row = $STH->fetch();
$count = $row['count'];
$sum = $row['sum'];
if($count > 0 ){
  $rating = $sum / $count;
  echo t($lang,'mark').$rating.t($lang,'users').$count;
}else{
  echo t($lang,'not_voted');
}

if($_SESSION['ent'] === 2){
  // чи голосував
  
  $sql = "SELECT COUNT(*) FROM vote WHERE user_id=:user_id AND post_id=:post_id";
  $STH = $DBH->prepare($sql);
  $STH->bindValue(':user_id',$_SESSION['profil_id']);
  $STH->bindValue(':post_id',$id);
  $STH->execute();
  $row = $STH->fetch();
//echo $row[0];exit;
  if ($row[0] == 0){
    include('form_vote.html');
  }else{
    echo '<a href=delete_mark.php?id='.$id.'>'.t($lang,'delete').'</a><p>';
  }
}
echo "</div>";
?>