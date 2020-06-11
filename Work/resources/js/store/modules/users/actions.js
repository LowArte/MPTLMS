import api_user from "@/js/api/user";
import * as actions from '../../action-types'

export default{
    async [actions.ADD_USER]({ commit, state }, data) {
        let result = await api_user.saveUser(data.result, data.context);
        console.log(result);
        if (result) {
            data.result.id = result;
            commit(actions.ADD_USER,data.result)
        }
    },
    
    async [actions.DELETE_USER]({ commit, state }, data) {
        let result = await api_user.deleteUser(data.result, data.context);
        if (result) {
            commit(actions.DELETE_USER,data.result[0])
        }
    },

    async [actions.EDIT_USER]({ commit, state }, data) {
        let result = await api_user.editUser(data.result, data.context);
        if (result) {
            commit(actions.EDIT_USER,data.result)
        }
    },
}