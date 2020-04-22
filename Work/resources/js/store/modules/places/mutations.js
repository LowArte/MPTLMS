import * as types from '../../mutation-types'
import * as actions from '../../action-types'


export default {
    [types.SET_PLACES_FULL](state, places) {
        state.places_full = places
    },
    [types.SET_PLACES_COMBO](state, places) {
        state.places_combobox = places
    },
    
    [actions.DELETE_PLACE](state, id) {
        state.places_full.deleteById(id)
    },
    [actions.EDIT_PLACE](state, place) {
        state.places_full.edit(place);
    },
    [actions.ADD_PLACE](state, place) {
        state.places_full.addToEnd(place);
    }
}
