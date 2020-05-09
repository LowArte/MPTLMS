import getters from './getters'
import mutations from './mutations'
import actions from './actions'

const state = {
    groups_umo: [], //id, отделение, наименование группы
    groups_subjects: null, //id, дисциплины
    group_journal: [], //id, журналы, статус журнала
    id_journal: null
}

export default {
    state,
    getters,
    mutations,
    actions
}
