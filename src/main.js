import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';

import { Bootstrap } from './bootstrap/bootstrap.scss';

import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import 'popper.js';
import 'bootstrap';
import './bootstrap/bootstrap.scss';

// createApp(App).use(store).use(router).use(jQuery).mount('#app');
createApp(App).use(store).use(router).mount('#app');
