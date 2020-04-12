import * as types from '../../mutation-types'
import api from "@/js/api/departments";

export default{
    async [types.ADD_SPECIALITIE]({ commit, state }, data) {
        let result = await api.saveDepartment(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit("add", data.result)
        }
    },
    
    async [types.DELETE_SPECIALITIE]({ commit, state }, data) {
        let result = await api.deleteDepartment(data.result.id, data.context);
        if (result) {
            let newArr = state.specialities_full.filter(res => {
                if (res.id == data.result.id) {
                    return false;
                } else
                    return true;
            });
            commit(types.SET_SPECIALITIES_FULL,newArr)
        }
    },

    async [types.EDIT_SPECIALITIE]({ commit, state }, data) {
        let result = await api.editDepartment(data.result, data.context);
        if (result) {
            let buffer = JSON.parse(JSON.stringify(state.specialities_full));
            let newArr = buffer.filter((res => {
                if (res.id == data.result.id) {
                    res.dep_name_full = data.result.dep_name_full,
                    res.image = data.result.image
                    res.qualification = data.result.qualification
                    res.studysperiod = data.result.studysperiod
                    res.info = data.result.info
                }
                return true
            }));
            commit(types.SET_SPECIALITIES_FULL,newArr)
        }
    },
}