<?php
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверка на активацию формы выхода из аккаунта (должен быть запрос типа POST с параметром $_POST['is-logout'])
	if(isset($_POST['submit'])){
		if(isset($_POST['is-logout'])){
			//удаляем запись в БД если она существует
			$db->prepare("DELETE FROM `users_connects` WHERE id = ".$_COOKIE['id']." AND hash = '".$_COOKIE['hash']."'")->execute();
			//удаляем cookie
			setcookie("id", "", time() - 3600*24*30*12, "/");
			setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!!
			echo '
				<html>
					<head>
						<meta http-equiv="Refresh" content="0; URL=http://'.$_SERVER['HTTP_HOST'].'">
					</head>
				</html>';
			exit();
		}
	}
?>