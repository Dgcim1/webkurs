<?php
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	$isAutorized = false;
	if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])){
		$sth = $db->prepare("SELECT *,INET_NTOA(ip) AS ip FROM users_connects WHERE id = '".intval($_COOKIE['id'])."'");
		$sth->execute();
		$userdata = $sth->fetch();
		if(($userdata['hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id'])
			or (($userdata['ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['ip'] !== "0")))
		{
			//удаляем запись в БД если она существует
			$db->prepare("DELETE FROM `users_connects` WHERE id = ".$_COOKIE['id'].", hash = '".$_COOKIE['hash']."'")->execute();
			//удаляем cookie
			setcookie("id", "", time() - 3600*24*30*12, "/");
			setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
			echo '
				<div class="alert alert-primary alert-dismissible fade show main-message" role="alert">
					Данные входа устарели, просьба авторизоваться снова.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
		}
		else{
			$isAutorized = true;
			$sth = $db->prepare("SELECT * FROM users WHERE login = '".$userdata['login_users']."'");
			$sth->execute();
			$userdata = $sth->fetch();
		}
	}
?>