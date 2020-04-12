<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="550px")
        v-card.ma-0.pa-0
          v-card-title.headline 
            h4.text-truncate Редактирование запись
          v-alert.ma-3.px-3(dense type="warning") Будьте внимательны при заполнении данной формы.
          v-form.ma-3.mb-0(ref='form')
            v-card-text
              v-autocomplete.mt-3(v-model="item.post_id" item-value="id" item-text="name" :items="userposts" dense label="Роль пользователя")
              v-text-field(v-model="item.thirdName" :rules="famRules" label="Фамилия")
              v-text-field(v-model="item.name" :rules="nameRules" label="Имя")
              v-text-field(v-model="item.secName" label="Отчество")
              v-text-field(v-model="item.email" :rules="emailRules" label="Почта")
              v-autocomplete(:items="adisabled" item-value='id' item-text='name' value=item v-model="item.disabled" label='Блокировка')
              v-dialog(v-if="item.post_id == 2" ref="dateDialog" v-model="dateDialog" :return-value.sync="item.birthday" persistent width="290px")
                template(v-slot:activator="{ on }")
                    v-text-field(v-model="item.birthday" label="Дата рождения" :rules="birthdayRules" readonly v-on="on")
                v-date-picker(v-model="item.birthday" scrollable :first-day-of-week="1" locale="ru-Ru")
                    v-btn(text color="primary" @click="dateDialog = false") Отмена
                    v-btn(text color="primary" @click="$refs.dateDialog.save(item.birthday);") Принять
              v-autocomplete.mt-3(v-if="item.post_id == 2" v-model="item.gender" :items="gender" :rules="genderRules" dense label="Гендерная принадлежность")
              v-autocomplete(v-if="item.post_id == 2" v-model="item.departament_id" @change="depChange()" :items="specialities_combo" item-text="dep_name_full" no-data-text="Нет данных" item-value="id" label="Отделение")
              v-autocomplete(v-if="item.post_id == 2 && groups_combo != null && item.departament_id != null" v-model="item.group_id" item-text="group_name" no-data-text="Нет данных" item-value="id" :items="groups_combo" label='Группа')
              v-autocomplete(v-if="item.post_id == 2" v-model="item.type_of_financing" no-data-text="Нет данных" :items="financings" dense label='Вид финансирования')
            v-card-actions
              v-btn(color="red" text @click="clickCancel") Отмена
              v-spacer
              v-btn(color="info" text @click="clickEdit") Изменить
              
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import apiposts from "@/js/api/userPosts";
import apidepartments from "@/js/api/departments";
import apigroup from "@/js/api/group";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["specialities_combo", "userposts", "groups_combo"]),
  },
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      financings: ["Бюджет", "Платное"],
      gender: ["Мужской", "Женский", "Другое"],
      steps: 1,
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
        departament_id: null, 
        group_id: 1, 
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
      birthdayRules: [v => !!v || "Поле не должно оставаться пустым"],
      dateDialog: null
    };
  },

  async beforeMount() 
  {
    if (this.specialities_combo == null)
    {
      let items = await apidepartments.getDepartmentsForCombobox(this);
      this.$store.commit(mutations.SET_SPECIALITIES_COMBO,items);
      this.item.departament_id = items[0].id;
    }

    if (this.userposts == null)
    {
      let items = await apiposts.getPostsForCombobox(this);
      this.$store.commit(mutations.SET_USERPOSTS_FULL,items)
    }
  },

  methods: {
    async depChange() 
    {
      if(this.item.departament_id != null)
      {
        let items = await apigroup.getGroupsByDepartamentId(this.item.departament_id, this);
        this.$store.commit(mutations.SET_GROUPS_COMBO,items)
      }
      console.log(this.groups_combo);
    },

    pop(item) {
      this.item = Object.assign({}, item);
      if (this.item.departament_id == null && this.specialities_combo != null)
        this.item.departament_id = this.specialities_combo[0].id;
      if(this.item.departament_id != null)
        depChange();
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickEdit() {
      if (this.$refs.form.validate()) {
        this.dialog = false;
        this.resolve(this.item);
      } else {
        this.showInfo("Необходимо заполнить ВСЕ имеющиеся поля!");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>