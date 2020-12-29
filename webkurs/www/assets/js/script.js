//после загрузки страницы
$(document).ready(function(){
	//если нажали на войти то отобразить панель авторизации
	$('#header-account').click(function(){
		$('#account-panel').wrap(
			$('<div>', {
				'id': 'account-panel-background'
			})
		);
		$('#account-panel').removeClass('invisible');
		$(document).mouseup(function(e){
			var container = $("#account-panel-background");
			if (container.has(e.target).length === 0){
				$('#account-panel').unwrap('#account-panel-background');
				$('#account-panel').addClass('invisible');
			}
		});
	});
	//переход к панели регистрации
	$('#account-to-registration').click(function(){
		$('#account-login-panel').addClass('invisible');
		$('#account-registration-panel').removeClass('invisible');
	});
	//переход к панели авторизации
	$('#account-to-login').click(function(){
		$('#account-registration-panel').addClass('invisible');
		$('#account-login-panel').removeClass('invisible');
	});
	//переход к панели изменения инфо об аккаунте
	$('#account-account-is-edit').click(function(){
		$('#account-account-panel').addClass('invisible');
		$('#account-accountedit-panel').removeClass('invisible');
	});
	//переход к панели инфо об аккаунте
	$('#account-account-is-account').click(function(){
		$('#account-account-panel').removeClass('invisible');
		$('#account-accountedit-panel').addClass('invisible');
	});
	//создание ссылки для восстановления пароля
	$('#account-to-restore-password').click(function() {
		$.ajax({
			type: 'POST',
			url: 'assets/php/repassaccount.php',
			data: 'repass_login='+document.getElementById('account-login-text').value,
			success: function(data){
				$('body').append(data);
			}
		});
	});
	//функция переключения с избранных на мои обьявления
	$('#account-to-my-ads').click(function(){
		var ads = '';
		$.ajax({
			type: 'POST',
			url: 'assets/php/getuserestate.php',
			dataType: 'json',
			success: function(data){
				data.forEach(function(item){
					$('#account-ads-box').append(`
						<div class='account-ads-elem'>
							<div><h5>`+item.adress+`</h5></div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-outline-primary" onclick='deleteArticle(`+item.id+`)'>Удалить</button>
								<button type="button" class="btn btn-outline-primary" onclick='generateEditEstatePanel(`+JSON.stringify(item)+`)'>Редактировать</button>
							</div>
						</div>
					`);
				});
			}
		});
		
		ads += '<div class="account-ads-elem"><button type="button" class="btn btn-link" id="account-create-ads">Создать</button></div>';
		$('#account-ads-box').html(ads);
		$('#account-create-ads').click(function(){
			$('#account-panel').unwrap('#account-panel-background');
			$('#account-panel').addClass('invisible');
			var create_elem_panel = '';
			create_elem_panel += `
				<div id="account-panel-create-elem-background">
					<div id="account-panel-create-elem">
						<div id="account-panel-create-elem-main">
							<div class='account-panel-create-elem-header'>
								<h3>Создать объявление<h3>
								<button type="button" class="btn btn-primary" id='account-panel-create-elem-to-photos'>Добавить фото</button>
							</div>
							<form id='account-panel-create-elem-form' class='account-panel-create-elem-form' method='post' enctype="multipart/form-data">
								<input name='is-account-create-ad' type='text' class='invisible'>
								<div class="form-group">
									<label>Адрес</label>
									<input name='adress' type="text" class="form-control">
								</div>
								<div class="form-group">
									<label>Тип</label>
									<select name='type' class="form-control">
										<option value='Квартирa'>
											Квартирa
										</option>
										<option value='Комнатa'>
											Комнатa
										</option>
										<option value='Дом'>
											Дом
										</option>
										<option value='Коммерческая недвижимость'>
											Коммерческая недвижимость
										</option>
									</select>
								</div>
								<div class="form-group">
									<label>Цена</label>
									<input name='price' type="number" class="form-control">
								</div>
								<div class="form-group">
									<label>Площадь</label>
									<input name='square' type="number" class="form-control">
								</div>
								<div class="form-group">
									<label>Инфо</label>
									<textarea name='info' class="form-control"></textarea>
								</div>
								<button type="submit" class="btn btn-primary">Создать</button>
							</form>
						</div>
						<div id="account-panel-create-elem-photos" class='invisible'>
							<div id='account-panel-create-elem-photos-header'>
								<h3>Фото </h3><button type="button" class="btn btn-primary" id='account-panel-create-elem-to-main'>Назад</button>
							</div>
							<input id="account-panel-create-elem-photos-file" form='account-panel-create-elem-form' type="file" multiple="multiple" name="picfile[]" />
							<div id="account-panel-create-elem-photos-container">
								
							</div>
						</div>
					</div>
				</div>
			`;
			$('body').append(create_elem_panel);
			$(document).mouseup(function(e){
				var container = $("#account-panel-create-elem-background");
				if (container.has(e.target).length === 0){
					$('#account-panel-create-elem-background').remove();
				}
			});
			$('#account-panel-create-elem-to-photos').click(function(){
				$('#account-panel-create-elem-main').addClass('invisible');
				$('#account-panel-create-elem-photos').removeClass('invisible');
			});
			$('#account-panel-create-elem-to-main').click(function(){
				$('#account-panel-create-elem-photos').addClass('invisible');
				$('#account-panel-create-elem-main').removeClass('invisible');
			});
			$('#account-panel-create-elem-photos-file').change(async function(e){
				$('#account-panel-create-elem-photos-container').html('');
				if (this.files && this.files[0]){
					i = 0;
					while(this.files[i]){
						var newPhoto = '';
						var base64string = await toBase64(this.files[i]);
						newPhoto += `
							<div class='img-container'>
								<img src="`+base64string+`" />
							</div>
							`;
						$('#account-panel-create-elem-photos-container').append(newPhoto);
						i++;
					}
				}
			});
		});
	});
	//функция переключения с моих на избранные обьявления
	$('#account-to-favorite-ads').click(function(){
		ads = '';
		$.ajax({
			type: 'POST',
			url: 'assets/php/loadfavorite.php',
			data: {'login': userdata_login},
			dataType: 'json',
			success: function(data){
				data.forEach(function(item){
					ads += `
						<div class='account-ads-elem' id='account-ads-elem-`+item.id+`'>
							<div><h5>`+item.adress+`</h5></div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-outline-primary" onclick='generateUserPanel(`+item.login_users+`)'>Показать инфо о владельце</button>
								<button type="button" class="btn btn-outline-primary" onclick='toggleFavorite(`+item.id+`)'>Удалить из избранного</button>
							</div>
						</div>
					`;
				});
				$('#account-ads-box').html(ads);
			}
		});
	});
	//размещение на странице
	generateEstate();
});
//функция преобразования файла в base64
const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});
//функция рендера карточек квартир
function generateEstate(){
	$('#article-container').html('');
	$.ajax({
			type: 'POST',
			url: 'assets/php/selectestate.php',
			dataType: 'json',
			success: function(data){
				data.forEach(function(item){
					generateArticle(item);
				});
				updateFavoriteEstate();
			}
		});
}
//
function generateEstateFilters(isTrue){
	var dataFilters = {};
	$('#filters-form').find ('input, textearea, select').each(function() {
		dataFilters[this.name] = $(this).val();
	});
	$('#article-container').html('');
	$.ajax({
			type: 'POST',
			url: 'assets/php/selectestate.php',
			data:{
				'is-filters': true,
				'data-filters': dataFilters
			},
			dataType: 'json',
			success: function(data){
				data.forEach(function(item){
					generateArticle(item);
				});
				updateFavoriteEstate();
			}
		});
}
//функция генерации карточки квартиры
function generateArticle(realty){
	article = '';
	article += `
		<article>
			<div class='photo-karousel'>
				<div id="carousel-photo-`+realty.id+`" class="carousel slide carousel-fade" data-ride="carousel">
					<div class="carousel-inner" id='carousel-inner-`+realty.id+`'></div>
					<a class="carousel-control-prev" href="#carousel-photo-`+realty.id+`" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carousel-photo-`+realty.id+`" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<div class='realty-info'>
				<div class='realty-info-header'>
					<div>
						<h4>`+realty.price+` ₽</h4>
					</div>
					<div>
						<h4>`+realty.square+` м²</h4>
					</div>
				</div>
				<div class='realty-info-adress'>
					<i>
						`+realty.adress+`
					</i>
				</div>
				<div class='realty-info-content'>
					`+realty.info+`
				</div>
				<div class='realty-info-date'>
					<i>
						`+realty.publication_date+`
					</i>
				</div>
				<div class='realty-info-footer'>`+(((userdata_login == realty.login_users)||(userdata_root == 'admin')) ?`
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-outline-primary" onclick='deleteArticle(`+realty.id+`)'>Удалить</button>
						<button type="button" class="btn btn-outline-primary" onclick='generateEditEstatePanel(`+JSON.stringify(realty)+`)'>Редактировать</button>
					</div>` : ``)+`
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-outline-primary" onclick='generateUserPanel(`+realty.login_users+`)'>Показать инфо о владельце</button>
						`+(userdata_login == '' ? `` : `<button type="button" class="btn btn-outline-primary" onclick='toggleFavorite(`+realty.id+`)' id='realty-info-favorite-`+realty.id+`'>В избранное</button>`)+`
					</div>
				</div>
			</div>
		</article>
	`;
	$('#article-container').append(article);
	generateSlidePhotos(realty.id);
}
//функция генерации слайдов
function generateSlidePhotos(id){
	var result = '';
	$.ajax({
		type: 'POST',
		url: 'assets/php/getestatephotos.php',
		data: {'id': id},
		dataType: 'json',
		success: function(data){
			var isFirst = true;
			data.forEach(function(item){
				if(isFirst == true){
					result += `
						<div class="carousel-item active">
							<img src="`+item.photo_path+`" class="d-block w-100" alt="...">
						</div>
						`;
						isFirst = false;
				}
				else{
					result += `
						<div class="carousel-item">
							<img src="`+item.photo_path+`" class="d-block w-100" alt="...">
						</div>
						`;
				}
			});
			$('#carousel-inner-'+id).html(result);
			return result;
		}
	});
}
//функция генерации карточки пользователя
function generateUserPanel(login){
	$.ajax({
		type: 'POST',
		url: 'assets/php/getlogininfo.php',
		data: {'login': login},
		dataType: 'json',
		success: function(data){
			info = '';
			info = `
				<div id='account-info-panel-background'>
					<div id='account-info-panel'>
						<h2>Информация о владельце<h2>
						<h4>Имя: </h4><h5>`+data.pseudonym+`</h5><br>
						<h4>Почта: </h4><h5>`+data.mail+`</h5><br>
						<h4>Телефон: </h4><h5>`+data.number+`</h5><br>
					</div>
				</div>
			`;
			$('body').append(info);
			$(document).mouseup(function(e){
				var container = $("#account-info-panel-background");
				if (container.has(e.target).length === 0){
					$('#account-info-panel-background').remove();
				}
			});
		}
	});
}
//функция удаления квартиры
function deleteArticle(id){
	$.ajax({
		type: 'POST',
		url: 'assets/php/deleteestate.php',
		data: {'id': id},
		success: function(data){
			$('body').append(data);
			generateEstate();
		}
	});
}
//функция генерации карточки изменения квартиры
function generateEditEstatePanel(realty){
	console.log(realty);
	var edit_elem_panel = '';
	edit_elem_panel += `
		<div id="edit-elem-background">
			<div id="edit-elem">
				<div id="edit-elem-main">
					<div class='edit-elem-header'>
						<h3>Редактировать объявление<h3>
						<button type="button" class="btn btn-primary" id='edit-elem-to-photos'>Добавить фото</button>
					</div>
					<form id='edit-elem-form' class='edit-elem-form' method='post' enctype="multipart/form-data">
						<input name='is-edit-elem' type='text' class='invisible'>
						<input name='delete-photos-array' type='text' class='invisible' id='delete-photos-array' value='[]'>
						<input name='id' type='text' class='invisible' value="`+realty.id+`">
						<div class="form-group">
							<label>Адрес</label>
							<input name='adress' type="text" class="form-control" value="`+realty.adress+`">
						</div>
						<div class="form-group">
							<label>Тип</label>
							<select name='type' class="form-control">
								<option value='Квартирa'`+(realty.type == 'Квартирa' ? ' selected' : '')+`>
									Квартирa
								</option>
								<option value='Комнатa'`+(realty.type == 'Комнатa' ? ' selected' : '')+`>
									Комнатa
								</option>
								<option value='Дом'`+(realty.type == 'Дом' ? ' selected' : '')+`>
									Дом
								</option>
								<option value='Коммерческая недвижимость'`+(realty.type == 'Коммерческая недвижимость' ? ' selected' : '')+`>
									Коммерческая недвижимость
								</option>
							</select>
						</div>
						<div class="form-group">
							<label>Цена</label>
							<input name='price' type="number" class="form-control" value="`+realty.price+`">
						</div>
						<div class="form-group">
							<label>Площадь</label>
							<input name='square' type="number" class="form-control" value="`+realty.square+`">
						</div>
						<div class="form-group">
							<label>Инфо</label>
							<textarea name='info' class="form-control">`+realty.info+`</textarea>
						</div>
						<button type="submit" class="btn btn-primary">Изменить</button>
					</form>
				</div>
				<div id="edit-elem-photos" class='invisible'>
					<div id='edit-elem-photos-header'>
						<h3>Фото </h3><button type="button" class="btn btn-primary" id='edit-elem-to-main'>Назад</button>
					</div>
					<input id="edit-elem-photos-file" form='edit-elem-form' type="file" multiple="multiple" name="picfile[]" />
					<div id="edit-elem-photos-container">
						
					</div>
				</div>
			</div>
		</div>
	`;
	$('body').append(edit_elem_panel);
	generatePhotosEditEstate(realty.id);
	$(document).mouseup(function(e){
		var container = $("#edit-elem-background");
		if (container.has(e.target).length === 0){
			$('#edit-elem-background').remove();
		}
	});
	$('#edit-elem-to-photos').click(function(){
		$('#edit-elem-main').addClass('invisible');
		$('#edit-elem-photos').removeClass('invisible');
	});
	$('#edit-elem-to-main').click(function(){
		$('#edit-elem-photos').addClass('invisible');
		$('#edit-elem-main').removeClass('invisible');
	});
	$('#edit-elem-photos-file').change(async function(e){
		$('.new-photo-estate').detach();
		if (this.files && this.files[0]){
			i = 0;
			while(this.files[i]){
				var newPhoto = '';
				var base64string = await toBase64(this.files[i]);
				newPhoto += `
					<div class='img-container new-photo-estate'>
						<img src="`+base64string+`" />
					</div>
					`;
				$('#edit-elem-photos-container').append(newPhoto);
				i++;
			}
		}
	});
}
//функция генерации карточек загруженных картинок
function generatePhotosEditEstate(id){
	var result = '';
	$.ajax({
		type: 'POST',
		url: 'assets/php/getestatephotos.php',
		data: {'id': id},
		dataType: 'json',
		success: function(data){
			data.forEach(function(item){
				result += `
					<div class='img-container old-photo-estate' id='old-photo-estate-`+item.id+`'>
						<img src="`+item.photo_path+`" />
						<button type="button" class="btn btn-danger" onclick='deletePhotoEstate(`+item.id+`)'>Удалить</button>
					</div>
					`;
			});
			$('#edit-elem-photos-container').html(result);
			return result;
		}
	})
}
//функция, которая заносит в удаляемые фото заданное
function deletePhotoEstate(id){
	$('#old-photo-estate-'+id).detach();
	var arr = JSON.parse($('#delete-photos-array').val());
	arr.push(id);
	$('#delete-photos-array').val(JSON.stringify(arr));
}
//действие по нажатию на кнопку в избранное
function toggleFavorite(id){
	if($('#realty-info-favorite-'+id).html() == 'В избранное'){
		$.ajax({
			type: 'POST',
			url: 'assets/php/addfavorite.php',
			data: {'id': id},
			dataType: 'json'
		});
		$('#realty-info-favorite-'+id).html('В избранном');
		return;
	}
	if($('#realty-info-favorite-'+id).html() == 'В избранном'){
		$.ajax({
			type: 'POST',
			url: 'assets/php/deletefavorite.php',
			data: {'id': id},
			dataType: 'json'
		});
		$('#realty-info-favorite-'+id).html('В избранное');
		$('#account-ads-elem-'+id).remove();
		return;
	}
}
//начальная загрузка избранного
function updateFavoriteEstate(){
	$.ajax({
		type: 'POST',
		url: 'assets/php/loadfavorite.php',
		data: {'login': userdata_login},
		dataType: 'json',
		success: function(data){
			data.forEach(function(item){
				$('#realty-info-favorite-'+item.id).html('В избранном');
			});
		}
	});
}


























