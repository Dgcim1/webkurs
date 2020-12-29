<!DOCTYPE HTML>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<title>Курсовик</title>
		<style>
			#main-repass-form{
				width: 50%;
				margin: auto;
				margin-top: 20vh;
				border-style: solid;
				border-color: black;
				border-width: 1px;
				border-radius: 5px;
				padding: 15px;
			}
			.invisible{
				display: none;
			}
		</style>
	</head>
	<body>
		<!-- repass form -->
		<div id='main-repass-form'>
			<h3>Форма восстановления пароля</h3>
			<form action='<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>' method='post'>
				<input type='text' name='hash' class='invisible' value='<?php echo $_GET['hash']; ?>'></input>
				<input type='text' name='is-repass-account' class='invisible'></input>
				<div class="form-group">
					<label>Новый пароль</label>
					<input type="password" name='password' class="form-control">
				</div>
				<input type="submit" class="btn btn-primary" value='Изменить'></input>
			</form>
		</div>
		<script src="assets/js/jquery-3.5.1.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
	</body>
</html>