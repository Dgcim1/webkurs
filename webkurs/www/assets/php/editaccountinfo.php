<?php
	//проверка на активацию изменения инфо об аккаунте (должен быть запрос типа POST с параметром $_POST['is-edit-account'])
	//подключаем функции
	require_once 'assets/php/functions.php';
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'assets/php/checkautorization.php';
	//проверяем, была ли вызвана форма регистрации
	if(isset($_POST['submit'])){
		if(isset($_POST['is-edit-account'])){
			//проверяем, изменил ли пользователь псевдоним
			if($_POST['pseudonym'] !=  $userdata['pseudonym']){
				//проверяем, есть ли пользователь с таким псевдонимом
				$sth = $db->prepare("SELECT id FROM users WHERE pseudonym='".$_POST['pseudonym']."'");
				$sth->execute();
				$result = $sth->fetchAll();
				if(count($result) > 0){
					echo '
						<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
							Пользователь с таким псевдонимом уже существует в базе данных! '.$_POST['pseudonym'].' - '.$userdata['pseudonym'].'
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					';
					return;
				}
				//меняем псевдоним
				$sth = $db->prepare("UPDATE `users` SET pseudonym='".$_POST['pseudonym']."' WHERE login='".$userdata['login']."'")->execute();
				//меняем инфо о псевдониме пользователя
				$userdata['pseudonym'] = $_POST['pseudonym'];
			}
			//проверяем, изменил ли пользователь e-mail
			if($_POST['mail'] !=  $userdata['mail']){
				//меняем почту
				$sth = $db->prepare("UPDATE `users` SET mail='".$_POST['mail']."' WHERE login='".$userdata['login']."'")->execute();
				//меняем инфо о почте пользователя
				$userdata['mail'] = $_POST['mail'];
			}
			//проверяем, изменил ли пользователь номер телефона
			if($_POST['number'] !=  $userdata['number']){
				//меняем номер
				$sth = $db->prepare("UPDATE `users` SET number='".$_POST['number']."' WHERE login='".$userdata['login']."'")->execute();
				//меняем инфо о номере пользователя
				$userdata['number'] = $_POST['number'];
			}
			//выводим сообщение об успешном изменении параметров аккаунта
			echo '
					<div class="alert alert-success alert-dismissible fade show main-message" role="alert">
						Информация об аккаунте успешно изменена!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
				';
		}
	}
?>