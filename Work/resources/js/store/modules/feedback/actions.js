import * as actions from '../../action-types'
import * as types from '../../mutation-types'
import api_feedback from '@/js/api/feedback'

export default {
    async [actions.FILL_UP_FEEDBACK] ({commit, state}) {
        let feedback = await api_feedback.getFeedbackRequests(this);
        commit(types.SET_FEEDBACK, feedback);
    }
}