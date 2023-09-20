<template>
	<div>
		<!-- ./skins/tpl/register/form_modal_register.tpl begin -->
		<div v-if="$store.state.auth.authShow" id="login-signup-modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<!--======================================================================-->

				<!-- содержимое модального окна login -->
				<!-- v-if="$store.state.auth.currModal == 'login-modal-content'" -->
				<div v-if="$store.state.auth.currModal == 'login-modal-content'" class="modal-content" id="login-modal-content">
					<div class="modal-header">
						<h4 class="modal-title">
							<span class="fa fa-lock"></span><b> Вход в аккаунт!</b>
						</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
						</button>

					</div>

					<div class=" modal-body">
						<div id="Login-Form-Error" for="error">
							<div v-if="errHtml" id="reg_error" style="text-align:center; vertical-align:middle;" class="alert alert-warning">
								{{ this.errHtml }}
							</div>
						</div>
						<!-- по id='err' будет удаляться при переходе на др.форму -->

						<form @submit.prevent="onSubmit" action="/php_modules/auth/login_controller_ajax.php" method="post" id="Login-Form" role="form_ajax" for="login">
							<!-- для проверки: сюда будет помещен ответ от хоста -->
							<div id="result_form"></div>
							<div v-if="infoHtml" id="err">{{ this.infoHtml }}</div>

							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="fa fa-user"></span>
									</div>
									<input name="login" id="login-login" type="text" class="form-control input-lg" placeholder="Введите логин" required data-parsley-type="name" value="" />
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="fa fa-lock"></span>
									</div>

									<input name="password" id="login-password" type="password" class="form-control input-lg" placeholder="Введите пароль" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup" autocomplete="off" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="fa fa-eye" for="password" id="eye_login-password"></span>
									</div>
								</div>
							</div>

							<div class="checkbox">
								<label><input name="remember" type="checkbox" value="1" />Запомнить
									меня</label>
							</div>
							<!--br><input for="Login-Form" type="text" name="new_num" value="0"-->
							<!--input for="Login-Form" type="hidden" name="new_num" value="0"-->
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								LOGIN
							</button>
						</form>
					</div>

					<div class="modal-footer">
						<p>
							<a id="FPModal" href="javascript:void(0)" for="nextPage">Забыли пароль?</a>
							|
							<a id="signupModal" href="javascript:void(0)" for="nextPage">Регистрация</a>
						</p>
					</div>
				</div>
				<!-- содержимое модального окна login END -->

				<!--======================================================================-->

				<!-- содержимое модального окна signup  for="signup"-->
				<div v-if="$store.state.auth.currModal == 'signup-modal-content'" class="modal-content" id="signup-modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

						<h4 class="modal-title">
							<span class="glyphicon glyphicon-lock"></span><b> Регистрация</b>
						</h4>
					</div>

					<div class="modal-body">
						<div id="Signin-Form-Error" for="error"></div>
						<form action="/php_modules/auth/registration_controller_ajax.php" method="post" id="Signin-Form" role="form_ajax" for="signup">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-user"></span>
									</div>
									<input name="login" id="signup-login" type="text" class="form-control input-lg" placeholder="Введите логин" required data-parsley-type="name" value="" />
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-envelope"></span>
									</div>

									<input name="email" id="signup-email" type="email" class="form-control input-lg" placeholder="Введите Email" required data-parsley-type="email" value="" />
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-lock"></span>
									</div>

									<input name="password" id="signup-passwd" type="password" class="form-control input-lg" placeholder="Введите пароль" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup" autocomplete="off" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="fa fa-eye" for="password" id="eye_signup-passwd"></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-lock"></span>
									</div>

									<input name="password2" id="signup-confirm-passwd" type="password" class="form-control input-lg" placeholder="Повторите пароль" required data-parsley-equalto="#signup-passwd" data-parsley-trigger="keyup" autocomplete="off" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="fa fa-eye" for="password" id="eye_signup-confirm-passwd"></span>
									</div>
								</div>
							</div>
							<!--br><input type="text" name="new_num" value="1"-->
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								Создать аккаунт!
							</button>
						</form>
					</div>

					<div class="modal-footer">
						<p>
							Имеете аккаунт?
							<a id="loginModal" href="javascript:void(0)" for="nextPage">Войти в аккаунт</a>
						</p>
					</div>
				</div>
				<!-- содержимое модального окна signup END -->

				<!--======================================================================-->

				<!-- содержимое модального окна forgot password -->
				<div v-if="$store.state.auth.currModal == 'forgot-password-modal-content'
					" class="modal-content" id="forgot-password-modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">
							<span class="glyphicon glyphicon-lock"></span><b> Установка доступа!</b>
						</h4>
					</div>

					<div class="modal-body">
						<div id="Forgot-Password-Form-Error" for="error"></div>
						<form action="/php_modules/auth/restoration_controller_ajax.php" method="post" id="Forgot-Password-Form" role="form_ajax" for="forgot-password">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-user"></span>
									</div>
									<input name="login" id="forgot-login" type="text" class="form-control input-lg" placeholder="Введите логин" required data-parsley-type="name" value="" />
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-envelope"></span>
									</div>
									<input name="email" id="forgot-email" type="email" class="form-control input-lg" placeholder="Введите Email" required data-parsley-type="email" value="" />
								</div>
							</div>
							<!--br><input type="text" name="new_num" value="2"-->
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								<span class="glyphicon glyphicon-send"></span> Отправить
							</button>
						</form>
					</div>

					<div class="modal-footer">
						<p>
							Вспомнили пароль?
							<a id="loginModal1" href="javascript:void(0)" for="nextPage">Войти в аккаунт</a>
						</p>
						<p>
							Ваши личные данные:
							<a id="userModal" href="javascript:void(0)" for="nextPage">ваш профиль</a>
						</p>
					</div>
				</div>
				<!-- содержимое модального окна forgot password END -->

				<!--======================================================================-->

				<!-- содержимое модального окна code -->
				<div v-if="$store.state.auth.currModal == 'code-modal-content'" class="modal-content" id="code-modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

						<h4 class="modal-title">
							<span class="glyphicon glyphicon-lock"></span><b> Восстановление доступа</b>
						</h4>
					</div>

					<div class="modal-body">
						<div id="Code-Form-Error" for="error"></div>
						<form action="/php_modules/auth/activate_controller_ajax.php" method="post" id="Code-Form" role="form_ajax" for="code">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-pencil"></span>
									</div>
									<input name="code" type="text" class="form-control input-lg" placeholder="Введите код" required data-parsley-type="name" value="" autocomplete="off" />
								</div>
							</div>

							<div class="checkbox">
								<label><input name="remember" type="checkbox" value="1" />Запомнить
									меня</label>
							</div>
							<!--br><input type="text" name="new_num" value="1"-->
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								Восстановить доступ
							</button>
						</form>
					</div>

					<div class="modal-footer">
						<p>
							<a id="FPModal1" href="javascript:void(0)" for="nextPage">Забыли пароль?</a>
							|
							<a id="signupModal1" href="javascript:void(0)" for="nextPage">Регистрация</a>
						</p>
					</div>
				</div>
				<!-- содержимое модального окна code END -->

				<!--======================================================================-->

				<!-- содержимое модального окна password -->
				<div v-if="$store.state.auth.currModal == 'password-modal-content'" class="modal-content" id="password-modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

						<h4 class="modal-title">
							<span class="glyphicon glyphicon-lock"></span><b> Установка пароля</b>
						</h4>
					</div>

					<div class="modal-body">
						<div id="Signin-Form-Error" for="error"></div>
						<form action="/php_modules/auth/new_pw_controller_ajax.php" method="post" id="Signin-Form" role="form_ajax" for="password">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-user"></span>
									</div>
									<input name="login" id="password-login" type="text" class="form-control input-lg" placeholder="Введите логин" required data-parsley-type="name" value="" readonly />
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-envelope"></span>
									</div>

									<input name="email" id="password-email" type="email" class="form-control input-lg" placeholder="Введите Email" required data-parsley-type="email" value="" readonly />
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-lock"></span>
									</div>

									<input name="password" id="passwd-1" type="password" class="form-control input-lg" placeholder="Введите пароль" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup" autocomplete="off" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="fa fa-eye" for="password" id="eye_passwd-1"></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-lock"></span>
									</div>

									<input name="password2" id="confirm-passwd-2" type="password" class="form-control input-lg" placeholder="Повторите пароль" required data-parsley-equalto="#passwd-1" data-parsley-trigger="keyup" autocomplete="off" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="fa fa-eye" for="password" id="eye_confirm-passwd-2"></span>
									</div>
								</div>
							</div>
							<!--br><input type="text" name="new_num" value="2"-->
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								Установить
							</button>
						</form>
					</div>

					<div class="modal-footer">
						<p>
							Имеете аккаунт?
							<a id="loginModal" href="javascript:void(0)" for="nextPage">Войти в аккаунт</a>
						</p>
					</div>
				</div>
				<!-- содержимое модального окна password END -->

				<!--======================================================================-->

				<!--======================================================================-->

				<!-- содержимое модального окна user -->

				<div v-if="$store.state.auth.currModal == 'user-modal-content'" class="modal-content" id="user-modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

						<h4 class="modal-title">
							<span class="glyphicon glyphicon-lock"></span><b> Ваш профиль</b>
						</h4>
					</div>

					<div class="modal-body">
						<div id="User-Form-Error" for="error"></div>
						<form action="/php_modules/auth/user_controller_ajax.php" method="post" id="User-Form" role="form_ajax" for="user">
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="fa fa-user-circle"></span>
									</div>
									<input readonly name="login" id="user-login" type="text" class="form-control input-lg" placeholder="Введите логин" required data-parsley-type="name" value="" />
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-envelope"></span>
									</div>

									<input readonly name="email" id="user-email" type="email" class="form-control input-lg" placeholder="Введите Email" required data-parsley-type="email" value="" />
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-user"></span>
									</div>

									<input readonly name="name_last" id="user_name_last" type="text" class="form-control input-lg" placeholder="Введите фамилию" required data-parsley-type="name" value="" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="glyphicon glyphicon-pencil" for="text" id="edit_user_name_last"></span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-user"></span>
									</div>

									<input readonly name="name_first" id="user_name_first" type="text" class="form-control input-lg" placeholder="Введите имя" required data-parsley-type="name" value="" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="glyphicon glyphicon-pencil" for="text" id="edit_user_name_first"></span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-user"></span>
									</div>

									<input readonly name="name_patr" id="user_name_patr" type="text" class="form-control input-lg" placeholder="Введите отчество" required data-parsley-type="name" value="" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="glyphicon glyphicon-pencil" for="text" id="edit_user_name_patr"></span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-earphone"></span>
									</div>

									<input readonly name="phone_1" id="user_phone_1" type="text" class="form-control input-lg" placeholder="Введите phone_1" required data-parsley-type="name" value="" />

									<div class="input-group-addon">
										<span style="cursor: pointer" class="glyphicon glyphicon-pencil" for="text" id="edit_user_phone_1"></span>
									</div>
								</div>
							</div>
							<!--br><input type="text" name="new_num" value="3"-->
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								Сохранить данные
							</button>
						</form>
					</div>

					<div class="modal-footer">
						<p>
							Имеете аккаунт?
							<a id="FPModal2" href="javascript:void(0)" for="nextPage">Изменить пароль?</a>
						</p>
					</div>
				</div>
				<!-- содержимое модального окна user END -->

				<!--======================================================================-->

				<!-- содержимое модального окна exit -->
				<div v-if="$store.state.auth.currModal == 'exit-modal-content'" class="modal-content" id="exit-modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

						<h4 class="modal-title">
							<span class="glyphicon glyphicon-lock"></span><b> Выход</b>
						</h4>
					</div>

					<div class="modal-body">
						<div id="Exit-Form-Error" for="error"></div>
						<form action="/php_modules/auth/exit_controller_ajax.php" method="post" id="Exit-Form" role="form_ajax" for="exit">
							<div class="form-group">
								<div class="input-group"></div>
							</div>

							<!--br><input type="text" name="new_num" value="0"><br-->
							<div class="modal-footer">
								<button name="cancel" value="1" type="button" class="btn btn-success">
									Отмена
								</button>

								<button name="ok" value="1" type="submit" class="btn btn-success">
									&nbsp;Выйти&nbsp;&nbsp;
								</button>
								<!--p>
          	<a id="FPModal1" href="javascript:void(0)" for="nextPage">Забыли пароль?</a> | 
          	<a id="signupModal1" href="javascript:void(0)" for="nextPage">Регистрация</a>
          	</p-->
							</div>
						</form>
					</div>
				</div>
				<!-- содержимое модального окна exit END -->

				<!--======================================================================-->
			</div>
		</div>
		<!-- ./skins/tpl/register/form_modal_register.tpl begin -->
	</div>
</template>

<script>
import axios from 'axios';
export default {
	data() {
		return {
			isLoading: false,
			divErrId: '',
			errHtml: '',
			infoHtml: '',
		}
	},
	methods: {
		onSubmit(formElem) {
			const url = formElem.srcElement.attributes.action.nodeValue; // /php_modules/auth/login_controller_ajax.php

			// ИЛИ const url = formElem.target.action; // http://192.168.0.100:8080/php_modules/auth/login_controller_ajax.php

			const objData = {}; // можно удалить
			let post = '';
			for (let key = 0; key < formElem.target.length; key++) {
				if (formElem.target[key].type !== 'submit' && formElem.target[key].type !== 'checkbox') {
					objData[formElem.target[key].name] = formElem.target[key].value; // можно удалить
					post += '&' + formElem.target[key].name + '=' + formElem.target[key].value;
				}
				if (formElem.target[key].type == 'checkbox') {
					objData[formElem.target[key].name] = formElem.target[key].checked; // можно удалить
					post += '&' + formElem.target[key].name + '=' + formElem.target[key].checked;
				}
			}
			post = post.slice(1); // удаляем '&' в началеthis.$store.state.auth.authMode
			post += post ? '&' : '';
			post += 'num=' + this.$store.state.auth.authMode;
			const jsonData = JSON.stringify(objData); // можно удалить // {"login":"bbird5063@gmail.com","password":"Spab1433","remember":"1"}
			console.log('url: ' + url + '  |  post: ' + post);
			console.log(this.$store.state.auth.isLocalhost);
			console.log('=================================');
			console.log(formElem);
			console.log(formElem.target.id); // 'Login-Form'
			console.log(formElem.target.role); // 'form_ajax'
			console.log('=================================');
			if (!this.$store.state.auth.isLocalhost) {
				this.authAxios(url, post, formElem.target.id);
			}

		},

		async authAxios(url, post, formId) {
			// alert('url: ' + url + '  |  post: ' + post);

			try {
				this.isLoading = true;
				const response = await axios.post(url, post);
				alert(response.data.test);
				console.log(response.data);
				let
					divRegInfoStart = '<div id="reg_info" style="text-align:center; vertical-align:middle;" class="alert alert-warning">',
					divRegInfoPageStart = '<div id="reg_info_page" style="text-align:left; vertical-align:middle;" class="">',
					divRegInfoEnd = '</div>',
					errHtml = '',
					divErrId = '#' + formId + '-Error';

				response.data.num ? this.$store.commit('auth/setAuthMode', response.data.num) : '';
				errHtml += response.data.reg_error ? response.data.reg_error : '';
				errHtml += response.data.reg_info ? response.data.reg_info : '';
				// errHtml += response.data.reg_info_page ? response.data.reg_info_page : '';
				this.errHtml = errHtml ? errHtml : '';
				this.infoHtml = response.data.reg_info_page ? response.data.reg_info_page : '';
				!errHtml && response.data.user_data ? this.$store.commit('auth/setDataUser', response.data.user_data) : '';

			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			} finally {
				this.isLoading = false;
			}

		},


		fadeOut(el) {
			var opacity = 1;

			var timer = setInterval(function () {
				if (opacity <= 0.1) {
					clearInterval(timer);
					document.querySelector(el).style.display = 'none';
				}

				document.querySelector(el).style.opacity = opacity;

				opacity -= opacity * 0.1;
			}, 10);
		},

		fadeIn(el) {
			var opacity = 0.01;

			document.querySelector(el).style.display = 'block';

			var timer = setInterval(function () {
				if (opacity >= 1) {
					clearInterval(timer);
				}

				document.querySelector(el).style.opacity = opacity;

				opacity += opacity * 0.1;
			}, 10);
		},
	},
	mounted() {
		// fadeIn('#' + $store.state.auth.currModal);
	},
};
</script>

<style scoped>
button.close
{
	border-width: 0;
	background-color: white;
}

/* .modal-content {
  display: none;
} */
/*
#login-modal-content,
#signup-modal-content,
#forgot-password-modal-content,
#code-modal-content,
#password-modal-content,
#user-modal-content,
#exit-modal-content {
  display: none;
}
*/
</style>
