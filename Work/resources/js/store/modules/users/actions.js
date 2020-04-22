import * as types from '../../mutation-types'
import api from "@/js/api/users";
import * as actions from '../../action-types'

export default{
    async [actions.ADD_USER]({ commit, state }, data) {
        let result = await api.saveUser(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(actions.ADD_USER,data.result)
        }
    },
    
    async [actions.DELETE_USER]({ commit, state }, data) {
        let result = await api.deleteUser(data.result, data.context);
        if (result) {
            commit(actions.DELETE_USER,data.result)
        }
    },

    async [actions.EDIT_USER]({ commit, state }, data) {
        let result = await api.editUser(data.result, data.context);
        if (result) {
            commit(actions.EDIT_USER,data.result)
        }
    },
}