import getters from './getters'
import mutations from './mutations'
import actions from './actions'
import {CacheData} from '@/js/plugins/CacheData'

const state = {
    groups_journal: [],
    groups_subgects_list: new CacheData()
}

export default {
    state,
    getters,
    mutations,
    actions
}
