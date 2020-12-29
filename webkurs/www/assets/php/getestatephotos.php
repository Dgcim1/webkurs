<?php
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//возвращает фото недвижимости с заданного idate
	if(isset($_POST['id'])){
		$sth = $db->prepare("SELECT * FROM `estate_photos` WHERE `id_estate`=".$_POST['id']);
		$sth->execute();
		$result = $sth->fetchAll();
		echo json_encode($result);
	}
?>