import * as types from '../../mutation-types'
import api from "@/js/api/group";

export default{
    async [types.ADD_GROUP]({ commit, state }, data) {
        let result = await api.saveGroup(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(types.ADD_GROUP,data.result)
        }
    },

    async [types.DELETE_GROUP]({ commit, state }, data) {
        let result = await api.deleteGroup(data.result, data.context);
        if (result) {
            commit(types.DELETE_GROUP,data.result)
        }
    },
    
    async [types.EDIT_GROUP]({ commit, state }, data) {
        let result = await api.editGroup(data.result, data.context);
        if (result) {
            commit(types.EDIT_GROUP,data.result)
        }
    },
}