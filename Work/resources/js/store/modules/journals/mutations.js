import * as types from '../../mutation-types'

export default {
    [types.SET_GROUPS_FOR_UMO](state, groups_umo) {
        state.groups_umo = groups_umo
    },
    [types.SET_GROUPS_SUBJECTS](state, item) {
        state.groups_subjects = item
    },
    [types.CLOSE_JOURNAL](state, item) {
        state.groups_subjects.association.forEach(element => {
            if (element.id == item.id) {
                element.isClose = !item.isClose
            }
        });
    },
    [types.UPDATE_JOURNAL](state, group_id) {
        state.groups_umo.forEach(element => {
            if (element.group_id == group_id) {
                state.groups_subjects = element
            }
        });
    },
    [types.SET_GROUP_JOURNAL](state, id) {
        state.id_journal = id
    }
}
