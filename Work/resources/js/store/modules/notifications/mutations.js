import * as types from '../../mutation-types'

export default {
    [types.SET_NOTIFICATIONS](state, respond) {
        state.notifications = respond
        if(state.notifications) {
            let counter = 0
            state.notifications.info.forEach(element => {
                if (!element.done) {
                    counter++
                }
            });
            state.unread_notifications_count = counter 
        }
    },
    [types.EDIT_ALL_NOTIFICATIONS](state, respond) {
        state.notifications.info.forEach(element => {
            if (!element.done) {
                element.done = true
            }
        });
        state.unread_notifications_count = 0 
    }
}