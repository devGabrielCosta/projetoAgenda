import { createStore } from 'vuex';
import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api/',    
});

const store = createStore({
  state: {
    status: '',
    loggedUser: JSON.parse(localStorage.getItem('loggedUser')) || null
  },
  actions: {
    login({commit}, id) {
      return new Promise((resolve, reject) => {
        axiosInstance
          .get('user/' + id)
          .then(response => {
            if (response.data?.id) {
              localStorage.setItem('loggedUser', JSON.stringify(response.data));
              commit('setLoggedUser', response.data);
              resolve(response);
            } else {
              reject(response.data);
            }
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    logout({ commit }) {
      return new Promise((resolve) => {
        localStorage.removeItem('loggedUser');
        commit('setLoggedUser', null);
        resolve();
      });
    },
  },
  mutations: {
    setLoggedUser(state, user) {
      state.loggedUser = user;
    }
  },
  getters: {
    isLoggedIn: state => !!state.loggedUser,
    getLoggedType: state => state.loggedUser?.type,
    getLoggedId: state => state.loggedUser?.id
  }
});

export default store;