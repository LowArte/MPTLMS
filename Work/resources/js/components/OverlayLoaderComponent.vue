<template lang="pug">
  v-fade-transition
    v-overlay(:value="overlayLoadingShow" style="filter: progid:DXImageTransform.Microsoft.Blur(pixelRadius=5);")
      v-layout(row)
        v-progress-circular.mx-auto(indeterminate size="32")
      v-layout(row)
        span.mx-auto {{ overlayLoadingText }}
</template>

<script>
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["overlayLoadingShow", "overlayLoadingText"])
  }
};
</script>

<style scoped>
* {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
</style>