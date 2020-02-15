<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="550px")
        v-card.ma-0.pa-0
          v-card-title.headline 
            h4.text-truncate Редактирование запись
          v-alert.ma-3.px-3(dense type="warning") Будьте внимательны при заполнении данной формы.
          v-form.ma-3.mb-0
            v-card-text
              v-autocomplete.mt-3(v-model="item.post_id" item-value="id" item-text="name" :items="posts" dense label="Роль пользователя")
              v-text-field(v-model="item.thirdName" :rules="famRules" label="Фамилия")
              v-text-field(v-model="item.name" :rules="nameRules" label="Имя")
              v-text-field(v-model="item.secName" label="Отчество")
              v-text-field(v-model="item.email" :rules="emailRules" label="Почта")
              v-dialog(ref="dateDialog" v-model="dateDialog" :return-value.sync="item.birthday" persistent width="290px")
                template(v-slot:activator="{ on }")
                    v-text-field(v-model="item.birthday" label="Дата рождения" readonly v-on="on")
                v-date-picker(v-model="item.birthday" scrollable :first-day-of-week="1" locale="ru-Ru")
                    v-btn(text color="primary" @click="dateDialog = false") Отмена
                    v-btn(text color="primary" @click="$refs.dateDialog.save(item.birthday);") Принять
              v-autocomplete.mt-3(v-model="item.gender" :items="gender" dense label="Гендерная принадлежность")
              v-combobox(v-model="item.disabled" label="Блокировка")
              v-combobox(v-if="item.post_id == 2" v-model="item.dep_name" label="Специальность")
              v-combobox(v-if="item.post_id == 2" v-model="item.group_id" label='Группа')
              v-autocomplete(v-if="item.post_id == 2" v-model="item.type_of_financing" :items="financings" dense label='Вид финансирования')
            v-card-actions
              v-btn(color="red" text @click="clickCancel") Отмена
              v-spacer
              v-btn(color="info" text @click="clickEdit") Удалить
              
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
      departaments: [],
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
        dep_name: null, //! Получать по api
        group_id: 1, //! Получать по api сограсно выбранной специальности
        type_of_financing: "Бюджет",
        disabled: 0
      },
      adisabled: [
        { id: 0, name: "Разблокирован" },
        { id: 1, name: "Заблокирован" }
      ],
      resolve: null,
      emailRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v =>
          /^[^@]+@[^@.]+\.[^@]+$/.test(v) ||
          "Формат текста не соотвествует почте"
      ],
      nameRules: [v => !!v || "Поле не должно оставаться пустым"],
      famRules: [v => !!v || "Поле не должно оставаться пустым"],
      dateDialog: null
    };
  },
  methods: {
    pop(posts, item) {
      this.posts = posts;
      this.item = Object.assign({}, item);
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickEdit() {
      if (
        this.item.name != null &&
        this.item.secName != null &&
        this.item.thirdName != null &&
        this.item.post_id != null &&
        this.item.email != null
      ) {
        this.dialog = false;
        this.resolve(this.item);
      } else {
        this.showInfo("Необходимо заполнить ВСЕ имеющиеся поля");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>