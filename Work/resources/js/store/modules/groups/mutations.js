import * as types from '../../mutation-types'

export default {
    [types.SET_GROUPS_FULL](state, groups) {
        state.groups_full = groups
    },
    [types.SET_GROUPS_COMBO](state, groups) {
        state.groups_combobox = groups
    },
    [types.DELETE_GROUP](state, id) {
        state.groups_full.deleteById(id)
    },
    [types.EDIT_GROUP](state, group) {
        state.groups_full.edit(group);
    },
    [types.ADD_GROUP](state, group) {
        state.groups_full.addToEnd(group);
    },
    [types.ADD_CACHE_GROUP_DATA](state, data) {
        state.groups_combobox_cache.add(data);
    },
    [types.GET_CACHE_GROUP_DATA](state, id) {
        state.groups_combobox_cache.addId(id);
    }
}