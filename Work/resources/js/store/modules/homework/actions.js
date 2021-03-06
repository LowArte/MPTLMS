import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_homework from "@/js/api/homework";

export default {
    async [actions.ADD_CACHE_HOMEWORK] ({ commit, state }, data) {
        if(!state.homework_list.contains(data.id)) {
            let result = await api_homework.getHomeWorkByTeacherId(data.id);
            result.forEach(el => {
                el.groups_text = el.groups.join(', ');
                
            });
            if(result)
                await commit(types.ADD_CACHE_HOMEWORK,{id: data.id, result: result});
            else
                return undefined;
        } else {
            commit(types.ADD_ID_CACHE_HOMEWORK, data.id);
        }
    }, 

    async [actions.ADD_CACHE_HOMEWORK_STUDENT] ({ commit, state }, data) {
        if(!state.homework_list.contains(data.id)) {
            let result = await api_homework.getHomeWorkByGroupId(data.id);
            /*result.forEach(el => {
                el.groups_text = el.groups.join(', ');
            });*/
            if(result)
                await commit(types.ADD_CACHE_HOMEWORK,{id: data.id, result: result});
            else
                return undefined;
        } else {
            commit(types.ADD_ID_CACHE_HOMEWORK, data.id);
        }
    },

    async [actions.CACHE_HOMEWORK_UPDATE] ({ commit, state }, data) {
        let result = await api_homework.getHomeWorkByTeacherId(data.id);
        await commit(types.CLEAR_CACHE_GROUP);
        await commit(types.ADD_CACHE_HOMEWORK,{id: data.id, result: result});
    }, 
}