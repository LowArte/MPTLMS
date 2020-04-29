<template lang="pug">
  v-btn(@click="logout()" text :loading="loading" :disabled="loading" icon small)
    v-icon mdi-location-exit
</template>

<script>
import api_user from "@/js/api/user";
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
      if (await api_user.logout()) {
        resetRouter();
        this.$store.commit(mutations.SET_NOTAUTH);
        await this.$router.push("/");
        location.reload();
      }
      this.loading = false;
    }
  } 
};
</script>