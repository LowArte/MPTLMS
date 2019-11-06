import * as types from '../../mutation-types'

export default {
  [ types.SELECT_STUDENT ] (state, data) {
    state.student = data.student
    state.group = data.group
    state.departament = data.departament
  },
  [ types.DELETE_STUDENT ] (state) {
    state.student = null
    state.group = null
    state.departament = null
  }
}
