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
                  :clearable="false"
                  :counter="255 ? 255 : false"
                  :filled="false"
                  :flat="true"
                  :hint="'Не более 255 символов'"
                  :label="'Успеваемость'"
                  :loading="false"
                  :no-resize="false"
                  :outlined="false"
                  :persistent-hint="false"
                  :placeholder="''"
                  :rounded="false"
                  :row-height="24"
                  :rows="1"
                  :shaped="false"
                  :single-line="false"
                  :solo="false"
                  :rules="progressRules")
            v-textarea(
                  v-model="modelorder"
                  :auto-grow="true"
                  :clearable="false"
                  :counter="255 ? 255 : false"
                  :filled="false"
                  :flat="true"
                  :hint="'Не более 255 символов'"
                  :label="'Куда нужна характеристика'"
                  :loading="false"
                  :no-resize="false"
                  :outlined="false"
                  :persistent-hint="false"
                  :placeholder="''"
                  :rounded="false"
                  :row-height="24"
                  :rows="3"
                  :shaped="false"
                  :single-line="false"
                  :solo="false"
                  :rules="orderRules")
            v-btn.mt-2.justify-center.white--text(
                  :disabled="!form"
                  color="blue"
                  block
                  depressed
                  @click="sendQuery") Заказать
</template>

<script>
import { mask } from "vue-the-mask";
import cerificateApi from "../../api/certificate";
import withSnackbar from "../mixins/withSnackbar";

export default {
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
    form: false
  }),

  props: 
  {
    _info: {
      data: Object,
      default: null
    }
  },

  methods: 
  {
    sendQuery() 
    {
      cerificateApi
        .save({
          data: {
            "Год поступления": this.yearmpt,
            "Школа": this.school,
            "Обязанности в группе": this.postofgroup,
            "Успеваемость": this.modelprogress,
            "Куда нужна характеристика": this.modelorder
          },
          type: "Характеристика", 
          slug: "student"
        })
        .then(res => {
          this.showMessage("Характеристика сохранена");
          this.cleardata();
        })
        .catch(exp => {
          this.showError("Произошла ошибка");
          this.cleardata();
        });
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