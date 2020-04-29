import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_notifications from '@/js/api/notification'

export default {
    async [actions.GET_NOTIFICATIONS] ({commit, state}, id) {
        let respond = await api_notifications.getNotifications(id)
        commit(types.SET_NOTIFICATIONS, respond)
    },
    async [actions.EDIT_NOTIFICATIONS] ({commit, state}, respond) {
        await api_notifications.editNotifications(respond)
        commit(types.SET_NOTIFICATIONS, respond)
    },
    async [actions.EDIT_ALL_NOTIFICATIONS] ({commit, state}, respond) {
        commit(types.EDIT_ALL_NOTIFICATIONS, respond)
        await api_notifications.editNotifications(state.notifications)
    }
}