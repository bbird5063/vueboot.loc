import axios from 'axios';

export const authModule = {
	state: () => ({
		dataUser: '',
		currModal: '',
		isLocalhost: false,
		authMode: 1,

		id: 0,
		authShow: false,
		currentPath: '',
	}),
	/*
	#login-modal-content, #signup-modal-content, #forgot-password-modal-content, #code-modal-content, #password-modal-content, #user-modal-content, #exit-modal-content
	*/

	mutations: {
		setDataUser(state, dataUser) {
			state.dataUser = dataUser;
		},
		setCurrModal(state, currModal) {
			state.currModal = currModal;
		},
		setIsLocalhost(state, bool) {
			state.isLocalhost = bool;
		},
		setAuthMode(state, authMode) {
			state.authMode = authMode;
		},
		setId(state, id) {
			state.id = id;
		},
		setAuthShow(state, bool) {
			state.authShow = bool;
		},
		setCurrentPath(state, currentPath) {
			state.currentPath = currentPath;
		},
	},

	actions: {
		async updateUser({ state, commit }) {
			try {
				const response = await axios.post('/php_modules/auth/controller_update.php');
				console.log('==response.data.user_data===========================');
				console.log(response.data.user_data);
				console.log(response.data);
				commit('setDataUser', response.data.user_data);
				console.log(state.dataUser);

			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			}
		},

		fadeOut({ state, commit }, el) {
			let opacity = 1;
			let timer = setInterval(function () {
				if (opacity <= 0.1) {
					clearInterval(timer);
					document.querySelector(el).style.display = 'none';
				}
				document.querySelector(el).style.opacity = opacity;
				opacity -= opacity * 0.1;
			}, 10);
		},

		fadeIn({ state, commit }, el) {
			let opacity = 0.01;
			document.querySelector(el).style.display = 'block';
			let timer = setInterval(function () {
				if (opacity >= 1) {
					clearInterval(timer);
				}
				document.querySelector(el).style.opacity = opacity;
				opacity += opacity * 0.1;
			}, 10);
		},

		activateAccount({ state, commit, actions }) {
			actions.fadeOutIn(state.currModal, 'code-modal-content');
			commit.setCurrModal('setCurrModal', 'code-modal-content')
		},
	},

	namespaced: true,
};
