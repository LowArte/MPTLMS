import * as types from '../../mutation-types'

export default {
  [ types.SET_AUTH ] (state, data) {
    state.user = data.user
    state.routes = data.routes
    state.slug = data.slug
  },
  [ types.SET_NOTAUTH ] (state) {
    state.user = null
    state.routes = null
    state.slug = null
  },
  [types.SET_LAYOUT](state,data){
    state.layout = data
  }
}
