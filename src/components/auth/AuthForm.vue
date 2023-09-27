<template>
	<!-- Modal v-if="$store.state.auth.authShow" -->
	<div id="login-signup-modal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">

			<!-- START LOGIN -->
			<!-- <div v-show="$store.state.auth.currModal == 'login-modal-content'" id="login-modal-content" class="modal-content"> -->
			<div id="login-modal-content" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Вход в аккаунт</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="errHtml" id="Login-Form_error" style="text-align:center; vertical-align:middle;" class="alert alert-warning">
							{{ errHtml }}
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_login.php" method="post" id="Login-Form" role="login-modal-content">
						<div v-if="infoHtml" id="Login-Form_info">{{ infoHtml }}</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input v-focus id="login-login" name="form[login]" type="text" class="form-control" aria-label="Username" aria-describedby="login-login" placeholder="Введите логин" value="">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-lock"></i></span>
							<input name="form[password]" type="password" class="form-control input-lg" placeholder="Введите пароль" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup" autocomplete="off" />
							<span class="input-group-text"><i class="fa fa-eye"></i></span>
						</div>
						<div class="checkbox">
							<input name="form[remember]" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" />
							<label class="form-check-label" for="flexCheckDefault">Запомнить меня</label>
						</div>
						<div class="d-grid gap-2">
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								Вход
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<p>
						<a id="FPModal" @click.prevent="fadeOutIn('login-modal-content', 'forgot-password-modal-content')" href="#">Забыли пароль?</a>
						|
						<a id="signupModal" @click.prevent="fadeOutIn('login-modal-content', 'signup-modal-content')" href="#">Регистрация</a>
					</p>
				</div>
			</div>
			<!-- END LOGIN -->

			<!-- START SIGNUP -->
			<!-- <div v-if="$store.state.auth.currModal == 'signup-modal-content'" id="signup-modal-content" class="modal-content"> -->
			<div id="signup-modal-content" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Регистрация</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="errHtml" id="Signin-Form_error" style="text-align:center; vertical-align:middle;" class="alert alert-warning">
							{{ errHtml }}
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_registration.php" method="post" id="Signin-Form" role="signup-modal-content">
						<div v-if="infoHtml" id="Signin-Form_info">{{ infoHtml }}</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input v-focus id="signin-login" name="form[login]" type="text" class="form-control" aria-label="Username" aria-describedby="login-login" placeholder="Введите логин" value="">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-envelope"></i></span>
							<input name="form[email]" type="text" class="form-control" aria-label="Email" aria-describedby="login-login" placeholder="Введите Email" required data-parsley-type="email" value="">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-lock"></i></span>
							<input name="form[password]" type="password" class="form-control input-lg" placeholder="Введите пароль" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup" autocomplete="off" />
							<span class="input-group-text"><i class="fa fa-eye"></i></span>
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-lock"></i></span>
							<input name="form[password2]" type="password" class="form-control input-lg" placeholder="Повторите пароль" required data-parsley-length="[6, 10]" data-parsley-trigger="keyup" autocomplete="off" />
							<span class="input-group-text"><i class="fa fa-eye"></i></span>
						</div>
						<div class="d-grid gap-2">
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								Создать аккаунт!
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<p>
						Имеете аккаунт?
						<a id="signupModal" @click.prevent="fadeOutIn('signup-modal-content', 'login-modal-content')" href="#">
							Войти в аккаунт</a>
					</p>
				</div>
			</div>
			<!-- END SIGNUP -->

			<!-- START FORGOT PASSWORD -->
			<!-- <div v-show="$store.state.auth.currModal == 'forgot-password-modal-content'" id="forgot-password-modal-content" class="modal-content"> -->
			<div id="forgot-password-modal-content" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Установка доступа</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="errHtml" id="Forgot-Password-Form_error" style="text-align:center; vertical-align:middle;" class="alert alert-warning">
							{{ errHtml }}
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_restoration.php" id="Forgot-Password-Form" method="post" role="forgot-password-modal-content">
						<div v-if="infoHtml" id="Forgot-Password-Form_info">{{ infoHtml }}</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input v-focus id="forgot-login" name="form[login]" type="text" class="form-control" aria-label="Username" aria-describedby="login-login" placeholder="Введите логин" value="">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-envelope"></i></span>
							<input name="form[email]" type="text" class="form-control" aria-label="Email" aria-describedby="login-login" placeholder="Введите Email" required data-parsley-type="email" value="">
						</div>
						<div class="d-grid gap-2">
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								Отправить
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<p v-if="$store.state.auth.authMode <= 2">
						Вспомнили пароль?
						<a id="signupModal" @click.prevent="fadeOutIn('forgot-password-modal-content', 'login-modal-content')" href="#">
							Войти в аккаунт</a>
					</p>
					<p v-if="$store.state.auth.authMode == 3">
						Ваши личные данные:
						<a id="userModal" @click.prevent="fadeOutIn('forgot-password-modal-content', 'user-modal-content')" href="#" for="nextPage">ваш профиль</a>
					</p>
				</div>
			</div>
			<!-- END FORGOT PASSWORD -->

			<!-- START CODE -->
			<!-- <div v-show="$store.state.auth.currModal == 'code-modal-content'" class="modal-content" id="code-modal-content"> -->
			<div class="modal-content" id="code-modal-content">

				<div class="modal-header">
					<h5 class="modal-title">Восстановление доступа</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="errHtml" id="Code-Form_error" style="text-align:center; vertical-align:middle;" class="alert alert-warning">
							{{ errHtml }}
						</div>
					</div>

					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_activate.php" id="Code-Form" method="post" role="code-modal-content">
						<div v-if="infoHtml" id="Code-Form_info">{{ infoHtml }}</div>

						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-pencil"></i></span>
							<input v-focus :value="$route.params.id == 0 ? '' : $route.params.id" @input="id = $event.target.value" id="code" name="form[code]" type="text" class="form-control" aria-label="Code" aria-describedby="code" placeholder="Введите код" value="{{ isset()&&$route.params.id.length>1?$route.params.id:'' }}">
							<input v-focus :value="$route.params.id == 0 ? '' : $route.params.id" @input="id = $event.target.value" id="code" name="form[code]" type="text" class="form-control" aria-label="Code" aria-describedby="code" placeholder="Введите код" value="{{ isset($route.params.id) && $route.params.id.length>1 ? $route.params.id : '' }}">
						</div>

						<div class="d-grid gap-2">
							<div class="d-grid gap-2">
								<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
									Отправить
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
				</div>
			</div>
			<!-- END CODE -->

			<!-- START USER -->
			<!-- <div v-show="$store.state.auth.currModal == 'user-modal-content'" id="user-modal-content" class="modal-content"> -->
			<div id="user-modal-content" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ваш профиль</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="errHtml" id="Signin-Form_error" style="text-align:center; vertical-align:middle;" class="alert alert-warning">
							{{ errHtml }}
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_registration.php" method="post" id="Signin-Form" role="signup-modal-content">
						<div v-if="infoHtml" id="Signin-Form_info">{{ infoHtml }}</div>

						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input v-focus readonly id="signin-login" name="form[login]" type="text" class="form-control" aria-label="Username" aria-describedby="login-login" placeholder="Введите логин" value="">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-envelope"></i></span>
							<input name="form[email]" type="text" class="form-control" aria-label="Email" aria-describedby="login-login" placeholder="Введите Email" required data-parsley-type="email" value="">
						</div>

						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input v-focus readonly id="signin-login" name="form[name_last]" type="text" class="form-control" aria-label="Username" aria-describedby="login-login" placeholder="Введите логин" value="">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input v-focus readonly id="signin-login" name="form[name_first]" type="text" class="form-control" aria-label="Username" aria-describedby="login-login" placeholder="Введите логин" value="">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input v-focus readonly id="signin-login" name="form[name_patr]" type="text" class="form-control" aria-label="Username" aria-describedby="login-login" placeholder="Введите логин" value="">
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
							<input v-focus readonly id="signin-login" name="form[phone_1]" type="text" class="form-control" aria-label="Username" aria-describedby="login-login" placeholder="Введите логин" value="">
						</div>

						<div class="d-grid gap-2">
							<button name="ok" value="1" type="submit" class="btn btn-success btn-block btn-lg">
								Изменить пароль!
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<p>
						<a id="loginModal" @click.prevent="fadeOutIn('user-modal-content', 'forgot-password-modal-content')" href="#" for="nextPage">Изменить пароль</a>
					</p>
				</div>
			</div>
			<!-- END USER -->

			<!-- START EXIT -->
			<!-- <div v-show="$store.state.auth.currModal == 'exit-modal-content'" class="modal-content" id="exit-modal-content"> -->
			<div id="exit-modal-content" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Выход</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="errHtml" id="Exit-Form_error" style="text-align:center; vertical-align:middle;" class="alert alert-warning">
							{{ errHtml }}
						</div>
					</div>

					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_exit.php" id="Exit-Form" method="post" role="exit-modal-content">
						<div v-if="infoHtml" id="Exit-Form_info">{{ infoHtml }}</div>
						<div class="input-group mb-3">
						</div>
						<div class="d-grid gap-2">
							<button name="ok" value="1" type="submit" class="btn btn-success">
								Выйти
							</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
				</div>
			</div>
			<!-- END EXIT -->

		</div>
	</div>
</template>

<script>
import axios from 'axios';
export default {
	props: {
		nameModal: {
			type: String,
			required: true,
		},
	},

	data() {
		return {
			isLoading: false,
			divErrId: '',
			errHtml: '',
			infoHtml: '',
			errHtmlIn: '',
			infoHtmlIn: '',
			id: '',
		}
	},

	watch: {
		nameModal(newNameModal) {
			this.fadeIn('#' + newNameModal);
			// $('#' + newNameModal).fadeIn('fast');
		}
	},

	methods: {

		onSubmit(formElem) {
			const url = formElem.srcElement.attributes.action.nodeValue; // /php_modules/auth/controller_login.php

			// ИЛИ const url = formElem.target.action; // http://192.168.0.100:8080/php_modules/auth/controller_login.php

			console.log('==onSubmit(formElem)===========================');
			console.log(formElem.srcElement.attributes.action.nodeValue);
			console.log(formElem.target.length);

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
			post = post ? post.slice(1) : ''; // удаляем '&' в началеthis.$store.state.auth.authMode(при exit - post пустой)
			post += post ? '&' : '';
			post += 'new_num=' + this.$store.state.auth.authMode;
			// const jsonData = JSON.stringify(objData); // можно удалить // {"login":"bbird5063@gmail.com","password":"Spab1433","remember":"1"}
			console.log('url: ' + url + '  |  post: ' + post);
			console.log(this.$store.state.auth.isLocalhost);
			console.log(this.$store.state.auth.authMode);
			console.log('=================================');
			console.log(formElem);
			console.log(formElem.target.id); // Login-Form
			// console.log(formElem.target.role); // form_ajax
			// console.log(formElem.target.for); // undefined нестандартный аргумент
			console.log('=================================');
			if (!this.$store.state.auth.isLocalhost) {
				this.authAxios(url, post, formElem.target.id);
			}

		},

		async authAxios(url, post, formId) {
			try {
				this.isLoading = true;
				const response = await axios.post(url, post);
				// alert(response.data.test);
				console.log(response.data);
				let
					divRegInfoStart = '<div id="reg_info" style="text-align:center; vertical-align:middle;" class="alert alert-warning">',
					divRegInfoPageStart = '<div id="reg_info_page" style="text-align:left; vertical-align:middle;" class="">',
					divRegInfoEnd = '</div>',
					errHtml = '',
					infoHtml = '',
					divErrId = '#' + formId + '-Error',
					divInfoId = '#' + formId + '_info';



				// contentOut = formElem.target.for + '-modal-content'; // не будет работать(for)

				console.log('-----------------------');
				console.log(divRegInfoStart);

				errHtml += response.data.reg_error ? response.data.reg_error : '';
				errHtml += response.data.reg_info ? response.data.reg_info : '';
				// errHtml += response.data.reg_info_page ? response.data.reg_info_page : '';
				this.errHtml = errHtml ? errHtml : '';
				this.infoHtml = response.data.reg_info_page ? response.data.reg_info_page : '';
				// !errHtml && response.data.user_data ? this.$store.commit('auth/setDataUser', response.data.user_data) : '';
				console.log('-----------------------');
				console.log(errHtml);
				console.log('-----------------------');
				console.log(response.data.new_num);
				console.log('-----------------------');
				console.table(response.data.user_data);

				if (!errHtml) {
					response.data.new_num ? this.$store.commit('auth/setAuthMode', response.data.new_num) : '';
					// response.data.user_data ? this.$store.commit('auth/setDataUser', response.data.user_data) : '';data.contentIn

					this.$store.commit('auth/setDataUser', response.data.user_data ? response.data.user_data : '');

					if (response.data.url_act) {
						console.log('--url_act---------------------');
						console.log(response.data.url_act);
					}

					if (response.data.contentIn) {
						response.data.contentIn = response.data.contentIn.slice(1);
						this.fadeOutIn(this.$store.state.auth.currModal, response.data.contentIn);
						// this.fadeOut('#' + this.$store.state.auth.currModal);
						// this.fadeIn(response.data.contentIn);
						// this.$store.commit('auth/setCurrModal', response.data.contentIn);
						let divErr = document.querySelector('#' + response.data.contentIn + '_error');
						divErr.innerHTML = response.data.info_in;
						let divInfo = document.querySelector('#' + response.data.contentIn + '_info');
						divErr.divInfo = response.data.info_page_in;
					}
					else if (this.$store.state.auth.currModal == 'exit-modal-content') {
						this.fadeOutIn(this.$store.state.auth.currModal);
					}
					else {
						this.fadeOutIn(this.$store.state.auth.currModal);
					}
					// this.$store.commit('auth/setCurrModal', response.data.contentIn ? response.data.contentIn : '');
				}
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
			return true;
		},

		fadeIn(el) {
			var opacity = 0.01;

			console.log('== document.querySelector(el).style.display ==');
			console.log('el = ' + el);
			document.querySelector(el).style.display = 'block';

			var timer = setInterval(function () {
				if (opacity >= 1) {
					clearInterval(timer);
				}

				document.querySelector(el).style.opacity = opacity;

				opacity += opacity * 0.1;
			}, 10);
		},


		async fade__OutIn(elOut, elIn = '') {
			try {
				const response = await this.fadeOut('#' + elOut);
				if (response) {
					this.fadeIn('#' + elIn);
					this.$store.commit('auth/setCurrModal', elIn ? elIn : '');
					!elIn ? document.querySelector(".btn-close").dispatchEvent(new Event("click")) : false;
				}
			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			}
		},


		fade_OutIn(elOut, elIn = '') {
			console.log('== fadeOutIn ===========');
			console.log('elOut = ' + elOut + ' | elIn = ' + elIn);
			elOut ? this.fadeOut('#' + elOut) : false;
			this.fadeIn('#' + elIn);
			this.$store.commit('auth/setCurrModal', elIn ? elIn : '');
			!elIn ? document.querySelector(".btn-close").dispatchEvent(new Event("click")) : false;
		},
		fadeOutIn(elOut, elIn = '') {

			console.log('== fadeOutIn ===========');
			console.log('elOut = ' + elOut + ' | elIn = ' + elIn);

			elOut ? this.fadeOut('#' + elOut) : false;
			this.fadeIn('#' + elIn);
			/*
			$(elOut).fadeOut('fast', function () {
				$(elIn).fadeIn('fast');
			});
			
			$('#' + elOut).fadeOut('fast');
			$('#' + elIn).fadeIn('fast');
			*/
			this.$store.commit('auth/setCurrModal', elIn ? elIn : '');
			!elIn ? document.querySelector(".btn-close").dispatchEvent(new Event("click")) : false;
		},


	},

	mounted() {
		// alert(this.nameModal);
		// alert('Auth = ' + this.$route.params.id);
		// fadeIn('#' + $store.state.auth.currModal);
		// alert('src\components\auth\AuthForm.vue  ' + this.$route.params.id);
	},
	created() {
		// alert('src\components\auth\AuthForm.vue  ' + this.$route.params.id);
	},
};
</script>

<style scoped>
.fa
{
	cursor: pointer;
}

/* button.close
{
	border-width: 0;
	background-color: white;
} */

/* .modal-content {
  display: none;
} */
/*
#login-modal-content,
*/
#login-modal-content,
#signup-modal-content,
#forgot-password-modal-content,
#code-modal-content,
#password-modal-content,
#user-modal-content,
#exit-modal-content
{
	display: none;
}
</style>
