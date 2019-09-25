import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    Auth: {
      login: false,
      user_id: localStorage.getItem('user_id'),
      api_token: localStorage.getItem('api_token')
    }
  },
  mutations: {
    logout(state, data) {
      state.Auth.login = false
      state.Auth.api_token = null
      state.Auth.user_id = null
      localStorage.removeItem('user_id')
      localStorage.removeItem('api_token')
    },
    login(state,data){
      localStorage.setItem('user_id',data.user_id)
      localStorage.setItem('api_token',data.api_token)
      state.login = true
      state.Auth.user_id = data.user_id
      state.Auth.api_token = data.api_token
    }
  },
  actions: {
    logout(ctx, date) {
      ctx.commit('logout', date)
    },
    login(ctx, date) {
      ctx.commit('login', date)
    },
  },
  getters: {
    getAuth(store){
      return store.Auth;
    }
  }
})
