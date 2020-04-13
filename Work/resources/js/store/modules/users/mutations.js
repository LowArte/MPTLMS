import * as types from '../../mutation-types'

export default {
    [types.SET_USERS_FULL](state, users) {
        state.users_full = users
    },
    [types.DELETE_USER](state, id) {
        state.users_full.deleteById(id);
    },
    [types.EDIT_USER](state, user) {
        state.users_full.edit(user);
    },
    [types.ADD_USER](state, user) {
        state.users_full.addToEnd(user);
    }
}
