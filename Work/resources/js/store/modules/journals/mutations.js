import * as types from '../../mutation-types'

export default {
    [types.SET_JOURNALS_GROUPS] (state, groups) {
        state.groups_journal = groups;
    },
    [types.ADD_CACHE_GROUPS_SUBJECTS](state, data) {
        state.groups_subgects_list.add(data);
    },
    [types.ADD_ID_CACHE_GROUPS_SUBJECTS](state, id) {
        state.groups_subgects_list.addId(id);
    }
}
