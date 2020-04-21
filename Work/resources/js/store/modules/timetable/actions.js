import * as types from '../../mutation-types'
import api from "@/js/api/schedule";

export default{
    async [types.EDIT_TIMETABLE]({ commit, state }, data) {
        let result = await api.editSchedule(data.result, data.context);
        if (result) {
            commit(types.EDIT_TIMETABLE,data.result)
        }
    },
}