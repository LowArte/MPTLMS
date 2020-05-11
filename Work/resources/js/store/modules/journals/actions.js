import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_groups from '@/js/api/group'
import api_journal from '@/js/api/journal'

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
            await commit(types.ADD_CACHE_GROUPS_SUBJECTS,{id: data.result, result: result});
        }
    }
}