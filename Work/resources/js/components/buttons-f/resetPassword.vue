<template lang="pug">
  v-btn(@click="reset()" block text :loading="loading" :disabled="loading" color="info" ) Сменить пароль
</template>

<script>
import user_api from "@/js/api/users";
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
      if (await user_api.EmailForResetPassword(this.user.email, this)) 
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