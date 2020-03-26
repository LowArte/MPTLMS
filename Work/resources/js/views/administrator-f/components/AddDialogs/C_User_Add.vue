<template lang="pug">
    v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition" persistent max-width="550px")
        v-card.ma-0.pa-0
          v-toolbar(color="white")
            v-btn(icon dark @click="clickCancel")
              v-icon(color="primary") mdi-close
            v-spacer
            v-btn(color="info darken-1" text @click="clickSave") Отправить
          v-card-title.headline 
            h4.text-truncate Новый запись
          v-alert.ma-3.px-3(dense type="info") В любой момент данные, внесённые в поля, можно изменить, нажав на соотвествующий пункт ниже.
          v-alert.ma-3.px-3(dense type="warning") Будьте внимательны при заполнении данной формы.
          v-form.ma-3(ref='form')
            v-stepper(v-model="steps" vertical)
              v-stepper-step(:complete="steps > 1" step="1" @click="change(1)") Роль пользователя
                small Текущая роль: {{ post_name.name }}
              v-stepper-content(step="1")
                v-card(:elevation="0")
                  v-autocomplete.mt-3(v-model="item.post_id" item-value="id" item-text="name" :items="posts" dense label="Роль нового пользователя" @change="changePost")
                  v-card-actions
                    v-spacer
                    v-btn(v-if="post_name.id != null" color="accent" text @click="change(2)") Далее
              v-stepper-step(:complete="steps > 2" step="2" @click="change(2)") Биографические данные
              v-stepper-content(step="2")
                v-card(:elevation="0")
                  v-text-field(v-model="item.thirdName" :rules="famRules" label="Фамилия")
                  v-text-field(v-model="item.name" :rules="nameRules" label="Имя")
                  v-text-field(v-model="item.secName" label="Отчество")
                  v-text-field(v-model="item.email" :rules="emailRules" label="Почта")
                  v-card-actions
                    v-btn(text @click="change(1)") Назад
                    v-spacer
                    v-btn(color="accent" text @click="change(3)") Далее
              v-stepper-step(v-if="item.post_id == 2" :complete="steps > 3" step="3" @click="change(3)") Дополнительно
              v-stepper-content(v-if="item.post_id == 2" step="3")
                v-card(:elevation="0")
                  v-dialog(v-if="item.post_id == 2" ref="dateDialog" v-model="dateDialog" :return-value.sync="item.birthday" persistent width="290px")
                    template(v-slot:activator="{ on }")
                        v-text-field(v-model="item.birthday" label="Дата рождения" :rules="birthdayRules" readonly v-on="on")
                    v-date-picker(v-model="item.birthday" scrollable :first-day-of-week="1" locale="ru-Ru")
                        v-btn(text color="primary" @click="dateDialog = false") Отмена
                        v-btn(text color="primary" @click="$refs.dateDialog.save(item.birthday);") Принять
                  v-autocomplete.mt-3(v-if="item.post_id == 2" v-model="item.gender" :items="gender" :rules="genderRules" dense label="Гендерная принадлежность")
                  v-combobox(v-if="item.post_id == 2" v-model="item.dep_name" :items="departaments" label="Отделение")
                  v-combobox(v-model="item.group_id" item-value="id" item-text="group_name" :items="groups" label='Группа')
                  v-autocomplete(:items="financings" dense label='Вид финансирования')
                  v-card-actions
                    v-btn(text @click="change(2)") Назад
                    v-spacer
                    v-btn(color="accent" text @click="change(4)") Применить
              v-alert.mx-3.px-3(v-if="steps == 4" dense type="success") Действия были применены. Чтобы отправить форму нажмите "Отправить" в заголовке формы.
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import apiposts from "@/js/api/userPosts";
import apigroup from "@/js/api/group";
import apidepartments from "@/js/api/departments";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      post_name: [{ name: "", id: null }],
      departaments: [],
      financings: ["Бюджет", "Платное"],
      posts: [],
      gender: ["Мужской", "Женский", "Другое"],
      groups: [],
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
        dep_id: null, //! Получать по api
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
      genderRules: [v => !!v || "Поле не должно оставаться пустым"],
      dateDialog: null
    };
  },
  mounted() {
    apidepartments
      .getDepartments()
      .then(result => {
        this.departaments = result.data;
      })
      .catch(exception => {
        this.showInfo("Данные не получены! " + exception);
      });
    apiposts
      .getPostsFull()
      .then(result => {
        this.posts = result.data.posts;
      })
      .catch(exception => {
        this.showInfo("Данные не получены! " + exception);
      });
  },
  depChange() {
    apigroup
      .getGroupsByDepartamentId(this.item.dep_id)
      .then(result => {
        this.groups = result.data.groups_info.groups;
      })
      .catch(exception => {
        this.showError(exception);
      });
  },
  methods: {
    pop() {
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickSave() {
      if (this.$refs.form.validate()) 
      {
        this.dialog = false;
        this.resolve(this.item);
        this.item = Object.assign({}, null);
      } else {
        this.showInfo("Необходимо заполнить ВСЕ имеющиеся поля!");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.item = Object.assign({}, null);
      this.resolve(false);
    },
    changePost() {
      this.post_name = this.posts[this.item.post_id - 1];
    },
    change(id) {
      switch (id) {
        case 1:
          this.steps = 1;
          break;
        case 2:
          if (this.post_name.id != null) this.steps = 2;
          break;
        case 3:
          if (this.post_name.id != null && this.post_name.id == 2)
            this.steps = 3;
          else this.steps = 4;
          break;
        case 4:
          if (this.post_name.id != null) this.steps = 4;
          break;
        default:
          break;
      }
    }
  }
};
</script>