<template lang="pug">
    v-btn( @click="logout" ) ВЫХОД
</template>

<script>
import user_api from "@/js/api/users";
import { resetRouter } from "@/js/router/router";
import * as mutations from "@/js/store/mutation-types";

export default {
  methods: {
    logout() {
      user_api
        .logout()
        .then(res => {
          resetRouter();
          this.$store.commit(mutations.SET_NOTAUTH)
          this.$router.push("/")
        })
        .catch(ex => {});
    }
  }
};
</script>