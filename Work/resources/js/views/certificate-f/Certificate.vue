<template lang="pug">
v-card.mx-auto.pa-4.mt-2(height="auto" width="max")
    v-form(ref="form")
      v-textarea(
            v-model="text"
            :auto-grow="true"
            :counter="255 ? 255 : false"
            :flat="true"
            :hint="'Не более 255 символов'"
            :label="'Текст заявки'"
            :row-height="24"
            :rows="3"
            :rules="orderRules")
      v-switch.shrink.mr-2.mt-2(
            v-model="enabled"
            color="primary"
            value="primary"
            :rules="policyRules"
            label="Отправляя заявку на справку подтверждаю, что с условиями заказа справок ознакомлен")
      v-btn.mt-2.justify-center.white--text(
            color="blue"
            block
            depressed
            @click="sendQuery") Заказать
</template>

<script>
import api_cerificate from "@/js/api/certificate";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения

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
    policyRules: [v => !!v || "Ожидается согласие на обработку данных"],
    form: false
  }),

  methods: 
  {
    async sendQuery() 
    {
      if(this.$refs.form.validate())
      {
        if (await api_cerificate.save({data: {"Текст заявки": this.text}, type: "Справка"}, this))
          this.$refs.form.reset();
      }
      else 
        this.showError("Укажите корректные данные!");
    },
  }
};
</script>