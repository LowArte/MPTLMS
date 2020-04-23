import * as actions from '../../action-types'
import api_schedule from "@/js/api/schedule";

export default{
    async [actions.EDIT_TIMETABLE]({ commit, state }, data) {
        let result = await api_schedule.editSchedule(data.result, data.context);
        if (result) {
            commit(actions.EDIT_TIMETABLE,data.result)
        }
    },
}