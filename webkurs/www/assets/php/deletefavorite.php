<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'checkautorization.php';
	//удалить заданный айди из избранного
	if($isAutorized){
		$db->prepare("DELETE FROM `users_favorite_estate` WHERE `id_estate`=".$_POST['id']." AND `login_users`='".$userdata['login']."'")->execute();
	}
?>