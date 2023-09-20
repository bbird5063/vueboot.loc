import axios from 'axios';

export const authModule = {
	state: () => ({
		dataUser: null,
		currModal: 'login-modal-content',
		isLocalhost: false,
		likes: 128, // test
		authMode: 1,
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
	},

	namespaced: true,
};
