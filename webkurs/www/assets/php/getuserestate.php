<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'checkautorization.php';
	//возвращает json обьявлений пользователя
	if($isAutorized == true){
		$sth = $db->prepare("SELECT * FROM `estate` WHERE `login_users`='".$userdata['login']."'");
		$sth->execute();
		$result = $sth->fetchAll();
		echo json_encode($result);
	}
?>