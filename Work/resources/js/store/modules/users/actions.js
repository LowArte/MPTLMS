import * as types from '../../mutation-types'
import api from "@/js/api/users";

export default{
    async [types.ADD_USER]({ commit, state }, data) {
        let result = await api.saveUser(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(types.ADD_USER,data.result)
        }
    },
    
    async [types.DELETE_USER]({ commit, state }, data) {
        let result = await api.deleteUser(data.result.id, data.context);
        if (result) {
            commit(types.DELETE_USER,data.result.id)
        }
    },

    async [types.EDIT_USER]({ commit, state }, data) {
        let result = await api.editUser(data.result, data.context);
        if (result) {
            commit(types.EDIT_USER,data.result)
        }
    },
}