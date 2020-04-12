import * as types from '../../mutation-types'

export default {
    [types.SET_USERS_FULL](state, users) {
        state.users_full = users
    },
    add(state,data){
      state.users.unshift(data);
    },
}