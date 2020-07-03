import getters from './getters'
import mutations from './mutations'
import actions from './actions'
import {CacheData} from '@/js/plugins/CacheData'


const state = {
  groups_full: null,
  groups_combobox_cache: new CacheData(),
}

export default {
  state,
  getters,
  mutations,
  actions
}