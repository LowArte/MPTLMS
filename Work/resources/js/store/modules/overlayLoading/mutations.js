import * as types from '../../mutation-types'

export default {
  [ types.SET_OVERLAYLOADING_SHOW ] (state, show) {
    state.show = show
  },
  [ types.SET_OVERLAYLOADING_TEXT ] (state, text) {
    state.text = text
  },
}
