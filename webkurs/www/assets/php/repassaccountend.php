<?
	//проверка на активацию изменения инфо об аккаунте (должен быть запрос типа POST с параметром $_POST['is-repass-account'])
	//подключаем функции
	require_once 'assets/php/functions.php';
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	if(isset($_POST['is-repass-account'])){
		//проверяем наличие строки с данным хешом в бд
		$sth = $db->prepare("SELECT * FROM `users_repass` WHERE `hash` = '".$_POST['hash']."'");
		$sth->execute();
		$result = $sth->fetch();
		if(count($result) == 0){
			echo '
				<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
					Ссылка для восстановления пароля недействительна!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
			return;
		}
		//заменяем хеш пароля в БД
		$db->prepare("UPDATE `users` SET `password`='".md5(md5(trim($_POST['password'])))."' WHERE `login`='".$result['login_users']."'")->execute();
		//удаляем всех авторизованных пользователей
		$db->prepare("DELETE FROM `users_connects` WHERE `login_users`='".$result['login_users']."'")->execute();
		//удаляем запись генерации ссылки восстановления пароля
		$db->prepare("DELETE FROM `users_repass` WHERE `hash`='".$result['hash']."'")->execute();
		echo '
			<div class="alert alert-success alert-dismissible fade show main-message" role="alert">
				Восстановление пароля прошло успешно!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		';
	}
?>