<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	if(isset($_POST['is-filters'])){
		$query = "SELECT * FROM `estate` WHERE ";
		//тип
		if($_POST['data-filters']['type-house'] == 'Квартира'){
			$query .= "`type`='Квартира'";
		}
		else if($_POST['data-filters']['type-house'] == 'Комната'){
			$query .= "`type`='Комнату'";
		}
		else if($_POST['data-filters']['type-house'] == 'Дом'){
			$query .= "`type`='Дом'";
		}
		else if($_POST['data-filters']['type-house'] == 'Коммерческая недвижимость'){
			$query .= "`type`='Коммерческая недвижимость'";
		}
		//минимальная цена
		if($_POST['data-filters']['min-price'] != ''){
			$query .= " AND `price`>=".$_POST['data-filters']['min-price'];
		}
		//максимальная цена
		if($_POST['data-filters']['max-price'] != ''){
			$query .= " AND `price`<=".$_POST['data-filters']['max-price'];
		}
		//минимальная площадь
		if($_POST['data-filters']['min-square'] != ''){
			$query .= " AND `square`>=".$_POST['data-filters']['min-square'];
		}
		//максимальная площадь
		if($_POST['data-filters']['max-square'] != ''){
			$query .= " AND `square`<=".$_POST['data-filters']['max-square'];
		}
		//адрес
		if($_POST['data-filters']['town'] != ''){
			$query .= " AND `adress` LIKE '".$_POST['data-filters']['town']."%'";
		}
		$query .= " LIMIT 0 , 30";
	}
	else{
		$query = "SELECT * FROM `estate`";
	}
	$sth = $db->prepare($query);
	$sth->execute();
	$result = $sth->fetchAll();
	echo json_encode($result);
?>