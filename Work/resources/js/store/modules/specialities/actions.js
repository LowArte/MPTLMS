import * as types from '../../mutation-types'
import * as actions from '../../action-types'
import api_department from "@/js/api/departments";

export default{

    async [actions.CREATE_SPECIALITIE]({ commit, state }, data) {
        let items = await api_department.getDepartments();
        if(items)
            commit(types.SET_SPECIALITIES_FULL, items)
    },

    async [actions.ADD_SPECIALITIE]({ commit, state }, data) {
        let result = await api.saveDepartment(data.result, data.context);
        if (result) {
            data.result.id = result;
            commit(actions.ADD_SPECIALITIE, data.result)
        }
    },
    
    async [actions.DELETE_SPECIALITIE]({ commit, state }, data) {
        let result = await api.deleteDepartment(data.result, data.context);
        if (result) {
            commit(actions.DELETE_SPECIALITIE,data.result)
        }
    },

    async [actions.EDIT_SPECIALITIE]({ commit, state }, data) {
        let result = await api.editDepartment(data.result, data.context);
        if (result) {
            commit(actions.EDIT_SPECIALITIE,data.result)
        }
    },
}