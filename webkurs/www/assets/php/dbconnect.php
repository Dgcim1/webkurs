<?php
	//Подключение к БД
	$db = null;
	try{
		$db = new PDO('mysql:host=localhost;dbname=webkurs;charset=utf8', 'admin', 'admin');
	}
	catch (PDOException $e){
		print "Error!:" . $e->getMessage() . "<br/>";
		die();
	}
?>