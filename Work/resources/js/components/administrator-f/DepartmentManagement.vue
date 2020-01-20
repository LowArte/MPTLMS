<template lang="pug">
  p {{_departments}}
</template>

<script>
import { mask } from "vue-the-mask"; //маски vue
import withSnackbar from "../mixins/withSnackbar";//Alert

export default {
  mixins: [withSnackbar],
  directives: {
    mask
  },

  props: {
    _departments: {
      type: Array,
      default: null
    }
  },
};
</script>