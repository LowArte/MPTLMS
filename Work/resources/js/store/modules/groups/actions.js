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

    async [types.ADD_CACHE_GROUP_DATA]({ commit, state },data){
        if(!state.groups_combobox_cache.contains(data.result))
        {
            let result = await api.getGroupsByDepartamentId(data.result, data.context);
            commit(types.ADD_CACHE_GROUP_DATA,{id:data.result,result:result});
        }
        else{
            commit(types.GET_CACHE_GROUP_DATA,data.result);
        }
    }
}