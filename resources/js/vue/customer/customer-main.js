require('../../bootstrap');

import { createApp } from 'vue';
import {router} from "./Routes/VueRoutes";
import { store } from './Store/store';
import VueCookies from 'vue3-cookies'

import App from './App.vue';

const app = createApp(App);
app.use(router);
app.use(store);
app.use(VueCookies);
app.mount('#app');


