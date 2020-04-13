import * as types from '../../mutation-types'

export default {
    [types.SET_PLACES_FULL](state, places) {
        state.places_full = places
    },
    [types.SET_PLACES_COMBO](state, places) {
        state.places_combobox = places
    },
    [types.DELETE_PLACE](state, id) {
        state.place_full.deleteById(id)
    },
    [types.EDIT_PLACE](state, place) {
        console.log(typeof (state.place_full));
        state.place_full.edit(place);
    },
    [types.ADD_PLACE](state, place) {
        state.places_full.addToEnd(place);
    }
}
