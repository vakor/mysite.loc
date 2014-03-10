<?php

$voc = array (
  "eng" => array(
		"login" => "Login",
		"password" => "Password",
		"author" => "author",
	),
	"ukr" => array("login" => "Логін","password" => "Пароль", "author" => "Автор"),
  "rus" => array("login" => "Логин", "password" => "Пароль", "author" => "Автор"),
);

function t($language, $word){
	global $voc;
	return $voc[$language][$word];
}

echo t('eng','login');
?>
