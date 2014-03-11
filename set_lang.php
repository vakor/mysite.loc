<?php
if (isset($_COOKIE['lang'])){
  $lang = $_COOKIE['lang'];
}
else{
  $lang = 'eng';
  setcookie('lang', $lang);
}
if (!empty($_GET['lang'])){
  $lang = $_GET['lang'];
  setcookie('lang', $lang);  
}

?>