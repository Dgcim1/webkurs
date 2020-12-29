<!-- header -->
<?php
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'assets/php/checkautorization.php';
?>
<header>
	<div id='header-main-logo' class='link raleway-regular'>
		<a href='<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>'>МНОГОЭТАЖКА</a>
	</div>
	<nav class='proxima-nova-regular'>
		<!-- <div class='header-box'>
			Дома
		</div>
		<div class='header-box'>
			Квартиры
		</div>
		<div class='header-box'>
			Комнаты
		</div>
		<div class='header-box'>
			Коммерческая
		</div> -->
		<button id='header-account' class='header-button header-box proxima-nova-regular'>
			<?php echo ($isAutorized == true ? 'Аккаунт' : 'Войти');?>
		</button>
	<nav>
</header>
<div id='account-panel' class='invisible raleway-regular'>
	<?php
		if($isAutorized == false) echo "
			<div id='account-login-panel'>
				<div id='account-login-panel-header'>Войти</div>
				<form id='account-login-panel-form' method='post'>
					<input type='text' name='is-login' class='invisible'></input>
					<div class='account-form-elem'>
						Логин
						<input type='text' name='login' id='account-login-text'></input>
					</div>
					<div class='account-form-elem'>
						Пароль
						<input type='password' name='password'></input>
					</div>
					<div class='account-form-elem'>
						<small class='form-text text-muted'>В вашем браузере должен быть разрешен прием cookies.</small>
					</div>
					<div class='account-form-elem'>
						<input type='submit' name='submit' value='Войти' class='account-form-submit'></input>
						<label id='account-to-registration' class='account-panel-link-label'>Регистрация</label>
						<br>
						<label id='account-to-restore-password' class='account-panel-link-label'>Восстановить пароль</label>
					</div>
				</form>
			</div>
			<div id='account-registration-panel' class='invisible'>
				<div id='account-registration-panel-header'>Регистрация</div>
				<form id='account-registration-panel-form' method='post'>
					<input type='text' name='is-registration' class='invisible'></input>
					<div class='account-form-elem'>
						Логин
						<input type='text' name='login'></input>
					</div>
					<div class='account-form-elem'>
						E-Mail
						<input type='text' name='mail'></input>
					</div>
					<div class='account-form-elem'>
						Пароль
						<input type='password' name='password'></input>
					</div>
					<div class='account-form-elem'>
						<label id='account-to-login' class='account-panel-link-label'>Войти</label>
						<input type='submit' name='submit' value='Регистрация' class='account-form-submit'></input>
					</div>
				</form>
			</div>
		";
		else echo "
			<div id='account-account-panel'>
				<div id='account-account-panel-header'>Аккаунт <button type='button' class='btn btn-link' id='account-account-is-edit'>Изменить</button></div>
				<h4>Логин: ".$userdata['login']."</h4>
				<div id='account-account-ads'>
					<div class='btn-group account-account-btn-group' role='group'>
					<button type='button' class='btn btn-info' id='account-to-my-ads'>Мои обьявления</button>
					<button type='button' class='btn btn-info' id='account-to-favorite-ads'>Избранное</button>
					</div>
				</div>
				<div class='account-box-info' id='account-ads-box'>
				</div>
				<form id='account-registration-panel-form' method='post'>
					<input type='text' name='is-logout' class='invisible'></input>
					<div class='account-form-elem'>
						<input type='submit' name='submit' value='Выйти' class='account-form-submit'></input>
						<button type='button' class='btn btn-link' id='account-account-is-repass'>Сменить пароль</button>
						<br>
						".($userdata['root'] == 'admin' ? "<a class='btn btn-link' id='account-account-is-admin-panel' href='admin.php' role='button'>Панель администратора</a>" : "")."
					</div>
				</form>
			</div>
			<div id='account-accountedit-panel' class='invisible'>
				<div id='account-accountedit-panel-header'>Изменить <button type='button' class='btn btn-link' id='account-account-is-account'>Назад</button></div>
				<form id='account-registration-panel-form' method='post'>
					<input type='text' name='is-edit-account' class='invisible'></input>
					<div class='account-form-elem'>
						Псевдоним
						<input type='text' name='pseudonym' value='".$userdata['pseudonym']."'></input>
					</div>
					<div class='account-form-elem'>
						E-Mail
						<input type='text' name='mail' value='".$userdata['mail']."'></input>
					</div>
					<div class='account-form-elem'>
						Телефон
						<input type='text' name='number' value='".$userdata['number']."'></input>
					</div>
					<div class='account-form-elem'>
						<input type='submit' name='submit' value='Изменить' class='account-form-submit'></input>
					</div>
				</form>
			</div>
		";
	?>
</div>