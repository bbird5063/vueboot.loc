<template>
	<div>
		<!-- ./skins/tpl/register/form_modal_register.tpl begin -->
		<div id="login-signup-modal" class="modal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<!--======================================================================-->

				<!-- содержимое модального окна login -->
				<div v-show="$store.state.auth.currModal == 'login-modal-content'" class="modal-content" id="login-modal-content">>
					<div class="modal-header">
						<h5 class="modal-title">Вход в аккаунт!</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">


						<form action="/php_modules/auth/login_controller_ajax.php" method="post" id="Login-Form" role="form_ajax" for="login">
							<!-- для проверки: сюда будет помещен ответ от хоста -->
							<div id="result_form"></div>
							<!--div id="err"></div-->

							<div class="form-group">
								<div class="input-group mb-3">
									<span class="input-group-text" id="basic-addon1">@</span>
									<input name="login" id="login-login" type="text" class="form-control" placeholder="Введите логин" required data-parsley-type="name" value="" />
								</div>
								<div class="input-group mb-3">
									<span class="input-group-text">$</span>
									<input name="password" id="login-password" type="password" class="form-control" placeholder="Введите пароль" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup" autocomplete="off" />
									<span class="input-group-text">0</span>
								</div>
							</div>
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								LOGIN
							</button>
						</form>
					</div>
					<div class="modal-footer">
						<p>
							<a id="FPModal" href="#" for="nextPage">Забыли пароль?</a>
							|
							<a id="signupModal" href="#" for="nextPage">Регистрация</a>
						</p>
					</div>
				</div>
				<!-- содержимое модального окна login END -->

				<!--======================================================================-->

				<!-- содержимое модального окна signup  for="signup"-->
				<div v-show="$store.state.auth.currModal == 'signup-modal-content'" class="modal-content" id="signup-modal-content">
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
				<div v-show="$store.state.auth.currModal == 'forgot-password-modal-content'
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
				<div v-show="$store.state.auth.currModal == 'code-modal-content'" class="modal-content" id="code-modal-content">
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
				<div v-show="$store.state.auth.currModal == 'password-modal-content'" class="modal-content" id="password-modal-content">
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

				<div v-show="$store.state.auth.currModal == 'user-modal-content'" class="modal-content" id="user-modal-content">
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
				<div v-show="$store.state.auth.currModal == 'exit-modal-content'" class="modal-content" id="exit-modal-content">
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
export default {
	methods: {
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
