<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'checkautorization.php';
	//удаляет пользователя с заданным id Нужны права администратора
	if($isAutorized == true && $userdata['root'] == 'admin'){
		$db->prepare("DELETE FROM `users` WHERE `id`=".$_POST['id'])->execute();
		echo '
				<div class="alert alert-success alert-dismissible fade show main-message" role="alert">
					Пользователь удален успешно!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		return;
	}
	echo '
			<div class="alert alert-danger alert-dismissible fade show main-message" role="alert">
				У вас недостаточно прав!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		';
?>