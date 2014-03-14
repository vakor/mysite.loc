<?php

$voc = array (
  "eng" => array(
		"login" => "Login",
		"password" => "Password",
		"email" => "Email",
		"title" => "Title",
		"author" => "author",
		"home" => "Home",
		"read_more" => "Read more",
		"addnews" => "Add news",
		"exit" => "Exit",
		"profil" => "Profil" ,
		"name" => "Name",
 		"surname" => "Surname",
		"date_of_registration" =>"Date of registration",
		"date_of_login" =>"Date of last login",
		"delete" =>"Delete",
		"change" =>"Change",
		"user_id_not_exist" => "User with that id not exist",
		"text" => "Text",
		"add" => "Add",
		"user_menu" => "User menu",
		"register" => "Register",
		"upload" => "Upload",
		"file" => "FILE",	
		),
	"ukr" => array(
		"login" => "Логін",
		"password" => "Пароль",
		"email" => "Пошта",
		"title" => "Заголовок",
		"author" => "Автор",
		"home" => "Головна",
		"read_more" => "Читати повністю",
		"addnews" => "Додати новину",
		"exit" => "Вийти",
		"profil" => "Профіль",
		"name" => "Ім'я",
 		"surname" => "Призвіще",
		"date_of_registration" =>"Дата реєстрації",
		"date_of_login" =>"Дата останнього входу",
		"delete" =>"Видалити",
		"change" =>"Змінити",
		"user_id_not_exist" => "Користувача з таким id не існує",
		"text" => "Текст",
		"add" => "Додати",
		"user_menu" => "Меню користувача",
		"register" => "Зареєструвати",
		"upload" => "Завантажити",
		"file" => "Файл",
		),
  );

function t($language, $word){
	global $voc;
	return $voc[$language][$word];
}
?>
