import * as actions from '../../action-types'
import * as types from '../../mutation-types'

export default {
    [types.SET_CALL_SCHEDULE](state, schedule) {
        state.call_schedule = schedule;
    },
    [actions.EDIT_CALL_SCHEDULE](state, schedule) {
        state.call_schedule.edit(schedule);
    },
}