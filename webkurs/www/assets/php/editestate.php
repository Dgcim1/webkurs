<?php
	//подключаем функции
	require_once 'functions.php';
	//подключаем БД (доступна как $db)
	require_once 'dbconnect.php';
	//проверка на авторизацию по cookie (результат в $isAutorized, $userdata['инфо об аккаунте'])
	require_once 'checkautorization.php';
	//проверка на активацию изменения инфо о заданном обьявлении (должен быть запрос типа POST с параметром $_POST['is-edit-elem'])
	if(isset($_POST['is-edit-elem'])){
		//проверяем пользователя на права доступа для изменения данного обьявления
		$sth = $db->prepare("SELECT `login_users` FROM `estate` WHERE `id`=".$_POST['id']."LIMIT 1");
		$rrr = $sth->execute() == true;
		//$result = $sth->fetch();
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		//проверяем наличие прав, если их нет, то выводим соотв сообщение
		//if($isAutorized == true && ($userdata['root'] == 'admin' || $userdata['login'] == $result['login_users'])){
		if($isAutorized == true){
			$db->prepare("UPDATE `estate` SET `type`='".$_POST['type']."',`price`=".$_POST['price'].",`square`=".$_POST['square'].",`adress`='".$_POST['adress']."',`info`='".$_POST['info']."' WHERE `id`=".$_POST['id'])->execute();
			//изменяем картиночки
			//удаляем все удаленные
			$arr = json_decode($_POST['delete-photos-array']);
			foreach ($arr as &$value) {
				$db->prepare("DELETE FROM `estate_photos` WHERE `id`=".$value)->execute();
			}
			//добавляем все добавленные
			foreach ($_FILES["picfile"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					// Получение информации о расширении файла:
					$tempFileInfo = pathinfo($_FILES["picfile"]["name"][$key]);
					$loadedFileExtension = $tempFileInfo['extension'];
					// Папка для загрузки аватаров:
					$uploaddir = '/home/'.$_SERVER['HTTP_HOST'].'/www/assets/uploads/';
					//генерируем случ название файла
					$hash = md5(generateCode(10));
					// Составляем имя сохраняемого файла из userId и расширения файла:
					$uploadfile = $uploaddir . $hash.'.'.$loadedFileExtension;
					
					if (move_uploaded_file($_FILES["picfile"]['tmp_name'][$key], $uploadfile)) {
						// Заносим в БД информацию о загруженном файле:
						$db->prepare("INSERT INTO `estate_photos`(`id_estate`, `photo_path`) VALUES (".$_POST['id'].",'assets/uploads/".$hash.'.'.$loadedFileExtension."')")->execute();
					} else {
						//echo "Возможная атака с помощью файловой загрузки!\n";
					}
				}
			}
			echo '
				<div class="alert alert-success alert-dismissible fade show main-message" role="alert">
					Обьявление успешно изменено!
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
	}
?>