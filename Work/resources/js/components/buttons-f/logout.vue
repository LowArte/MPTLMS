<template lang="pug">
    v-btn.ma-1(@click="logout()" block text primary ) ВЫХОД
</template>

<script>
import user_api from "@/js/api/users";
import { resetRouter } from "@/js/router/router";
import * as mutations from "@/js/store/mutation-types";

export default {
  methods: {
    logout() {
      user_api.logout();
    }
  }
};
</script>