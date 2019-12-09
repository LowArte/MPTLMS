<template lang="pug">
  v-snackbar(:timeout='snackbarTimeout' :color='snackbarColor' v-model='snackbarShow' :multi-line='true')
    | {{ snackbarText }}
    br
    | {{ snackbarSubtext }}
    v-btn(dark='' text='' @click.native='close')
</template>


<script>
  import { mapGetters } from 'vuex'
  import * as mutations from '../store/mutation-types'

  export default {
    computed: {
      ...mapGetters([
        'snackbarShow',
        'snackbarColor',
        'snackbarText',
        'snackbarSubtext',
        'snackbarTimeout'
      ])
    },
    methods: {
      close () {
        this.$store.commit(mutations.SET_SNACKBAR_SHOW, false)
      }
    }
  }
</script>

<style scoped>
*{
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}
</style>

