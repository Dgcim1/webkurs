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
<!-- section -->
<section>
	<?php
		//получение инфо о всех пользователях в $allUsersInfo (только для админов)
		require_once 'admingetusers.php';
		foreach ($allUsersInfo as &$value) {
			echo '
				<article>
					<div>
						<div>
							<h3>ID: '.$value['id'].'</h3>
							<h3>Login: '.$value['login'].'</h3>
							<h3>Pseudonym: '.$value['pseudonym'].'</h3>
							<h3>Mail: '.$value['mail'].'</h3>
							<h3>Number: '.$value['number'].'</h3>
							<h3>Root: '.$value['root'].'</h3>
						</div>
						<div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-primary" onclick="deleteUser('.$value['id'].')")">Удалить</button>
								<button type="button" class="btn btn-primary" onclick="editUser('.$value['id'].')">Редактировать</button>
							</div>
						</div>
					</div>
				</article>
			';
		}
	?>
	<script>
		var all_users = JSON.parse('<?php echo json_encode($allUsersInfo);?>');
	</script>
</section>