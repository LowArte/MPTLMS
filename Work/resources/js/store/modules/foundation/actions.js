import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_schedule from "@/js/api/schedule";

export default {
    async [actions.SET_CLASSROOM_FOUNDATION] ({commit, state}, id) {
        commit(types.SET_FEEDBACK, await api_schedule.getScheduleBildShowByGroupId(id));
    },
}