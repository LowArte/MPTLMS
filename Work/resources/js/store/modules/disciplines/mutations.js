import * as types from '../../mutation-types'

export default {
  [ types.SET_DISCIPLINES_COMBO ] (state, disciplines) {
    state.disciplines_combobox = disciplines;
  },
}