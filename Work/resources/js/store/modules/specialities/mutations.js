import * as types from '../../mutation-types'
import * as actions from '../../action-types'

export default {
    [types.SET_SPECIALITIES_FULL](state, specialities) {
        state.specialities_full = specialities
    },
    
    [actions.DELETE_SPECIALITIE](state, id) {
        state.specialities_full.deleteById(id);
    },
    [actions.EDIT_SPECIALITIE](state, specialitie) {
        state.specialities_full.edit(specialitie);
    },
    [actions.ADD_SPECIALITIE](state, specialitie) {
        state.specialities_full.addToEnd(specialitie);
    }
}