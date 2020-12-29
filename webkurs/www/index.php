<?php
	//подключаем функции
	require_once 'assets/php/functions.php';
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверка на активацию изменения инфо об аккаунте (должен быть запрос типа POST с параметром $_POST['is-repass-account'])
	require_once 'assets/php/repassaccountend.php';
	//проверка на активацию формы входа в аккаунт (должен быть запрос типа POST с параметром $_POST['is-login'])
	require_once 'assets/php/login.php';
	//проверка на активацию формы регистрации аккаунта (должен быть запрос типа POST с параметром $_POST['is-registration'])
	require_once 'assets/php/registration.php';
	//проверка на активацию формы выхода из аккаунта (должен быть запрос типа POST с параметром $_POST['is-logout'])
	require_once 'assets/php/logout.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'assets/php/checkautorization.php';
	//проверка на активацию изменения инфо об аккаунте (должен быть запрос типа POST с параметром $_POST['is-edit-account'])
	require_once 'assets/php/editaccountinfo.php';
	//проверка на активацию изменения инфо об аккаунте (должен быть запрос типа POST с параметром $_POST['is-account-create-ad'])
	require_once 'assets/php/createrealty.php';
	//проверка на активацию изменения инфо о заданном обьявлении (должен быть запрос типа POST с параметром $_POST['is-edit-elem'])
	require_once 'assets/php/editestate.php';
?>
<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<title>Курсовик</title>
	</head>
	<body>
		<!-- header -->
		<?php require_once 'assets/php/header.php'; ?>
		<!-- aside -->
		<?php require_once 'assets/php/aside.php'; ?>
		<!-- section -->
		<?php require_once 'assets/php/section.php'; ?>
		<!-- footer -->
		<?php require_once 'assets/php/footer.php'; ?>
		
		<script>
			var userdata_login = '<?php echo $userdata['login'];?>';
			var userdata_root = '<?php echo $userdata['root'];?>';
		</script>
		<script src="assets/js/jquery-3.5.1.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<script src="assets/js/script.js"></script>
	</body>
</html>