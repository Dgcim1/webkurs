<?php
	//подключаем функции
	require_once 'assets/php/functions.php';
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверка на активацию формы входа в аккаунт (должен быть запрос типа POST с параметром $_POST['is-login'])
	require_once 'assets/php/login.php';
	//проверка на активацию формы регистрации аккаунта (должен быть запрос типа POST с параметром $_POST['is-registration'])
	require_once 'assets/php/registration.php';
	//проверка на активацию формы выхода из аккаунта (должен быть запрос типа POST с параметром $_POST['is-logout'])
	require_once 'assets/php/logout.php';
	//проверка на активацию изменения инфо об аккаунте (должен быть запрос типа POST с параметром $_POST['is-edit-account'])
	require_once 'assets/php/editaccountinfo.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'assets/php/checkautorization.php';
	if($userdata['root'] != 'admin'){
		echo '
			<html>
				<head>
					<meta http-equiv="Refresh" content="0; URL=http://'.$_SERVER['HTTP_HOST'].'">
				</head>
			</html>';
		exit();
	}
?>
<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<title>Админ-панель</title>
	</head>
	<body>
		<!-- header -->
		<?php require_once 'assets/php/header.php'; ?>
		<!-- aside -->
		
		<!-- section -->
		<?php require_once 'assets/php/adminsection.php'; ?>
		<!-- footer -->
		<?php require_once 'assets/php/footer.php'; ?>
		
		<script src="assets/js/jquery-3.5.1.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/admin.js"></script>
	</body>
</html>