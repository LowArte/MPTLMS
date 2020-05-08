import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_group from "@/js/api/group";
import api_journal from "@/js/api/journal";
import api_association from "@/js/api/association";

export default {
    async [actions.SET_GROUPS_FOR_UMO] ({commit, state}) {
        commit(types.SET_GROUPS_FOR_UMO, await api_group.getGroupsAndAssociation());
    },
    async [actions.SET_GROUPS_SUBJECTS] ({commit, state}, item) {
        commit(types.SET_GROUPS_SUBJECTS, item); 
    },
    async [actions.CREATE_JOURNAL] ({commit, state}, journal) {
        await api_association.saveAssociation(journal)
    },
    async [actions.UPDATE_JOURNAL] ({commit, state}, group_id) {
        commit(types.UPDATE_JOURNAL, group_id)
    },
    async [actions.CLOSE_JOURNAL] ({commit, state}, item) {
        await api_journal.editJournalClose(item.id, !item.isClose);
        commit(types.CLOSE_JOURNAL, item);
    },
}