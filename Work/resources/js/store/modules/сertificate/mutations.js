import * as types from '../../mutation-types'

export default {
    [types.SET_СERTIFICATE](state, сertificate) {
        state.сertificate = сertificate
    },
    [types.RESPOND_СERTIFICATE](state, сertificate) {
        state.сertificate.forEach(element => {
            if (element.id == сertificate.id) {
                element.done = 1;
            }
        });
    },
    [types.CANCEL_СERTIFICATE](state, сertificate) {
        state.сertificate.deleteById(сertificate.id)
    }
}