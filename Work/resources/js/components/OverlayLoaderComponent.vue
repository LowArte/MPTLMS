<template lang="pug">
  v-fade-transition
    v-overlay(:value="overlayLoadingShow")
      v-layout(row)
        v-progress-circular.mx-auto(indeterminate size="32")
      v-layout(row)
        span.mx-auto {{ text }}
</template>

<script>
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["overlayLoadingShow", "overlayLoadingText"])
  },
  data() {
    return {
      text: null
    }
  },

  watch: 
  {
    overlayLoadingText:function(val) 
    {
      this.text = this.overlayLoadingText.join(', ');
    },
  }
};
</script>

<style scoped>
* {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
</style>