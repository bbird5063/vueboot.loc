import axios from 'axios';

export const authModule = {
	state: () => ({
		dataUser: '',
		currModal: 'login-modal-content',
		isLocalhost: false,
		authMode: 1,
		authShow: true,
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
		setIsLocalhost(state, isLocalhost) {
			state.isLocalhost = isLocalhost;
		},
		setAuthMode(state, authMode) {
			state.authMode = authMode;
		},
		setAuthShow(state, authShow) {
			state.authShow = authShow;
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

		}
	},

	namespaced: true,
};
