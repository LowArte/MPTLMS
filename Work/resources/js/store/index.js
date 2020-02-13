import Vue from 'vue'
import Vuex from 'vuex'
import snackbar from './modules/snackbar'
import slug from './modules/slug'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    snackbar,
    slug
  },
  strict: debug
})
