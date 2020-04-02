import * as types from '../../mutation-types'

export default {
  [ types.SET_AUTH ] (state, data) {
    state.user = data.user
  },
  [ types.SET_NOTAUTH ] (state) {
    state.user = null
  }
}
