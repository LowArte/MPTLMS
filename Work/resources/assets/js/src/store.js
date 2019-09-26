import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    Auth: {
      user: null
    }
  },
  mutations: {
    logout(state, data) {
      state.Auth.user = null
    },
    login(state,data){
      state.Auth.user = data.user
    }
  },
  actions: {
    logout(ctx, date) {
      ctx.commit('logout', date)
    },
    login(ctx, date) {
      ctx.commit('login', date)
    }
  },
  getters: {
    getAuth(store){
      return store.Auth;
    }
  }
})
