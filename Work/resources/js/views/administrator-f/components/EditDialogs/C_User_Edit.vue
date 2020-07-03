<template lang="pug">
    v-dialog(v-model="dialog" scrollable persistent max-width="500px")
      v-card.ma-0.pa-0
        v-card-title.headline 
          h4.text-truncate Редактирование запись
        v-alert.ma-3.px-3(dense type="warning") Будьте внимательны при заполнении данной формы.
        v-card-text
          v-form.ma-3.mb-0(ref='form')
            v-autocomplete.mt-3(v-model="item.post_id" item-value="id" item-text="name" :items="userposts" dense label="Роль пользователя")
            v-text-field(v-model="item.secName" :rules="famRules" label="Фамилия")
            v-text-field(v-model="item.name" :rules="nameRules" label="Имя")
            v-text-field(v-model="item.thirdName" label="Отчество")
            v-text-field(v-model="item.email" :rules="emailRules" label="Почта" readonly)
            v-autocomplete(:items="adisabled" no-data-text="Нет данных" item-value='id' item-text='name' value=item v-model="item.disabled" label='Блокировка')
            v-dialog(v-if="item.post_id == 2" ref="dateDialog" v-model="dateDialog" :return-value.sync="item.birthday" persistent width="290px")
              template(v-slot:activator="{ on }")
                  v-text-field(v-model="studentItem.birthday" label="Дата рождения" :rules="birthdayRules" readonly v-on="on")
              v-date-picker(v-model="item.birthday" scrollable :first-day-of-week="1" locale="ru-Ru")
                  v-btn(text color="primary" @click="dateDialog = false") Отмена
                  v-btn(text color="primary" @click="$refs.dateDialog.save(studentItem.birthday);") Принять
            v-autocomplete.mt-3(v-if="item.post_id == 2" v-model="studentItem.gender" :items="gender" :rules="genderRules" no-data-text="Нет данных" dense label="Пол")
            v-autocomplete(v-if="item.post_id == 2 && groups != null" v-model="studentItem.group_id" item-text="group_name" no-data-text="Нет данных" item-value="id" :items="groups" label='Группа')
            v-autocomplete(v-if="item.post_id == 2" v-model="studentItem.type_of_financing" no-data-text="Нет данных" :items="financings" dense label='Вид финансирования')
        v-card-actions
          v-btn(color="red" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info" text @click="clickEdit") Изменить
              
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_post from "@/js/api/userPost";
import api_department from "@/js/api/department";
import api_group from "@/js/api/group";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["specialities", "userposts", "groups"]),
  },
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      financings: ["Бюджет", "Платное"],
      gender: ["Мужской", "Женский", "Другое"],
      steps: 1,
      item: {
        secName: null,
        name: null,
        thirdName: null,
        email: null,
        password: null,
        post_id: null,
        disabled: 0
      },

      studentItem:{
        gender: "Мужской",
        birthday: new Date().toISOString().substr(0, 10),
        department_id: null,
        group_id: 1,
        type_of_financing: "Бюджет",
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
      birthdayRules: [v => !!v || "Поле не должно оставаться пустым"],
      dateDialog: null
    };
  },

  methods: {
    async depChange() 
    {
      if(this.item.department_id != null)
      {
        let items = await api_group.getGroupsByDepartmentId(this.item.department_id);
        this.$store.commit(mutations.SET_GROUPS_COMBO,items)
      }
    },

    pop(item) 
    {
      this.item = JSON.parse(JSON.stringify(item));
      if(this.item.student)
        this.studentItem = this.item.student;
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickEdit() {
      if (this.$refs.form.validate()) 
      {
        this.dialog = false;
        if(this.item.post_id == 2)
          this.item['student'] = this.studentItem;
        this.resolve(JSON.parse(JSON.stringify(this.item)));
      } 
      else 
      {
        this.showInfo("Необходимо заполнить ВСЕ имеющиеся поля!");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    },
  }
};
</script>