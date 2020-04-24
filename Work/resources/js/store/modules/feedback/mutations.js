import * as types from '../../mutation-types'

export default {
    [types.SET_FEEDBACK](state, feedback) {
        state.feedback = feedback
    }
}