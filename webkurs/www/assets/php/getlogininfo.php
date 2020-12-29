<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//возвращает json обьект из $_POST['login']
	$sth = $db->prepare("SELECT `pseudonym`, `mail`, `number` FROM `users` WHERE login='".$_POST['login']."' LIMIT 1");
	$sth->execute();
	$result = $sth->fetch();//PDO::FETCH_ASSOC
	echo json_encode($result);
?>