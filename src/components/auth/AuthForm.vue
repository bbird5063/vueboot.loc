<template>
	<!-- Button trigger modal -->
	<button hidden id="open-code-modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login-signup-modal">
		Launch modal
	</button>
	<!-- Modal  @click="fadeOutIn($store.state.auth.currModal)" -->
	<div id="login-signup-modal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">

			<!-- START LOGIN -->
			<!-- <div v-show="$store.state.auth.currModal == 'login-modal-content'" id="login-modal-content" class="modal-content"> -->
			<div id="login-modal-content" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Вход в аккаунт</h5>
					<button type="button" @click="fadeOutIn('login-modal-content')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="$store.state.auth.currModal == 'login-modal-content' && error.error" class="alert alert-danger">
							{{ error.error }}
						</div>
						<div v-html="error.info" v-if="$store.state.auth.currModal == 'login-modal-content' && error.info" class="alert alert-warning">
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_login.php" method="post" id="Login-Form" role="login-modal-content">
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
					<button type="button" @click="fadeOutIn('signup-modal-content')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="$store.state.auth.currModal == 'signup-modal-content' && error.error" class="alert alert-danger">
							{{ error.error }}
						</div>
						<div v-html="error.info" v-if="$store.state.auth.currModal == 'signup-modal-content' && error.info" class="alert alert-warning">
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_registration.php" method="post" id="Signin-Form" role="signup-modal-content">
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
					<button type="button" @click="fadeOutIn('forgot-password-modal-content')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="$store.state.auth.currModal == 'forgot-password-modal-content' && error.error" class="alert alert-danger">
							{{ error.error }}
						</div>
						<div v-html="error.info" v-if="$store.state.auth.currModal == 'forgot-password-modal-content' && error.info" class="alert alert-warning">
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_restoration.php" id="Forgot-Password-Form" method="post" role="forgot-password-modal-content">
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
					<button type="button" @click="fadeOutIn('code-modal-content')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="$store.state.auth.currModal == 'code-modal-content' && error.error" class="alert alert-danger">
							{{ error.error }}
						</div>
						<div v-html="error.info" v-if="$store.state.auth.currModal == 'code-modal-content' && error.info" class="alert alert-warning">
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_activate.php" id="Code-Form" method="post" role="code-modal-content">

						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fa fa-pencil"></i></span>
							<input v-focus :value="$store.state.auth.id == 0 ? '' : $store.state.auth.id" id="code" name="form[code]" type="text" class="form-control" aria-label="Code" aria-describedby="code" placeholder="Введите код" value="">
						</div>
						<!-- $route.params.id == 0 ? '' : $route.params.id  |   -->
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
					<button type="button" @click="fadeOutIn('user-modal-content')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="$store.state.auth.currModal == 'user-modal-content' && error.error" class="alert alert-danger">
							{{ error.error }}
						</div>
						<div v-html="error.info" v-if="$store.state.auth.currModal == 'user-modal-content' && error.info" class="alert alert-warning">
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_registration.php" method="post" id="User-Form" role="user-modal-content">

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
					<button type="button" @click="fadeOutIn('exit-modal-content')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div v-if="$store.state.auth.currModal == 'exit-modal-content' && error.error" class="alert alert-danger">
							{{ error.error }}
						</div>
						<div v-html="error.info" v-if="$store.state.auth.currModal == 'exit-modal-content' && error.info" class="alert alert-warning">
						</div>
					</div>
					<form @submit.prevent="onSubmit" action="/php_modules/auth/controller_exit.php" id="Exit-Form" method="post" role="exit-modal-content">
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
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex';
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
			error: {},
		}
	},

	watch: {
		nameModal(newNameModal) {
			document.querySelector("#open-code-modal").dispatchEvent(new Event("click"));
			//this.fadeOutIn('', newNameModal);
			this.fadeIn('#' + newNameModal);
		}
	},

	methods: {
		...mapActions({
			fadeOut: 'auth/fadeOut',
			fadeIn: 'auth/fadeIn',
		}),


		onSubmit(formElem) {
			const url = formElem.srcElement.attributes.action.nodeValue; // /php_modules/auth/controller_login.php

			// ИЛИ const url = formElem.target.action; // http://192.168.0.100:8080/php_modules/auth/controller_login.php

			console.log('==onSubmit(formElem)===========================');
			console.log(formElem.srcElement.attributes.action.nodeValue);
			console.log(formElem.target.length);

			let post = '';
			for (let key = 0; key < formElem.target.length; key++) {
				if (formElem.target[key].type !== 'submit' && formElem.target[key].type !== 'checkbox') {
					post += '&' + formElem.target[key].name + '=' + formElem.target[key].value;
				}
				if (formElem.target[key].type == 'checkbox') {
					post += '&' + formElem.target[key].name + '=' + formElem.target[key].checked;
				}
			}
			post = post ? post.slice(1) : '';
			post += post ? '&' : '';
			post += 'new_num=' + this.$store.state.auth.authMode;
			if (!this.$store.state.auth.isLocalhost) {
				this.authAxios(url, post, formElem.target.id);
			}
		},

		async authAxios(url, post, formId) {
			try {
				this.isLoading = true;
				const response = await axios.post(url, post);
				console.log('--response.data---------------------');
				console.log(response.data);

				response.data.reg_error ? this.error.error = response.data.reg_error : delete this.error.error;
				response.data.reg_info ? this.error.info = response.data.reg_info : delete this.error.info;
				console.log('--this.error---------------------');
				console.log(this.error.error);
				console.log(this.error.info);


				response.data.new_num ? this.$store.commit('auth/setAuthMode', response.data.new_num) : '';

				this.$store.commit('auth/setDataUser', response.data.user_data ? response.data.user_data : '');

				if (response.data.url_act) {
					console.log('--url_act---------------------');
					console.log(response.data.url_act);
				}

				console.log('==response.data.contentIn==================');
				console.log(response.data.contentIn);

				if (response.data.contentIn) {
					response.data.contentIn = response.data.contentIn.slice(1);
					this.fadeOut('#' + this.$store.state.auth.currModal);
					this.fadeIn('#' + response.data.contentIn);
					this.$store.commit('auth/setCurrModal', response.data.contentIn);
				}
				else if (this.$store.state.auth.currModal == 'exit-modal-content') {
					this.fadeOut('#' + this.$store.state.auth.currModal);
					this.$store.commit('auth/setCurrModal', '');
					this.$store.dispatch('auth/updateUser');
					document.querySelector("#open-code-modal").dispatchEvent(new Event("click"));
				}
				else if (!this.error.error && !this.error.info) {
					this.fadeOut('#' + this.$store.state.auth.currModal);
					this.$store.commit('auth/setCurrModal', '');
					document.querySelector("#open-code-modal").dispatchEvent(new Event("click"));
				}
			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			} finally {
				this.isLoading = false;
			}
		},

		fadeOutIn(elOut, elIn = '') { // переход по начальным ссылкам
			this.fadeOut('#' + elOut);
			// elIn ? this.fadeIn('#' + elIn) : document.querySelector(".btn-close").dispatchEvent(new Event("click"));
			if (elIn) {
				this.fadeIn('#' + elIn);
				this.$store.commit('auth/setCurrModal', elIn);
			}
		},
	},

	mounted() {
	},

	created() {
	},
};
</script>

<style scoped>
.alert
{
	text-align: center;
	vertical-align: middle;
}

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
