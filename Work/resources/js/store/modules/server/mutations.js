import * as types from '../../mutation-types'

export default {
  [ types.SET_SERVER ] (state, data) {
    state.isProfilactic = data.isProfilactic
    state.name = data.name
  },
  [ types.SET_PROFILACTIC ] (state, data) {
    state.isProfilactic = data
  },
}
