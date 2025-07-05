import { createApp } from 'vue'
import App from './App.vue'

const app = createApp(App);

// import { createPinia } from 'pinia'
// app.use(createPinia());

import router from './router'
app.use(router);

import axios from 'axios';

axios.defaults.baseURL = import.meta.env.VITE_SERVER_URL;
app.mount('#app');
