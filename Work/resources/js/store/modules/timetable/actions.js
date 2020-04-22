import * as types from '../../mutation-types'
import * as actions from '../../action-types'
import api from "@/js/api/schedule";

export default{
    async [actions.EDIT_TIMETABLE]({ commit, state }, data) {
        let result = await api.editSchedule(data.result, data.context);
        if (result) {
            commit(actions.EDIT_TIMETABLE,data.result)
        }
    },
}