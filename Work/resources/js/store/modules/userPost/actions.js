import api from "@/js/api/userPosts"; //api для отделений
import * as actions from '../../action-types'

export default{
    async [actions.ADD_USERPOST]({ commit, state }, data) {
        let result = await api.saveUserPost(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(actions.ADD_USERPOST,data.result);
        }
    },
    
    async [actions.DELETE_USERPOST]({ commit, state }, data) {
        let result = await api.deleteUserPost(data.result, data.context);
        if (result) {
            commit(actions.DELETE_USERPOST,data.result)
        }
    },

    async [actions.EDIT_USERPOST]({ commit, state }, data) {
        let result = await api.editUserPost(data.result, data.context);
        if (result) {
            commit(actions.EDIT_USERPOST,data.result);
        }
    },
}