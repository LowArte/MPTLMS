import * as types from '../../mutation-types'

export default {
    [types.SET_TIMETABLE_FULL](state, timetable) {
        state.timetable_full.push(timetable);
    },
    [types.EDIT_TIMETABLE](state, timetable) {
        state.timetable_full.edit(timetable);
    },
}