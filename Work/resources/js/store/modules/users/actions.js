import * as types from '../../mutation-types'
import api from "@/js/api/users";

export default{
    async [types.ADD_USER]({ commit, state }, data) {
        let result = await api.saveUser(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit("add", data.result)
        }
    },
    
    async [types.DELETE_USER]({ commit, state }, data) {
        let result = await api.deleteUser(data.result.id, data.context);
        if (result) {
            let newArr = state.users_full.filter(res => {
                if (res.id == data.result.id) {
                    return false;
                } else
                    return true;
            });
            commit(types.SET_USERS_FULL,newArr)
        }
    },

    async [types.EDIT_USER]({ commit, state }, data) {
        let result = await api.editUser(data.result, data.context);
        if (result) {
            let buffer = JSON.parse(JSON.stringify(users_full.users));
            let newArr = buffer.filter((res => {
                if (res.id == data.result.id) {
                    res.name = data.result.name
                    res.secName = data.result.secName
                    res.thirdName = data.result.thirdName
                    res.email = data.result.email
                    res.disabled = data.result.disabled
                    res.post_id = data.result.post_id
                };
                return true
            }));
            commit(types.SET_USERS_FULL,newArr)
        }
    },
}