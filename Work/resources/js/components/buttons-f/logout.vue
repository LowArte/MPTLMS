<template lang="pug">
  v-btn(@click="logout()" block text :loading="loading" :disabled="loading" color="accent" ) ВЫХОД
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
      if (await api_user.logout()) 
      {
        resetRouter();
        this.$store.commit(mutations.SET_NOTAUTH);
        location.href = '/';
      }
      this.loading = false;
    }
  }
};
</script>