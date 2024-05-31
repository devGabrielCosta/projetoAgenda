import { createApp, reactive } from 'vue'
import App from './App.vue'
import axios from 'axios'
import Notifications from '@kyvg/vue3-notification'

const app = createApp(App);

const axiosInstance = axios.create({
    baseURL: 'http://localhost:8000/api/',    
});

const store = reactive({
    loggedUser: null,
    selectedSchedule: null   
});

app.config.globalProperties.axios = axiosInstance;
app.config.globalProperties.store = store;

app.use(Notifications);

app.mount('#app')
