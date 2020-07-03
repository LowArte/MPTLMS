import * as types from '../../mutation-types'
import * as actions from '../../action-types'

export default {
    [types.SET_USERS_FULL](state, users) {
        state.users_full = users
    },

    [actions.DELETE_USER](state, id) {
        state.users_full.deleteById(id);
    },
    [actions.EDIT_USER](state, user) {
        state.users_full.edit(user);
    },
    [actions.ADD_USER](state, user) {
        state.users_full.addToEnd(user);
    }
}
