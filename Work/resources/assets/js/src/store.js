import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    Auth: {
      login: false,
      user_id: null,
      api_token: null,
      name: null,
      photo: null
    }
  },
  mutations: {
  },
  actions: {
  },
  getters: {
  }
})
