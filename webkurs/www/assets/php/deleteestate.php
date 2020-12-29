<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'checkautorization.php';
	//удаляет запись $_POST['id'] при наличии соответствующих прав, возвращает message
	$sth = $db->prepare("SELECT `login_users` FROM `estate` WHERE `id`=".$_POST['id']."LIMIT 1");
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	//проверяем наличие прав, если их нет, то выводим соотв сообщение
	if($isAutorized == true && ($userdata['root'] == 'admin' || $userdata['login'] == $result['login_users'])){
		//удаляем запись
		$db->prepare("DELETE FROM `estate` WHERE `id`=".$_POST['id'])->execute();
		//удаляем все связанные записи фото
		$db->prepare("DELETE FROM `estate_photos` WHERE `id_estate`=".$_POST['id'])->execute();
		echo '
			<div class="alert alert-success alert-dismissible fade show main-message" role="alert">
				Удаление прошло успешно!
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