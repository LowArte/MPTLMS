import * as types from '../../mutation-types'

export default {
    [types.SET_PLACES_FULL](state, places) {
        state.places_full = places
    },
    [types.SET_PLACES_COMBO](state, places) {
        state.places_combobox = places
    },
    add(state,data){
      state.places_full.unshift(data);
    },
}