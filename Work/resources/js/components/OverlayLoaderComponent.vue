<template lang="pug">
  v-fade-transition
    v-overlay(:value="overlayLoadingShow")
      v-layout(row)
        v-progress-circular.mx-auto(indeterminate size="32")
      v-layout(row)
        p.text-center.px-6.py-2 {{ text }}
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
      if(this.overlayLoadingText.length > 0 )
        this.text = this.overlayLoadingText.join(', ');
      else
      {
        this.text = '';
        this.$store.commit(mutations.SET_OVERLAYLOADING_SHOW, false);
      }  
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