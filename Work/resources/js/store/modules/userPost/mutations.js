import * as types from '../../mutation-types'
import * as actions from '../../action-types'

export default {
    [types.SET_USERPOSTS_FULL](state, userposts) {
        state.userposts_full = userposts
    },

    [actions.DELETE_USERPOST](state, id) {
        state.userposts_full.deleteById(id);
    },
    [actions.EDIT_USERPOST](state, post) {
        state.userposts_full.edit(post);
    },
    [actions.ADD_USERPOST](state, post) {
        state.userposts_full.addToEnd(post);
    }
}
