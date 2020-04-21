<template lang="pug">
  v-dialog(v-model="dialog" persistent scrollable max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.post_id" dense label="Роль пользователя" readonly)
          v-text-field(v-model="item.thirdName" label="Фамилия" readonly)
          v-text-field(v-model="item.name" label="Имя" readonly)
          v-text-field(v-model="item.secName" label="Отчество" readonly)
          v-text-field(v-model="item.email" label="Почта" readonly)
          v-text-field(v-model="item.gender" dense label="Гендерная принадлежность" readonly)
          v-text-field(v-if="item.post_id == 2" v-model="item.dep_name" label="Специальность" readonly)
          v-text-field(v-if="item.post_id == 2" v-model="item.group_id" label='Группа' readonly)
          v-text-field(v-if="item.post_id == 2" v-model="item.type_of_financing" dense label='Вид финансирования' readonly)
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

export default {
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
      this.resolve(this.item.id);
    },
    clickCancel() {
      this.dialog = false;
      this.clearForm();
      this.resolve(false);
    },

    clearForm()
    {
      this.item.secName = null;
      this.item.name = null;
      this.item.thirdName = null;
      this.item.email = null;
      this.item.password = null;
      this.item.post_id = null;
      this.item.disabled = 0;

      this.item.studentItem.gender = "Мужской";
      this.item.studentItem.birthday = new Date().toISOString().substr(0, 10);
      this.item.studentItem.departament_id = null;
      this.item.studentItem.group_id = 1;
      this.item.studentItem.type_of_financing = "Бюджет";
    }
  }
};
</script>