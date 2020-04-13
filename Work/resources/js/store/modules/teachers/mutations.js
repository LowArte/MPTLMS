import * as types from '../../mutation-types'

export default {
  [ types.SET_TEACHERS_COMBO ] (state, teachers) {
    state.teachers_combobox = teachers;
  },
}