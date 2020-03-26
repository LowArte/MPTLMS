import getters from './getters'
import mutations from './mutations'

const state = {
  isAuthenticated:false,
  user:null,
  routes:null,
  slug:null
}

export default {
  state,
  getters,
  mutations
}
