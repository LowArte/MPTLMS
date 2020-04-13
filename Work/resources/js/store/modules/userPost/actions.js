import * as types from '../../mutation-types'
import api from "@/js/api/userPosts"; //api для отделений

export default{
    async [types.ADD_USERPOST]({ commit, state }, data) {
        let result = await api.saveUserPost(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(types.ADD_USERPOST,data.result);
        }
    },
    
    async [types.DELETE_USERPOST]({ commit, state }, data) {
        let result = await api.deleteUserPost(data.result.id, data.context);
        if (result) {
            commit(types.DELETE_USERPOST,data.result.id)
        }
    },

    async [types.EDIT_USERPOST]({ commit, state }, data) {
        let result = await api.editUserPost(data.result, data.context);
        if (result) {
            commit(types.EDIT_USERPOST,data.result);
        }
    },
}