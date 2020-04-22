import * as types from '../../mutation-types'

export default {
    [types.SET_CALL_SCHEDULE](state, schedule) {
        state.call_schedule = schedule;
    },
    [types.EDIT_CALL_SCHEDULE](state, schedule) {
        state.call_schedule.edit(schedule);
    },
}