import getters from './getters'
import mutations from './mutations'

const state = {
  isAuthenticated:false,
  user:null,
  routes:null,
  slug:null,
  layout:{name:"NOT_REGISTER",component:()=>import("@/js/layouts/NotRegister")}
}

export default {
  state,
  getters,
  mutations
}
