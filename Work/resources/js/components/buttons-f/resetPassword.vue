<template lang="pug">
  v-btn(@click="reset()" block text :loading="loading" :disabled="loading" color="info" ) Сменить пароль
</template>

<script>
import api_user from "@/js/api/user";
import { resetRouter } from "@/js/router/router";
import * as mutations from "@/js/store/mutation-types";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import {mapGetters} from 'vuex'

export default {
  computed: {
    ...mapGetters(["user"])
  },
  mixins: [withSnackbar],
  data() {
    return {
      loading: false
    };
  },

  methods: {
    async reset() 
    {
      this.loading = true;
      if (await api_user.EmailForResetPassword(this.user.email)) 
      {
        this.showMessage("Отправлено на почту!");
      }
      else
        this.showError("Ошибка выполнения!");
      this.loading = false;
    }
  }
};
</script>