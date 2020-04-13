import * as types from '../../mutation-types'

export default {
    [types.SET_SPECIALITIES_FULL](state, specialities) {
        state.specialities_full = specialities
    },
    [types.SET_SPECIALITIES_COMBO](state, specialities) {
        state.specialities_combobox = specialities
    },
    [types.DELETE_SPECIALITIE](state, id) {
        state.specialities_full.deleteById(id);
    },
    [types.EDIT_SPECIALITIE](state, specialitie) {
        state.specialities_full.edit(specialitie);
    },
    [types.ADD_SPECIALITIE](state, specialitie) {
        state.specialities_full.addToEnd(specialitie);
    }
}