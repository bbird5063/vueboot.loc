import { createApp } from 'vue';
import App from './App.vue';
import components from '@/components/UI';
import router from '@/router';
import store from '@/store';

const app = createApp(App);

components.forEach(component => {
  app.component(component.name, component);
});

/*
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import 'popper.js';
import 'bootstrap';
import './bootstrap/bootstrap.scss';
*/
// createApp(App).use(store).use(router).use(jQuery).mount('#app');
// createApp(App).use(store).use(router).mount('#app');

app.use(router).use(store).mount('#app');
