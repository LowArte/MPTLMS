<template lang="pug">
  v-layout.row.wrap
    v-col(cols="12")
      v-card.mx-auto.pa-4(height="auto" width="max")
          v-form(v-model="form")
            v-text-field(:rules="notEmtyRules" v-model="school" label="Школа")
            v-text-field(
                  :rules="yearMptRules"
                  v-model="yearmpt"
                  v-mask="mask"
                  label="Год поступления в учебное заведение")
            v-select(
                  :rules="notEmtyRules"
                  v-model="postofgroup"
                  :items="arrPostOfGroup"
                  label="Обязанности в группе")
            v-textarea(
                  v-model="modelprogress"
                  :auto-grow="true"
                  :counter="255 ? 255 : false"
                  :flat="true"
                  :hint="'Не более 255 символов'"
                  :label="'Успеваемость'"
                  :persistent-hint="false"
                  :placeholder="''"
                  :row-height="24"
                  :rows="1"
                  :rules="progressRules")
            v-textarea(
                  v-model="modelorder"
                  :auto-grow="true"
                  :counter="255 ? 255 : false"
                  :flat="true"
                  :hint="'Не более 255 символов'"
                  :label="'Куда нужна характеристика'"
                  :row-height="24"
                  :rows="3"
                  :rules="orderRules")
            v-switch.shrink.mr-2.mt-2(
                  v-model="enabled"
                  color="primary"
                  value="primary"
                  :rules="policyRules"
                  label="Отправляя заявку на характеристику подтверждаю, что с условиями заказа справок ознакомлен")
            v-btn.mt-2.justify-center.white--text(
                  :disabled="!form"
                  color="blue"
                  block
                  depressed
                  @click="sendQuery") Заказать
</template>

<script>
import { mask } from "vue-the-mask";
import cerificateApi from "@/js/api/certificate";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения

export default {
  post_name: {
    name: "Характеристика",
    url: "characteristic"
  },
  directives: {
    mask
  },
  mixins: [withSnackbar],
  data: vm => ({
    mask: "####",
    modelprogress: "",
    modelorder: "",
    school: "",
    dateendschool: "",
    yearmpt: "",
    postofgroup: "",
    arrPostOfGroup: ["Староста", "Ответственный за успеваемость", "Ответственный за посещаемость", "Культ-орг", "Физ-орг", "Студент"],
    notEmtyRules: [v => v.length > 0 || "Поле не заполнено"],
    progressRules: [
      v => v.length > 0 || "Успеваемость не указана",
      v =>
        v.length <= 255 ||
        "Текст успеваемости должен быть не более 255 символов"
    ],
    yearMptRules: [
      v =>(v <= new Date().getFullYear() && v >= new Date().getFullYear() - 4) || "Ошибка даты",
      v => v.length > 0 || "Поле не заполнено"
    ],
    orderRules: [
      v => v.length > 0 || "Текст заявки не указан",
      v => v.length <= 255 || "Текст заявки должен быть не более 255 символов"
    ],
    policyRules: [v => !!v || "Подтвердите!"],
    form: false
  }),

  methods: 
  {
    async sendQuery() 
    {
      if (await cerificateApi.save({
          data: {
            "Год поступления": this.yearmpt,
            "Школа": this.school,
            "Обязанности в группе": this.postofgroup,
            "Успеваемость": this.modelprogress,
            "Куда нужна характеристика": this.modelorder
          },
          type: "Характеристика"
        }, this))
          this.cleardata();
    },

    cleardata() {
      this.yearmpt = new Date().getFullYear().toString();
      this.school = "";
      this.postofgroup = "";
      this.modelprogress = "";
      this.modelorder = "";
    }
  }
};
</script>