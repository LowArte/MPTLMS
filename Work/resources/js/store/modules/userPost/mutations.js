import * as types from '../../mutation-types'

export default {
    [types.SET_USERPOSTS_FULL](state, userposts) {
        state.userposts_full = userposts
    },
    [types.DELETE_USERPOST](state, id) {
        state.userposts_full.deleteById(id);
    },
    [types.EDIT_USERPOST](state, post) {
        state.userposts_full.edit(post);
    },
    [types.ADD_USERPOST](state, post) {
        state.userposts_full.addToEnd(post);
    }
}
