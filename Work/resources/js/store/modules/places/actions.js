import * as actions from '../../action-types'
import api_place from "@/js/api/place";

export default{
    async [actions.ADD_PLACE]({ commit, state }, data) {
        let result = await api_place.savePlace(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(actions.ADD_PLACE,data.result)
        }
    },
    
    async [actions.DELETE_PLACE]({ commit, state }, data) {
        let result = await api_place.deletePlace(data.result, data.context);
        if (result) {
            commit(actions.DELETE_PLACE,data.result)
        }
    },

    async [actions.EDIT_PLACE]({ commit, state }, data) {
        let result = await api_place.editPlace(data.result, data.context);
        if (result) {
            commit(actions.EDIT_PLACE,data.result)
        }
    },
}