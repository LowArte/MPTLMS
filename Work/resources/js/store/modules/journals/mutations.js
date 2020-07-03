import * as types from '../../mutation-types'
import {
    CacheData
} from '@/js/plugins/CacheData'

export default {
    [types.SET_JOURNALS_GROUPS](state, groups) {
        state.groups_journal = groups;
    },
    [types.ADD_CACHE_GROUPS_SUBJECTS](state, data) {
        state.groups_subgects_list.add(data);
    },
    [types.ADD_ID_CACHE_GROUPS_SUBJECTS](state, id) {
        state.groups_subgects_list.addId(id);
    },
    [types.CLEAR_CACHE_GROUP](state) {
        state.groups_subgects_list = new CacheData()
    },
    [types.SET_JOURNAL_TEACHER](state, data) {
        state.teacher_journals = data
    }
}
