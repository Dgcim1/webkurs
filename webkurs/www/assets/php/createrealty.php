<?php
	//подключаем функции
	require_once 'assets/php/functions.php';
	//подключаем БД (доступна как $db)
	require_once 'assets/php/dbconnect.php';
	//проверка на активацию изменения инфо об аккаунте (должен быть запрос типа POST с параметром $_POST['is-account-create-ad'])
	if(isset($_POST['is-account-create-ad'])){
		//создаем запрос на создание строки в бд
		$query = "INSERT INTO `estate`(`type`, `price`, `login_users`, `square`, `adress`, `publication_date`, `info`) VALUES ('".$_POST['type']."',".$_POST['price'].",'".$userdata['login']."',".$_POST['square'].",'".$_POST['adress']."',NOW(),'".$_POST['info']."')";
		$db->prepare($query)->execute();
		$id = $db->lastInsertId();
		//обрабатываем файлы
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
					$db->prepare("INSERT INTO `estate_photos`(`id_estate`, `photo_path`) VALUES (".$id.",'assets/uploads/".$hash.'.'.$loadedFileExtension."')")->execute();
				} else {
					//echo "Возможная атака с помощью файловой загрузки!\n";
				}
			}
		}
		echo '
				<div class="alert alert-success alert-dismissible fade show main-message" role="alert">
					Обьявление успешно создано!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			';
	}
?>