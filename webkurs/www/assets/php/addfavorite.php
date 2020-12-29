<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'checkautorization.php';
	//добавить заданный айди в избранное
	if($isAutorized){
		$db->prepare("INSERT INTO `users_favorite_estate`(`id_estate`, `login_users`) VALUES (".$_POST['id'].",'".$userdata['login']."')")->execute();
	}
	
?>