import * as types from '../../mutation-types'
import api from "@/js/api/group";

export default{
    async [types.ADD_GROUP]({ commit, state }, data) {
        let result = await api.saveGroup(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit("add", data.result)
        }
    },

    async [types.DELETE_GROUP]({ commit, state }, data) {
        let result = await api.deleteGroup(data.result.id, data.context);
        if (result) {
            let newArr = state.groups_full.filter(res => {
                if (res.id == data.result.id) {
                    return false;
                } else
                    return true;
            });
            commit(types.SET_GROUPS_FULL,newArr)
        }
    },
    
    async [types.EDIT_GROUP]({ commit, state }, data) {
        let result = await api.editGroup(data.result, data.context);
        if (result) {
            let buffer = JSON.parse(JSON.stringify(state.groups_full));
            let newArr = buffer.filter((res => {
                if (res.id == data.result.id) {
                    res.group_name = data.result.group_name,
                    res.group_number = data.result.group_number
                    res.group_year = data.result.group_year
                    res.curs = data.result.curs
                    res.departament_id = data.result.departament_id
                }
                return true
            }));
            commit(types.SET_GROUPS_FULL,newArr)
        }
    },
}