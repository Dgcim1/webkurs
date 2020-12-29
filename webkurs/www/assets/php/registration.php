<?php
	//проверка на активацию формы регистрации аккаунта (должен быть запрос типа POST с параметром $_POST['is-registration'])
	//подключаем функции
	require_once 'assets/php/functions.php';
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверяем, была ли вызвана форма регистрации
	if(isset($_POST['submit'])){
		if(isset($_POST['is-registration'])){
			//проверяем логин
			if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login'])){
				echo '
					<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
						Логин может состоять только из букв английского алфавита и цифр!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
				return;
			}
			if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30){
				echo '
					<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
						Логин должен быть не меньше 3-х символов и не больше 30!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
				return;
			}
			//проверяем, не сущестует ли пользователя с таким именем
			$sth = $db->prepare("SELECT id FROM users WHERE login='".$_POST['login']."'");
			$sth->execute();
			$result = $sth->fetchAll();
			if(count($result) > 0){
				echo '
					<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
						Пользователь с таким логином уже существует в базе данных!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
				return;
			}
			//проверяем, не сущестует ли пользователя с таким псевдонимом как логин
			$sth = $db->prepare("SELECT id FROM users WHERE pseudonym='".$_POST['login']."'");
			$sth->execute();
			$result = $sth->fetchAll();
			if(count($result) > 0){
				echo '
					<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
						Пользователь с таким логином уже существует в базе данных!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
				return;
			}
			$login = $_POST['login'];
			//убираем лишние пробелы и делаем двойное хеширование
			$password = md5(md5(trim($_POST['pass'])));
			//сохраняем пользователя в БД
			$db->prepare("INSERT INTO users SET login='".$login."', password='".$password."', mail='".$_POST['mail']."', pseudonym='".$login."'")->execute();
			//пользователь добавлен
			//сохраняем данные регистрации в cookie и в базе данных
			//генерируем случайное число и шифруем его
			$hash = md5(generateCode(10));
			//переводим IP в строку
			$insip = ", ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
			$db->prepare("INSERT INTO users_connects SET hash='".$hash."' ".$insip.", login_users='".$login."'")->execute();
			$id = $db->lastInsertId();
			//ставим куки
			setcookie("id", $id, time()+60*60*24*30, "/");
			setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!
			//выводим пользователю сообщение об успешной регистрации
			echo '
				<html>
					<head>
						<meta http-equiv="Refresh" content="0; URL=http://'.$_SERVER['HTTP_HOST'].'">
					</head>
				</html>';
			exit();
			echo '
				<div class="alert alert-success alert-dismissible fade show main-message" role="alert">
					Регистрация прошла успешно!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
			return;
		}
	}
?>