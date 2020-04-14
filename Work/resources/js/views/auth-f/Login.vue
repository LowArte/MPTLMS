<template lang="pug">
  v-row.ma-2(align="center" justify="center")
    v-col.pa-0(justify="center" align="center")
      v-card.pa-0.mx-auto(:elevation="0" max-width="320")
        v-img.mx-auto(:src="loadImg('main-logo.png')" max-width="128px" height="auto")
        v-card-text.pa-0.subtitle-1
          span Один аккаунт. Много возможностей.
        v-form(ref="Login")
          v-text-field(v-model="email" :rules="emailRules"  label="Email" required)
          v-text-field(v-model="password" :rules="passwordRules" label="Пароль" type="password" required)
          v-card-actions
            router-link(class='nounderline' to="/") 
              v-btn(color="accent" text) ОТМЕНА
            v-spacer
            v-btn(@click="login" color="blue darken-1" text :loading="loading" :disabled="loading") ВОЙТИ
        v-bottom-sheet.pa-3(v-model="sheet" scrollable max-height="300px")
          template(v-slot:activator="{ on }")
            v-btn(text block x-small color="primary font-weight-light" v-on="on") Проблемы со входом?
          v-card.mx-auto(:elevation="0")
            v-card-title.pa-3.font-weight-black Проблемы со входом
            v-card-text
              v-card-text.subtitle-1.pa-0.pb-2.font-weight-medium Для обучающегося
              v-card-text.pa-0 Внимание! Для первого входа в личный кабинет необходимо получит пароль в Центре по работе со студентами. В качесте логина используйте Вашу корпоративную почту. После авторизации Вы можете поменять пароль в личном кабинете.
              v-card-text.pa-0 Если выданный центром пароль не подходит - обратитесь к задеющему отделением или своему куратору.
              v-card-text.subtitle-1.pa-0.py-2.font-weight-medium Нет пароля?
              v-card-text.pa-0 Обратитесь к задеющему отделением или своему куратору - Вам выдадут временный пароль для входа в личный кабинет. При себе необходимо иметь студенческий билет.
              v-card-text.subtitle-1.pa-0.py-2.font-weight-medium Забыли пароль?
              router-link(class='nounderline' to="/password_reset")
                a.ma-0.pa-0.pb-2(color="font-weight-light" style="color: #FE532C; text-decoration: none;") Восстановление пароля на сайте
              v-card-text.pa-0 Либо вы можете обратиться к задеющему отделением или своему куратору или к админестратору сайта (преподавателям)
            v-card-actions
              v-btn(class="mt-6 text-center" text color="red" @click="sheet = !sheet") Закрыть
</template>


<script>
import user_api from "@/js/api/users";
import * as mutations from "@/js/store/mutation-types";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert


export default {
  mixins: [withSnackbar],
  data() {
    return {
      sheet: false,
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
  methods: {
    loadImg: function(path) {
      return require(`@img/${path}`);
    },
    async login() {
      this.loading = true;
      if (this.$refs.Login.validate()) {
        let info = await user_api.login({
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