import * as types from '../../mutation-types'

export default {
  [ types.SET_SERVER ] (state, data) {
    state.profilactic = data.profilactic
    state.name = data.name
  },
  [ types.SET_PROFILACTIC ] (state, data) {
    state.profilactic.option_value = data
  },
}
