import '../css/app.css';
import './bootstrap';

import { createApp } from 'vue';
import App from './Components/App.vue';
import router from './Components/routers/index.js';
import axiosInstance from './Components/plugins/axios';

const app = createApp(App);

app.use(router);
app.config.globalProperties.$axios = axiosInstance;
app.mount('#app');
