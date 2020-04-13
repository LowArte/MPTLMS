import * as types from '../../mutation-types'
import api from "@/js/api/places";

export default{
    async [types.ADD_PLACE]({ commit, state }, data) {
        let result = await api.savePlace(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(types.ADD_PLACE,data.result)
        }
    },
    
    async [types.DELETE_PLACE]({ commit, state }, data) {
        let result = await api.deletePlace(data.result.id, data.context);
        if (result) {
            commit(types.DELETE_PLACE,data.result)
        }
    },

    async [types.EDIT_PLACE]({ commit, state }, data) {
        let result = await api.editPlace(data.result, data.context);
        if (result) {
            commit(types.EDIT_PLACE,data.result)
        }
    },
}