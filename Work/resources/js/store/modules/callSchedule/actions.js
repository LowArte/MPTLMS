import * as types from '../../mutation-types'
import api from "@/js/api/callSchedule";

export default{
    async [types.EDIT_CALL_SCHEDULE]({ commit, state }, data) {
        let result = await api.edit(data.result, data.context);
        if (result) {
            commit(types.EDIT_CALL_SCHEDULE,data.result)
        }
    },
}