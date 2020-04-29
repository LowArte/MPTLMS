import * as actions from '../../action-types';
import * as types from '../../mutation-types'
import api_cerificate from "@/js/api/certificate";

export default {
    async [actions.SET_СERTIFICATE]({ commit, state }) {
        let respond = await api_cerificate.getCertificates();
        commit(types.SET_СERTIFICATE, respond);
    },
    async [actions.ADD_СERTIFICATE]({ commit, state }, data) {
        return await api_cerificate.save(data);
    },
    async [actions.RESPOND_СERTIFICATE]({ commit, state }, data) {
        if (await api_cerificate.sendEmailAccess(data)) {
            commit(types.RESPOND_СERTIFICATE, data);
            return true;
        }
        return false;
    },
    async [actions.CANCEL_СERTIFICATE]({ commit, state }, data) {
        if (await api_cerificate.sendEmailCancel(data)) {
            commit(types.CANCEL_СERTIFICATE, data);
            return true;
        }
        return false;
    }
}