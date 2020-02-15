<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.post_id" dense label="Роль пользователя" disabled)
          v-text-field(v-model="item.thirdName" label="Фамилия" disabled)
          v-text-field(v-model="item.name" label="Имя" disabled)
          v-text-field(v-model="item.secName" label="Отчество" disabled)
          v-text-field(v-model="item.email" label="Почта" disabled)
          v-text-field(v-model="item.gender" dense label="Гендерная принадлежность" disabled)
          v-text-field(v-if="item.post_id == 2" v-model="item.dep_name" label="Специальность" disabled)
          v-text-field(v-if="item.post_id == 2" v-model="item.group_id" label='Группа' disabled)
          v-text-field(v-if="item.post_id == 2" v-model="item.type_of_financing" dense label='Вид финансирования' disabled)
        v-card-actions
          v-btn(color="red" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info" text @click="clickDelete") Удалить
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
//import apigroup from "../../../../api/group";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "../../../mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      financings: ["Бюджет", "Платное"],
      posts: [],
      gender: ["Мужской", "Женский", "Другое"],
      groups: [{ id: -1, name: "" }],
      steps: 1,
      item: {
        secName: null,
        name: null,
        thirdName: null,
        email: null,
        password: null,
        post_id: null,
        gender: "Мужской",
        birthday: new Date().toISOString().substr(0, 10),
        dep_name: null,
        group_id: 1,
        type_of_financing: "Бюджет",
        disabled: 0
      },
      resolve: null
    };
  },
  methods: {
    pop(item) {
      this.item = Object.assign({}, item);
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickDelete() {
      this.dialog = false;
      this.resolve(this.item);
      this.item - null;
    },
    clickCancel() {
      this.dialog = false;
      this.item - null;
      this.resolve(false);
    }
  }
};
</script>