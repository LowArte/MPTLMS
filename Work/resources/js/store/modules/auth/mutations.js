import * as types from '../../mutation-types'

export default {
  [ types.SET_AUTH ] (state, data) {
    state.user = data.user
    state.accessToken = data.access_token
  },
  [ types.SET_NOTAUTH ] (state) {
    state.user = null
    state.accessToken = null
  }
}
