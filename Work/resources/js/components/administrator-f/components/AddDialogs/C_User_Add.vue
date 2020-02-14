<template lang="pug">
    v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition" persistent max-width="550px")
        v-card.ma-0.pa-0
          v-toolbar(color="white")
            v-btn(icon dark @click="dialog = false")
              v-icon(color="primary") mdi-close
            v-spacer
            v-btn(color="info darken-1" text @click="clickSave") Сохранить
          v-form.ma-3
            v-stepper(v-model="steps" vertical)
              v-stepper-step(:complete="steps > 1" step="1") Роль пользователя
                small Тукущая роль: {{ post_name }}
              v-stepper-content(step="1")
                v-card(:elevation="0")
                  v-autocomplete(v-model="item.post_id" item-value="id" item-text="name" :items="posts" label="Роль нового пользователя")
                  v-card-actions
                    v-btn(color="accent" text @click="steps = 2") Далее
              v-stepper-step(:complete="steps > 2" step="2") Биограифческие данные
              v-stepper-content(step="2")
                v-card(class="mb-12" height="200px" :elevation="0")
                  v-text-field(label="sl,fksmdfl")
                  v-autocomplete(v-model="item" :items="adisabled" cache-items flat hide-no-data hide-details label="Какую роль вы хотите выбрать?" solo-inverted)
                  v-card-actions
                    v-btn(color="accent" text @click="steps = 3") Далее
                    v-spacer
                    v-btn(text @click="steps = 1") Назад
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
      post_name: null,
      departaments: [],
      posts: [],
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
        type_of_financing: null,

        disabled: null
      },
      adisabled: ["Разблокирован", "Заблокирован"],
      resolve: null,
      emailRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /.+@.+\..+/.test(v) || "Только буквы в верхнем регистре"
      ],
      nameRules: [v => !!v || "Поле не должно оставаться пустым"],
      famRules: [v => !!v || "Поле не должно оставаться пустым"],
      dateDialog: null
    };
  },
  props: {
    _slug: {
      type: String,
      default: ""
    }
  },
  methods: {
    pop(posts) {
      this.posts = posts;
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickSave() {
      if (
        this.item.group_name != null &&
        this.item.group_number != null &&
        this.item.group_year != null &&
        this.item.departaments_id != null
      ) {
        this.dialog = false;
        this.resolve(this.item);
      } else {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>