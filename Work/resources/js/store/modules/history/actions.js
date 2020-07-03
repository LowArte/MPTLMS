import * as actions from '../../action-types'
import api_history from "@/js/api/history";

export default{
    async [actions.SET_HISTORY] ({ commit, state }) {
        let result = await api_history.getHistory();
        if(result)
        {
            commit(actions.SET_HISTORY, result);
        }
    },
}