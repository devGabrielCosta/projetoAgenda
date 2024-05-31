import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import Notifications from '@kyvg/vue3-notification'
import router from './routes'
import store from './vuex'

const app = createApp(App);

const axiosInstance = axios.create({
    baseURL: 'http://localhost:8000/api/',    
});

app.config.globalProperties.axios = axiosInstance;

router.beforeEach((to, from, next) => {
  const isAuthenticated = store.getters.isLoggedIn;
  
  if (to.path !== '/login' && !isAuthenticated) {
    next('/login');
  } else {
    next();
  }
});
  
app.use(router);
app.use(store);
app.use(Notifications);

app.mount('#app')
