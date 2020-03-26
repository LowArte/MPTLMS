<template lang="pug">
    v-container(justify-center class="pt-0 center-block")
      v-card.ma-0.pt-5.pa-5.mx-auto(:elevation="0" style="width: 440px")
        //- v-img.mx-auto.pt-0(src="asset('storage/images/main-logo.png')" max-width="192px" height="auto")
        //- @if ($errors->any())
        //- <v-alert class="my-2" text dense type="error">
        //-     @foreach ($errors->all() as $error)
        //-     <small>{{ $error }}</small>
        //-     @endforeach
        //- </v-alert>
        //- @endif
        v-card-text.pa-0.subtitle-1(justify-center text-center centered)
            center Один аккаунт. Много возможностей.
        v-container(pa-0 text-center)
          v-form(ref="Login")
            v-row
              v-col.pt-0.pb-0(cols="12")
                v-text-field(v-model="email" :rules="emailRules"  label="Email" required)
              v-col.pt-0.pb-0(cols="12")
                v-text-field(min="6" label="Пароль" v-model="password" :rules="passwordRules" name="password" type="password" required)
              div(class="flex")
                router-link(class='nounderline' to="/" active-class="") 
                  v-btn(color="accent"  text) Отмена
                v-btn( @click="login" color="blue darken-1" text) ВОЙТИ
              v-btn.mt-2(color="primary font-weight-light" block text height="25" @click="sheet = !sheet")
                small Проблемы со входом
              v-bottom-sheet(v-model="sheet")
                v-sheet.pa-4()
                  div.mx-auto
                    v-card-title.pa-0.pb-3.font-weight-black Проблемы со входом
                    v-card-text.subtitle-1.pa-0.pb-2.font-weight-medium Для обучающегося
                    v-card-text.pa-0 Внимание! Для первого входа в личный кабинет необходимо получит пароль в Центре по работе со студентами. В качесте логина используйте Вашу корпоративную почту. После авторизации Вы можете поменять пароль в личном кабинете.
                    v-card-text.pa-0 Если выданный центром пароль не подходит - вопользйтесь формой обратной связи, при этом укажите в сообщении вводимые логин и пароль, свои ФИО полностью, дату рождения и группу.
                    v-card-text.subtitle-1.pa-0.py-2.font-weight-medium Нет пароля?
                    v-card-text.pa-0 Обратитесь в Центр по работе со студентами - Вам выдадут временный пароль для входа в личный кабинет. При себе необходимо иметь студенческий билет.
                    v-card-text.subtitle-1.pa-0.py-2.font-weight-medium Забыли пароль?
                    router-link(class='nounderline' to="/password/reset") 
                      a.ma-0.pa-0.pb-2(color="font-weight-light" style="color: #FE532C; text-decoration: none;") Восстановление пароля на сайте
                    v-card-text.pa-0 Либо вы можете обратиться в Центр по работе со студентами или к админестратору сайта (преподавателям)
                  v-spacer
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
      email: "",
      password: "",
      emailRules: [
        v => !!v || "Почта не соответствует требованиям",
        v =>
          /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "Не соответствует формату почты"
      ],
      passwordRules: [v => !!v || "Пароль не соответствует требования"]
    };
  },
  methods: {
    login() {
      if (this.$refs.Login.validate()) {
        user_api
          .login({ email: this.email, password: this.password })
          .then(res => {
            this.$store.commit(mutations.SET_AUTH, res.data);
            let slug = res.data.slug;
            let items = [];
            res.data.routes.forEach(element => {
              if (element.children) {
                element.children.forEach(child => {
                  if (child.component != null)
                    items.push({
                      path: "/" + slug + "/" + child.component.info.url,
                      name: child.component.info.name,
                      component: () =>
                        import(
                          /* webpackChunkName: "[request]" */ `@/${child.component.path}.vue`
                        )
                    });
                });
              } else {
                items.push({
                  path: "/" + slug + "/" + element.component.info.url,
                  name: element.component.info.name,
                  component: () =>
                    import(
                      /* webpackChunkName: "[request]" */ `@/${element.component.path}.vue`
                    )
                });
              }
            });
            this.$router.addRoutes(items);
            this.$router.push("/" + slug);
          })
          .catch(er => {
            this.password = "";
            this.showError("Вход не произведён!");
          });
      } else this.showError("Заполните корректно поля!");
    }
  }
};
</script>