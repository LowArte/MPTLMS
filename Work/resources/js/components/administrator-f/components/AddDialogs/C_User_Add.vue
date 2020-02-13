<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="550px")
        v-card.ma-0.pa-0
            v-card-title.headline 
                h4.text-truncate Добавить запись
            v-form
              v-card-text
                v-text-field(v-model="item.thirdName" :rules="famRules" label="Фамилия")
                v-text-field(v-model="item.name" :rules="nameRules" label="Имя")
                v-text-field(v-model="item.secName" label="Отчество")
                v-text-field(v-model="item.email" :rules="emailRules" label="Почта")
                v-autocomplete(v-model="item.post_id" :items="posts" item-value='id' item-text='name' dense solo label='Роль')
                v-autocomplete(v-model="item.disabled" :items="adisabled" dense solo label='Блокировка')

                v-combobox(v-if="item.post_id==2" :items="groups" item-value='id' item-text='group_name' label='Специальность')
                v-combobox(v-if="item.post_id==2" :items="groups" item-value='id' item-text='group_name' label='Группа')
                v-dialog(v-if="item.post_id==2" ref="dateDialog" v-model="dateDialog" :return-value.sync="studentItem.group" persistent width="290px")
                  template(v-slot:activator="{ on }")
                      v-text-field(v-model="studentItem.group" label="Дата" readonly v-on="on")
                  v-date-picker(v-model="studentItem.group" scrollable :first-day-of-week="1" locale="ru-Ru")
                      v-btn(text color="primary" @click="dateDialog = false") Отмена
                      v-btn(text color="primary" @click="$refs.dateDialog.save(studentItem.group);") Принять
                v-radio-group(v-if="item.post_id==2" v-model="studentItem.gender" :mandatory="false")
                  v-radio(label="Мужской" value="Мужской")
                  v-radio(label="Женский" value="Женский")
                v-autocomplete(v-if="item.post_id==2" :items="arrfinancings" v-model="studentItem.type_of_financing" dense solo label='Вид финансирования')
              v-card-actions              
                  v-btn(color="accent darken-1" text @click="clickCancel") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="clickSave") Сохранить
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import apigroup from "../../../../api/group";

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
      posts: [],
      groups: [{ id: -1, name: "" }],
      item: {
        secName: "",
        name: "",
        thirdName: "",
        email: "",
        password: "",
        post_id: "",
        gender: "Мужской",
        birthday: new Date().toISOString().substr(0, 10),

        dep_name: "",
        group_id: 1,
        type_of_financing: "",

        disabled: ""
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
      group_api
        .getGroup(departaments_info.selected)
        .then(res => {
          this.groups_info.groups = res.data.groups;
          this.studentItem.group_id = this.groups_info.groups[0].id;
        })
        .catch(ex => {
          this.showError(ex);
        });
      groups.forEach(element => {
        this.groups.id = element.id;
      });
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