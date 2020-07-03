<template lang="pug">
  v-dialog(v-model="dialog" persistent scrollable max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-card-text
        v-form
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.post_id" dense label="Роль пользователя" readonly)
          v-text-field(v-model="item.secName" label="Фамилия" readonly)
          v-text-field(v-model="item.name" label="Имя" readonly)
          v-text-field(v-model="item.thirdName" label="Отчество" readonly)
          v-text-field(v-model="item.email" label="Почта" readonly)
          v-text-field(v-if="item.post_id == 2" v-model="item.student.gender" dense label="Пол" readonly)
          v-autocomplete(v-if="item.post_id == 2 && groups != null" v-model="item.student.group_id" item-text="group_name" no-data-text="Нет данных" item-value="id" :items="groups" label='Группа' readonly)
          v-text-field(v-if="item.post_id == 2" v-model="item.student.type_of_financing" dense label='Вид финансирования' readonly)
      v-card-actions
        v-btn(color="red" text @click="clickCancel") Отмена
        v-spacer
        v-btn(color="info" text @click="clickDelete") Удалить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["groups"]),
  },
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      item: {
        id: null,
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
      this.resolve([this.item.id, this.item.post_id]);
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    },
  }
};
</script>