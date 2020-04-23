import api_user_post from "@/js/api/userPost"; //api для отделений
import * as actions from '../../action-types'

export default{
    async [actions.ADD_USERPOST]({ commit, state }, data) {
        let result = await api_user_post.saveUserPost(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(actions.ADD_USERPOST,data.result);
        }
    },
    
    async [actions.DELETE_USERPOST]({ commit, state }, data) {
        let result = await api_user_post.deleteUserPost(data.result, data.context);
        if (result) {
            commit(actions.DELETE_USERPOST,data.result)
        }
    },

    async [actions.EDIT_USERPOST]({ commit, state }, data) {
        let result = await api_user_post.editUserPost(data.result, data.context);
        if (result) {
            commit(actions.EDIT_USERPOST,data.result);
        }
    },
}