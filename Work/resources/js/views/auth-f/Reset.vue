<template lang="pug">
v-row.ma-2(align="center" justify="center")
    v-col.pa-0(justify="center" align="center")
        v-card.ma-0.pa-2.mx-auto(:elevation="0" max-width="320")
            v-card-title.px-0
                span.headline Сброс пароля
            v-card-text.py-0.px-0.text-sm-left(text-color="accent") На вашу почту бедет отправлено письмо с подробной инструкцией. Укажите свою почту в поле ниже, и после отправки формы проверьте свою корпоративную почту.
            v-form.ma3(ref="Reset")
                v-text-field(label="E-mail" name="email" :rules="emailRules" required)
                v-card-actions.text-right
                    router-link(class='nounderline' to="/login" active-class="") 
                        v-btn(color="accent"  text) Отмена
                    v-spacer
                    v-btn(text @click="sendQuery()" :loading="loading" :disabled="loading") Отправить
</template>

<script>
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert

export default {
  mixins: [withSnackbar],
  data() {
    return {
      loading: false,
      emailRules: [
        v => !!v || "Поле должно быть заполнено корректно",
        v =>
          /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "Не соответствует формату почты"
      ]
    };
  },

  methods: {
    sendQuery() {
      this.loading = true;
      if (this.$refs.Reset.validate()) {
        this.showMessage("Восстановление пароля прошло успешно");
      } else this.showError("Укажите корректно почту!");
      this.loading = false;
    }
  }
};
</script>