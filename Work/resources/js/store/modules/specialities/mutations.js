import * as types from '../../mutation-types'

export default {
    [types.SET_SPECIALITIES_FULL](state, specialities) {
        state.specialities_full = specialities
    },
    [types.SET_SPECIALITIES_COMBO](state, specialities) {
        state.specialities_combobox = specialities
    },
    add(state,data){
      state.specialities_full.unshift(data);
    },
}