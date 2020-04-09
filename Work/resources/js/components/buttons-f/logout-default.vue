<template lang="pug">
  v-btn(@click="logout()" text :loading="loading" :disabled="loading" icon small)
    v-icon mdi-location-exit
</template>

<script>
import user_api from "@/js/api/users";
import { resetRouter } from "@/js/router/router";
import * as mutations from "@/js/store/mutation-types";

export default {
  data() {
    return {
      loading: false
    };
  },

  methods: {
    async logout() {
      this.loading = true;
      if (await user_api.logout()) {
        resetRouter();
        this.$store.commit(mutations.SET_NOTAUTH);
        this.$router.push("/");
      }
      this.loading = false;
    }
  } 
};
</script>