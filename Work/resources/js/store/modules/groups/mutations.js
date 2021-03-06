import * as types from '../../mutation-types'
import * as actions from '../../action-types'

export default {
    [types.SET_GROUPS_FULL](state, groups) {
        state.groups_full = groups
    },
    [types.SET_GROUPS_COMBO](state, groups) {
        state.groups_combobox = groups
    },

    [actions.DELETE_GROUP](state, id) {
        state.groups_full.deleteById(id)
    },
    [actions.EDIT_GROUP](state, group) {
        state.groups_full.edit(group);
    },
    [actions.ADD_GROUP](state, group) {
        state.groups_full.addToEnd(group);
    },
    [actions.ADD_CACHE_GROUP_DATA](state, data) {
        state.groups_combobox_cache.add(data);
    },
    [actions.ADD_ID_CACHE_GROUP_DATA](state, id) {
        state.groups_combobox_cache.addId(id);
    }
}