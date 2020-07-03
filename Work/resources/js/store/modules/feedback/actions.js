import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_feedback from '@/js/api/feedback'

export default {
    async [actions.FILL_UP_FEEDBACK] ({commit, state}) {
        let feedback = await api_feedback.getFeedbackRequests(this);
        commit(types.SET_FEEDBACK, feedback);
    },
    async [actions.RESPOND] ({commit, state}, data) {
        await api_feedback.sendEmail(data)
    },
    async [actions.EDIT_ANSWERED] ({commit, state}, id) {
        commit(types.EDIT_ANSWERED, id);
    }
}