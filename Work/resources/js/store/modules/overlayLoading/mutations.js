import * as types from '../../mutation-types'

export default {
  [ types.SET_OVERLAYLOADING_SHOW ] (state, show) {
    state.show = show
  },
  [ types.SET_OVERLAYLOADING_TEXT ] (state, text) {
    state.text.push(text);
  },
  [ types.SET_OVERLAYLOADING_TEXT_DELETE ] (state, text) {
    let index = state.text.indexOf(text) + 1; 
    if (index >= 0)
      state.text = state.text.splice(index, 1);
  },
}