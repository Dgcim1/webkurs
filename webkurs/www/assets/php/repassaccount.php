<?php
	//генерирует ссылку для восстановления пароля (для логина $_POST['repass_login'])
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	if(isset($_POST['repass_login'])){
		//проверяем, существует ли такой логин
		$sth = $db->prepare("SELECT id FROM users WHERE login='".$_POST['repass_login']."'");
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
		$link = 'http://'.$_SERVER['HTTP_HOST'].'/repass.php?hash=';
		//проверяем, был ли ранее создан запрос на восстановление пароля
		$sth = $db->prepare("SELECT * FROM `users_repass` WHERE login_users='".$_POST['repass_login']."'");
		$sth->execute();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		$hash = '';
		if(count($result) == 1){
			//генерируем хеш
			$hash = md5(generateCode(10));
			$db->prepare("INSERT INTO `users_repass` (`hash`, `repass_time`, `login_users`) VALUES ('".$hash."',NOW(),'".$_POST['repass_login']."')")->execute();
		}
		else{
			$hash = $result['hash'];
		}
		$link .= $hash;
		echo '	<div class="alert alert-primary alert-dismissible fade show main-message" role="alert">
					Ваша ссылка для восстановления пароля: <br>
					<a href="'.$link.'" target="_blank">'.$link.'</a><br>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
	}
?>