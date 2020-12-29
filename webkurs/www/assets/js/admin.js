//функция удаления пользователя
function deleteUser(id){
	$.ajax({
		type: 'POST',
		url: 'assets/php/deleteuser.php',
		data: {'id': id},
		success: function(data){
			$('body').append(data);
		}
	});
}
//функция редактирования пользователя
function editUser(id){
	all_users.forEach(function(elem){
		if(elem.id == id){
			$('body').append(`
				<div id='admin-account-edit-background'>
					<div id='admin-account-edit'>
						<h2>Аккаунт `+elem.login+`</h2>
						<form onsubmit="editUserAjax();return false" id='admin-account-edit-form'>
						<input class="invisible" type='text' name='login' value='`+elem.login+`'></input>
							<div class='form-group'>
								Псевдоним
								<input class="form-control" type='text' name='pseudonym' value='`+elem.pseudonym+`'></input>
							</div>
							<div class='form-group'>
								E-Mail
								<input class="form-control" type='text' name='mail' value='`+elem.mail+`'></input>
							</div>
							<div class='form-group'>
								Телефон
								<input class="form-control" type='text' name='number' value='`+elem.number+`'></input>
							</div>
							<div class='form-group'>
								Права
								<select name='root' class="form-control">
									<option value='user'`+(elem.root == 'user' ? ' selected' : '')+`>
										User
									</option>
									<option value='admin'`+(elem.root == 'admin' ? ' selected' : '')+`>
										Admin
									</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			`);
			$(document).mouseup(function(e){
				var container = $("#admin-account-edit-background");
				if (container.has(e.target).length === 0){
					$('#admin-account-edit-background').detach();
				}
			});
			return;
		}
	});
}
//функция отправки запроса об изменении инфо о аккаунте
function editUserAjax(){
	var dataAcc = {};
	$('#admin-account-edit-form').find ('input, textearea, select').each(function() {
		dataAcc[this.name] = $(this).val();
	});
	$.ajax({
		type: 'POST',
		url: 'assets/php/admineditaccount.php',
		data:{
			'data-acc': dataAcc
		},
		success: function(data){
			$('body').append(data);
		}
	});
}






























