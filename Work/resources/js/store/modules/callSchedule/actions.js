import * as actions from '../../action-types'
import api_call_schedule from "@/js/api/callSchedule";

export default{
    async [actions.EDIT_CALL_SCHEDULE]({ commit, state }, data) {
        let result = await api_call_schedule.edit(data.result, data.context);
        if (result) {
            commit(actions.EDIT_CALL_SCHEDULE,data.result);
            data.context.showMessage("Выполнено!");
        }
        else
            data.context.showError("Ошибка выполнения!");
    },
}