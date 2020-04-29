import getters from './getters'
import mutations from './mutations'
import actions from './actions'

const state = {
  notifications: null,
  unread_notifications_count: 0
}

export default {
    state,
    getters,
    mutations,
    actions
  }