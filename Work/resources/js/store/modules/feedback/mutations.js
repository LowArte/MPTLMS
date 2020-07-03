import * as types from '../../mutation-types'

export default {
    [types.SET_FEEDBACK](state, feedback) {
        state.feedback = feedback
    },
    [types.EDIT_ANSWERED](state, id) {
        state.feedback.forEach(element => {
            if (element.id == id) {
                element.answered = 1;
            }
        });
    }
}