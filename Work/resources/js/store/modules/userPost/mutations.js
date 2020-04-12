import * as types from '../../mutation-types'

export default {
    [types.SET_USERPOSTS_FULL](state, userposts) {
        state.userposts_full = userposts
    },
    add(state,data){
      state.userposts.unshift(data);
    },
}