import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_schedule from "@/js/api/schedule";

export default{
    async [actions.EDIT_TIMETABLE]({ commit, state }, data) {
        let result = await api_schedule.editSchedule(data.result, data.context);
        if (result) {
            commit(actions.EDIT_TIMETABLE,data.result)
        }
    },
    async [actions.SET_TEACHER_TIMETABLE]({ commit, state }, data) {
        let result = await api_schedule.getScheduleTeacher(data.id);
        if (result) {
            console.log(result[data.date])
            commit(types.UPDATE_TIACHER_TIMETABLE, result[data.date])
        }
    },
    async [actions.SET_TEACHER_TIMETABLE_FULL]({ commit, state }, id) {
        let result = await api_schedule.getScheduleTeacher(id);
        if (result) {
            commit(types.UPDATE_TIACHER_TIMETABLE, result)
        }
    }
}