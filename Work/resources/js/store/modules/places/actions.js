import * as actions from '../../action-types'
import api from "@/js/api/places";

export default{
    async [actions.ADD_PLACE]({ commit, state }, data) {
        let result = await api.savePlace(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(actions.ADD_PLACE,data.result)
        }
    },
    
    async [actions.DELETE_PLACE]({ commit, state }, data) {
        let result = await api.deletePlace(data.result, data.context);
        if (result) {
            commit(actions.DELETE_PLACE,data.result)
        }
    },

    async [actions.EDIT_PLACE]({ commit, state }, data) {
        let result = await api.editPlace(data.result, data.context);
        if (result) {
            commit(actions.EDIT_PLACE,data.result)
        }
    },
}