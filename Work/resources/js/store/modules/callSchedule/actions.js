import * as types from '../../mutation-types'
import * as actions from '../../action-types'
import api from "@/js/api/callSchedule";

export default{
    async [actions.EDIT_CALL_SCHEDULE]({ commit, state }, data) {
        let result = await api.edit(data.result, data.context);
        if (result) {
            commit(types.EDIT_CALL_SCHEDULE,data.result)
        }
    },
}