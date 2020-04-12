import * as types from '../../mutation-types'
import api from "@/js/api/places";

export default{
    async [types.ADD_PLACE]({ commit, state }, data) {
        let result = await api.savePlace(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit("add", data.result)
        }
    },
    
    async [types.DELETE_PLACE]({ commit, state }, data) {
        let result = await api.deletePlace(data.result.id, data.context);
        if (result) {
            let newArr = state.place_full.filter(res => {
                if (res.id == data.result.id) {
                    return false;
                } else
                    return true;
            });
            commit(types.SET_PLACES_FULL,newArr)
        }
    },

    async [types.EDIT_PLACE]({ commit, state }, data) {
        let result = await api.editPlace(data.result, data.context);
        if (result) {
            let buffer = JSON.parse(JSON.stringify(state.place_full));
            let newArr = buffer.filter((res => {
                if (res.id == data.result.id) {
                    res.place_name = data.result.place_name,
                    res.info = data.result.info
                }
                return true
            }));
            commit(types.SET_PLACES_FULL,newArr)
        }
    },
}