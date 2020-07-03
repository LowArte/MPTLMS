import * as actions from '../../action-types'

export default {
    [actions.SET_HISTORY] (state, history) {
        state.history = history;
    },
}
