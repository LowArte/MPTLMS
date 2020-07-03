import getters from './getters'
import mutations from './mutations'

const state = {
  isAuthenticated:false,
  user:null,
}

export default {
  state,
  getters,
  mutations
}