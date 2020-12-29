<?php
	//подключаем функции
	require_once 'assets/php/functions.php';
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'assets/php/checkautorization.php';
	//получение инфо о всех пользователях в $allUsersInfo (только для админов)
	if($isAutorized == true && $userdata['root'] == 'admin'){
		$query = "SELECT * FROM `users`";
		$sth = $db->prepare($query);
		$sth->execute();
		$allUsersInfo = $sth->fetchAll();
	}
?>