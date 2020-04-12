import * as types from '../../mutation-types'
import api from "@/js/api/userPosts"; //api для отделений

export default{
    async [types.ADD_USERPOST]({ commit, state }, data) {
        let result = await api.saveUserPost(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit("add", data.result)
        }
    },
    
    async [types.DELETE_USERPOST]({ commit, state }, data) {
        let result = await api.deleteUserPost(data.result.id, data.context);
        if (result) {
            let newArr = state.userposts_full.filter(res => {
                if (res.id == data.result.id) {
                    return false;
                } else
                    return true;
            });
            commit(types.SET_USERPOSTS_FULL,newArr)
        }
    },

    async [types.EDIT_USERPOST]({ commit, state }, data) {
        let result = await api.editUserPost(data.result, data.context);
        if (result) {
            let buffer = JSON.parse(JSON.stringify(state.userposts_full));
            let newArr = buffer.filter((res => {
                if (res.id == data.result.id) {
                    res.name = data.result.name
                };
                return true
            }));
            commit(types.SET_USERPOSTS_FULL,newArr)
        }
    },
}