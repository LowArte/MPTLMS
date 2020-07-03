import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_groups from '@/js/api/group'
import api_journal from '@/js/api/journal'
import api_association from '@/js/api/association'

export default {
    async [actions.SET_JOURNALS_GROUPS] ({ commit, state }) {
        let result = await api_groups.getGroupsAndAssociation();
        if(result)
        {
            commit(types.SET_JOURNALS_GROUPS, result);
        }
    },

    async [actions.SET_GROUPS_SUBJECTS] ({ commit, state }, data) {
        if(!state.groups_subgects_list.contains(data.result)) {
            let result = await api_journal.getJournalsByGroupId(data.result);
            if(result)
                await commit(types.ADD_CACHE_GROUPS_SUBJECTS,{id: data.result, result: result});
            else
                return undefined;
        } else {
            commit(types.ADD_ID_CACHE_GROUPS_SUBJECTS, data.result);
        }
    },
    async [actions.CREATE_JOURNAL] ({ commit, state }, data) {
        if (await api_journal.saveJournal(data.data)) {
            let result = await api_journal.getJournalsByGroupId(data.result);
            await commit(types.CLEAR_CACHE_GROUP);
            await commit(types.ADD_CACHE_GROUPS_SUBJECTS,{id: data.result, result: result});
        }
    },
    async [actions.CLOSE_ALL_JOURNAL] ({ commit, state }, id_group) {
        if (await api_journal.editJournalCloseGroups(id_group)) {
            let result = await api_journal.getJournalsByGroupId(id_group);
            await commit(types.CLEAR_CACHE_GROUP);
            await commit(types.ADD_CACHE_GROUPS_SUBJECTS,{id: id_group, result: result});
        }
    },
    async [actions.CLOSE_JOURNAL] ({ commit, state }, data) {
        if (await api_journal.editJournalClose(data.id)) {
            let result = await api_journal.getJournalsByGroupId(data.result);
            await commit(types.CLEAR_CACHE_GROUP);
            await commit(types.ADD_CACHE_GROUPS_SUBJECTS,{id: data.result, result: result});
        }
    }, 
    async [actions.EDIT_JOURNAL_ACCESS] ({ commit, state }, data) {
        if (await api_journal.editJournalAssociation(data.data)) {
            let result = await api_journal.getJournalsByGroupId(data.result);
            await commit(types.CLEAR_CACHE_GROUP);
            await commit(types.ADD_CACHE_GROUPS_SUBJECTS,{id: data.result, result: result});
        }
    },
    async [actions.SET_JOURNAL_TEACHER] ({ commit, state }, id_user) {
        let result = await api_association.getAssociationTeacher(id_user);
        await commit(types.SET_JOURNAL_TEACHER, result)
    }, 
}