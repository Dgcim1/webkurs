<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//возвращает json избранных айди пользователя
	//$sth = $db->prepare("SELECT * FROM `users_favorite_estate` WHERE `login_users`='".$_POST['login']."'");
	$query = "SELECT `estate`.`id`, `type`, `price`, `estate`.`login_users`, `square`, `adress`, `publication_date`, `info` FROM `users_favorite_estate` JOIN `estate` ON `id_estate` = `estate`.`id` WHERE `users_favorite_estate`.`login_users`='".$_POST['login']."'";
	$sth = $db->prepare($query);
	$sth->execute();
	$result = $sth->fetchAll();
	echo json_encode($result);
?>