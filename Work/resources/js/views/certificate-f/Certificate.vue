<template lang="pug">
v-card.mx-auto.pa-4.mt-2(height="auto" width="max")
    v-form(ref="form")
      v-textarea( v-model="text" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Текст заявки" :row-height="24" :rows="3" :rules="orderRules")
      v-switch.shrink.mr-2.mt-2( v-model="enabled" color="primary" value="primary" :rules="policyRules" label="Отправляя заявку на справку я подтверждаю, что с условиями обработки данных ознакомлен")
      v-btn.mt-2.justify-center.white--text( color="blue" block depressed @click="sendQuery") Заказать
</template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение Vuex
//?----------------------------------------------
import { mapActions } from "vuex";

export default {
  post_name: {
    name: "Справки",
    url: "certificate"
  },

  mixins: [withSnackbar],

  data: () => ({
    text: null,
    enabled: false,
    orderRules: [
      v => !!v ||  "Текст заявки не указан",
      v => !!v && v.length <= 255 || "Текст заявки должен быть не более 255 символов"
    ],
    policyRules: [v => !!v || "Ожидается согласие на обработку данных"]
  }),

  methods: 
  {
    async sendQuery() 
    {
      if(this.$refs.form.validate())
      {
        if (await this.$store.dispatch(actions.ADD_СERTIFICATE, {data: {"Текст": this.text}, type: "Справка"})) {
          this.$refs.form.reset();
          this.showInfo("Заявка на выдачу документа отправлена. Ожидайте сообщения на корпоративную почту.");
        } else
          this.showError("Что-то полшло не так. Обратитесь в службу поддрежки. Спасибо.");
      }
      else 
        this.showError("Данные указаны не корректно или одно из полей не заполнено");
    },
  }
};
</script>