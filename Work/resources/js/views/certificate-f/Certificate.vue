<template lang="pug">
  v-layout.row.wrap
    v-col(cols="12")
      v-card.mx-auto.pa-4(height="auto" width="max")
          v-form(v-model="form")
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
                  :disabled="!form"
                  color="blue"
                  block
                  depressed
                  @click="sendQuery") Заказать
</template>

<script>
import cerificateApi from "@/js/api/certificate";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения

export default {
  post_name: {
    name: "Справки",
    url: "certificate"
  },
  mixins: [withSnackbar],
  data: () => ({
    text: "",
    enabled: false,
    orderRules: [
      v => v.length > 0 || "Текст заявки не указан",
      v => v.length <= 255 || "Текст заявки должен быть не более 255 символов"
    ],
    policyRules: [v => !!v || "Подтвердите!"],
    form: false
  }),

  methods: {
    sendQuery() {
      if (cerificateApi.save({
          data: { "Текст заявки": this.text },
          type: "Справка"
        }))
          this.cleardata();        
    },
    cleardata() {
      this.text = "";
      this.enabled = false;
    }
  }
};
</script>