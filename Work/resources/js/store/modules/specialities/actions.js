import * as types from '../../mutation-types'
import api from "@/js/api/departments";

export default{
    async [types.ADD_SPECIALITIE]({ commit, state }, data) {
        let result = await api.saveDepartment(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(types.ADD_SPECIALITIE, data.result)
        }
    },
    
    async [types.DELETE_SPECIALITIE]({ commit, state }, data) {
        let result = await api.deleteDepartment(data.result.id, data.context);
        if (result) {
            commit(types.DELETE_SPECIALITIE,data.result.id)
        }
    },

    async [types.EDIT_SPECIALITIE]({ commit, state }, data) {
        let result = await api.editDepartment(data.result, data.context);
        if (result) {
            commit(types.EDIT_SPECIALITIE,data.result)
        }
    },
}