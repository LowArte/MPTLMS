<template>
  <v-row>
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto" height="auto" width="max">
          <v-form v-model="form">
            <v-container>
              <v-row class="pa-2">
                <v-text-field v-model="FIO" label="Фамилия, Имя, Отчество студента" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="special" label="Специальность" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="group" label="Группа" readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="datebirth" label="Дата рождения" persistent-hint readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field v-model="email" label="E-mail" required readonly></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field :rules="notEmtyRules" v-model="school" label="Школа"></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field
                  :rules="yearMptRules"
                  v-model="yearmpt"
                  v-mask="mask"
                  label="Год поступления в учебное заведение"
                ></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-text-field
                  :rules="notEmtyRules"
                  v-model="postofgroup"
                  label="Обязанности в группе"
                ></v-text-field>
              </v-row>
              <v-row class="pa-2">
                <v-textarea
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
                  :rules="progressRules"
                ></v-textarea>
              </v-row>
              <v-row class="pa-2">
                <v-textarea
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
                  :rules="orderRules"
                ></v-textarea>
              </v-row>
              <v-row class="pa-2 justify-center">
                <v-btn
                  :disabled="!form"
                  class="white--text"
                  color="blue"
                  depressed
                  @click="sendQuery"
                >Заказать</v-btn>
              </v-row>
            </v-container>
          </v-form>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

<script>
import { mask } from "vue-the-mask";
import dataFormater from "../../../utils/dataFormater";
import cerificateApi from "../../../api/certificate";
import withSnackbar from "../../mixins/withSnackbar";

export default {
  directives: {
    mask
  },
  mixins: [withSnackbar],
  data: vm => ({
    mask: "####",
    group: "",
    FIO: user.secName + " " + user.name + " " + user.thirdName,
    modelprogress: "",
    modelorder: "",
    special: "",
    school: "",
    datebirth: "",
    dateendschool: "",
    yearmpt: new Date().getFullYear().toString(),
    email: user.email,
    postofgroup: "",
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
  mounted() {
    let info = JSON.parse(this.info);
    this.special = info.dep.dep_name_full;
    this.group = info.group.group_name;
    this.datebirth = dataFormater(new Date(info.student.birthday));
  },
  props: {
    info: {
      data: String,
      default: null
    }
  },
  methods: {
    sendQuery() {
      cerificateApi
        .save({
          data: {
            "Год поступления": this.yearmpt,
            "Школа": this.school,
            "Обязанности в группе": this.postofgroup,
            "Успеваемость": this.modelprogress,
            "Куда нужна характеристика": this.modelorder
          },
          type: "Характеристика"
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