<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'checkautorization.php';
	//меняем инфо о аккаунте
	if($isAutorized == true && $userdata['root'] == 'admin'){
		$query = "UPDATE `users` SET `pseudonym`='".$_POST['data-acc']['pseudonym']."',`mail`='".$_POST['data-acc']['mail']."',`number`='".$_POST['data-acc']['number']."',`root`='".$_POST['data-acc']['root']."' WHERE `login`='".$_POST['data-acc']['login']."'";
		$db->prepare($query)->execute();
		//выводим сообщение об успешном изменении параметров аккаунта
		echo '
				<div class="alert alert-success alert-dismissible fade show main-message" role="alert">
					Информация об аккаунте успешно изменена!
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