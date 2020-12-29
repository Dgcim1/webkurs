<?php
	//подключаем функции
	require_once 'assets/php/functions.php';
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверка на активацию формы входа в аккаунт (должен быть запрос типа POST с параметром $_POST['is-login'])
	if(isset($_POST['submit'])){
		if(isset($_POST['is-login'])){
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
			//проверяем, сущестует ли пользователь с таким именем
			$sth = $db->prepare("SELECT id FROM users WHERE login='".$_POST['login']."'");
			$sth->execute();
			$result = $sth->fetchAll();
			if(count($result) == 0){
				echo '
					<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
						Пользователя с таким логином не существует в базе данных!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
				return;
			}
			//вытаскиваем из БД запись, у которой логин равняеться введенному
			$sth = $db->prepare("SELECT * FROM users WHERE login = '".$_POST['login']."' LIMIT 1");
			$sth->execute();
			$data = $sth->fetch();
			//сравниваем пароли
			if($data['password'] === md5(md5(trim($_POST['password'])))){
				//сохраняем данные пользователя в cookie и в базе данных
				//генерируем случайное число и шифруем его
				$hash = md5(generateCode(10));
				//переводим IP в строку
				$insip = ", ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
				$db->prepare("INSERT INTO users_connects SET hash='".$hash."' ".$insip.", login_users='".$_POST['login']."'")->execute();
				$id = $db->lastInsertId();
				//ставим куки
				setcookie("id", $id, time()+60*60*24*30, "/");
				setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true); // httponly !!!
				echo '
				<html>
					<head>
						<meta http-equiv="Refresh" content="0; URL=http://'.$_SERVER['HTTP_HOST'].'">
					</head>
				</html>';
				exit();
			}
			else{
				echo '
					<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
						Вы ввели неправильный логин/пароль!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
			}
			
		}
	}
?>