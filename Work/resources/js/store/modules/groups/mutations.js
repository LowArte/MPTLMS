import * as types from '../../mutation-types'

export default {
    [types.SET_GROUPS_FULL](state, groups) {
        state.groups_full = groups
    },
    [types.SET_GROUPS_COMBO](state, groups) {
        state.groups_combobox = groups
    },
    add(state,data){
      state.groups_full.unshift(data);
    },
}