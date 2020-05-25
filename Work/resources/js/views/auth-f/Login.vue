<template lang="pug">
  v-row.ma-2(align="center" justify="center")
    v-col.pa-0(justify="center" align="center")
      v-card.pa-0.mx-auto(:elevation="0" max-width="320")
        v-img.mx-auto(:src="loadImg('main-logo.png')" max-width="128px" height="auto")
        v-card-text.pa-0.subtitle-1
          span Один аккаунт. Много возможностей.
        v-form(ref="Login")
          v-text-field.mt-2(outlined dense v-model="email" :rules="emailRules"  label="Email" required v-on:keyup.enter="login") 
          v-text-field(outlined dense v-model="password" :rules="passwordRules" label="Пароль" type="password" required v-on:keyup.enter="login")
          v-card-actions
            router-link(class='nounderline' to="/") 
              v-btn(color="accent" text) ОТМЕНА
            v-spacer
            v-btn(@click="login" color="blue darken-1" text :loading="loading" :disabled="loading") ВОЙТИ
        c-reset-password-sheet
</template>


<script>
import api_user from "@/js/api/user";
import * as mutations from "@/js/store/mutation-types";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import loadImage from "@/js/plugins/loadImage";

//?----------------------------------------------
//!           Компоненты
//?----------------------------------------------
import ResetPasswordSheet_C from "@/js/components/auth-f/ResetPasswordSheet";


export default {
  mixins: [withSnackbar,loadImage],
  data() {
    return {
      loading: false,
      email: "",
      password: "",
      emailRules: [
        v => !!v || "Поле должно быть заполнено корректно",
        v =>
          /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "Не соответствует формату почты"
      ],
      passwordRules: [v => !!v || "Поле должно быть заполнено корректно"]
    };
  },
  components: {
    "c-reset-password-sheet": ResetPasswordSheet_C
  },
  methods: {
    async login() {
      this.loading = true;
      if (this.$refs.Login.validate()) {
        let info = await api_user.login({
          email: this.email,
          password: this.password
        });
        if (typeof(info)!="string") {
          this.$store.commit(mutations.SET_AUTH, info);
          window.axios.defaults.headers.common["Authorization"] =
            "Bearer " + info.token;
          this.$router.addRoutes(info.items);
          this.$router.push("/" + info.slug);
        } 
        else 
          this.showError(info);
      } else this.showError("Поля заполнены не корректно!");
      this.loading = false;
    }
  }
};
</script>