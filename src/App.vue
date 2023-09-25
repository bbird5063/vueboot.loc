<template>
	<navbar></navbar>
	<div class="app">
		<h1>ID = {{ $route.params.id }}</h1>
		<!-- <router-view> - в него будут встраиваться компоненты из router.js -->
		<router-view></router-view>
		<auth-form></auth-form>

		<!-- Кнопка-триггер модального окна -->
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login-signup-modal">
			Запустите демо модального окна
		</button>
	</div>
</template>

<script>
import Navbar from '@/components/Navbar';
import AuthForm from '@/components/auth/AuthForm';

export default {
	components: {
		Navbar,
		AuthForm,
	},
	mounted() {
		// alert('App = ' + this.$route.params.id);
		// alert(location);
		if (
			location.hostname.includes('192.168.0.100') ||
			location.hostname.includes('localhost')
		) {
			this.$store.commit('auth/setIsLocalhost', true);
		} else {
			this.$store.commit('auth/setIsLocalhost', false);
			// this.$store.actions.auth.updateUser();
			this.$store.dispatch('auth/updateUser')
		}
		console.log('==dataUser========================');
		console.table(this.$store.state.auth.dataUser);
	}
};
</script>

<style>
*
{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

.app
{
	padding: 20px;
}

.app_btns
{
	display: flex;
	/* кнопка и список напротив друга  */
	justify-content: space-between;
	align-items: center;
	margin: 0;
}

table,
td,
th
{
	border-collapse: collapse;
	border: 3px solid #245488;
}

td
{
	padding: 5px;
}

.page__wrapper
{
	display: flex;
	margin-top: 15px;
	align-items: center;
}

.page
{
	border: 1px solid black;
	padding: 10px;
	cursor: pointer;
}

.current-page
{
	border: 2px solid teal;
	cursor: pointer;
}
</style>
