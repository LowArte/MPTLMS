<template lang="pug">
  v-row.ma-2(align="center" justify="center")
      v-col.pa-0(justify="center" align="center")
        v-card.pa-0.mx-auto(:elevation="0" max-width="320")
          v-img.mx-auto(:src="loadImg('main-logo.png')" max-width="128px" height="auto")
          v-row.ma-2(align="center" justify="center")
            v-card-title.headline() Новый пароль
          v-form(ref="resetPasswordForm")
            v-text-field(v-model="password" :rules="passwordRules" min="8" type="password" label="Пароль" required)
            v-text-field(v-model="passwordConfirmation" :rules="passwordRules" type="password" min="8" label="Подтвердите пароль" required)
          v-card-actions
            router-link(class='nounderline' to="/") 
              v-btn(color="accent" text) На главную
            v-spacer
            v-btn(color="blue darken-1" text :loading="loading" :disabled="loading" @click.native="reset()") Подтвердить
</template>


<script>
import user_api from "@/js/api/user";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert

export default {
  mixins: [withSnackbar],
  data() {
    return {
      loading: false,
      password: "",
      passwordConfirmation: "",
      passwordRules: [
        v => !!v || "Пароль не должен быть пустым",
        v => v.length >= 8 || "Пароль должен быть как минимум 8 символов"
      ]
    };
  },
  
  
  methods: 
  {
    loadImg: function(path) {
      return require(`@img/${path}`);
    },
    async reset() 
    {
      this.loading = true;
      if (this.$refs.resetPasswordForm.validate()) 
      {
        if(await user_api.ResetPassword({
          "password" : this.password,
          "token" : this.$route.params.token,
          "password_confirmation":this.passwordConfirmation,
          "email" : this.$route.params.email}))
          this.$router.push("/");
      }
      else
        this.showError("Заполните корректно поля!");
      this.loading = false;
    }
  },
};
</script>
