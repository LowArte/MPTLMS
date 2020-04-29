import * as actions from '../../action-types';
import api_group from "@/js/api/group";

export default{
    async [actions.ADD_GROUP]({ commit, state }, data) {
        let result = await api_group.saveGroup(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(actions.ADD_GROUP,data.result)
        }
    },

    async [actions.DELETE_GROUP]({ commit, state }, data) {
        let result = await api_group.deleteGroup(data.result, data.context);
        if (result) {
            commit(actions.DELETE_GROUP,data.result)
        }
    },
    
    async [actions.EDIT_GROUP]({ commit, state }, data) {
        let result = await api_group.editGroup(data.result, data.context);
        if (result) {
            commit(actions.EDIT_GROUP,data.result)
        }
    },

    async [actions.ADD_CACHE_GROUP_DATA]({ commit, state },data){
        if(!state.groups_combobox_cache.contains(data.result))
        {
            let result = await api_group.getGroupsByDepartmentId(data.result, data.context);
            await commit(actions.ADD_CACHE_GROUP_DATA,{id:data.result,result:result});
        }
        else{
            await commit(actions.ADD_ID_CACHE_GROUP_DATA,data.result);
        }
    }
}