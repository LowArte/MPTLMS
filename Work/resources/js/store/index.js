import Vue from 'vue'
import Vuex from 'vuex'
import snackbar from './modules/snackbar'
import overlayLoading from './modules/overlayLoading'
import auth from './modules/auth'
import server from './modules/server'
import specialitie from './modules/specialities'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    snackbar,
    overlayLoading,
    auth,
    server,
    specialitie
  },
  strict: debug
})
