<template lang="pug">
  v-overlay(:value="overlayLoadingShow")
    v-layout(row)
      v-progress-circular(indeterminate size="32")
    v-layout(row)
      span {{ overlayLoadingText }}
</template>

<script>
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters([
      "overlayLoadingShow",
      "overlayLoadingText",
    ])
  },
};
</script>

<style scoped>
* {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
</style>