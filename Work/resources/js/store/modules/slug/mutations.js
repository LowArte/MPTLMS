import * as types from '../../mutation-types'

export default {
  [ types.SET_SLUG ] (state, slug) {
    state.slug = slug
  }
}
