import * as types from '../../mutation-types'
import * as actions from '../../action-types'

export default {
    [types.SET_TIMETABLE_FULL](state, timetable) {
        state.timetable_full.push(timetable);
    },
    [actions.EDIT_TIMETABLE](state, timetable) {
        state.timetable_full.edit(timetable);
    },
    [types.UPDATE_TIACHER_TIMETABLE](state, data) {
        state.tieacher_timetable = data
    }
}