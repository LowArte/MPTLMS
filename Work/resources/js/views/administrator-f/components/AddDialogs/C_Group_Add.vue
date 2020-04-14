<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="550px")
        v-card.ma-0.pa-0
            v-card-title.headline 
                h4.text-truncate Добавить запись
            v-form(ref='form')
              v-card-text
                v-alert(text dense border="left" colored-border type="warning") <strong>В данной форме</strong> необходимо ввести наименование группы, курс, отделением к которому принадлежит группа и по нужде дополнительную группа. <br>
                v-text-field(v-model="item.group_name" :rules="group_nameRules" label="Название группы")
                v-combobox.my-3(v-model="item.curs" :items="curses" :rules="cursRules" label="Текущий курс" dense)
                v-autocomplete.my-3(:items="specialities" v-model="item.departament_id" item-text="dep_name_full" no-data-text="Нет данных" item-value="id" :rules="specRules" label="Отделение")
                v-autocomplete.my-3(:items="combo_groups" v-model="item.child_id" item-text="group_name" no-data-text="Нет данных" item-value="id" label="Дополнительная группа")      
              v-card-actions              
                  v-btn(color="accent darken-1" text @click="clickCancel") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="clickSave") Сохранить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Подключение api для получения отделений
//?----------------------------------------------
import apiDepartment from "@/js/api/departments";
import group_api from "@/js/api/group"; //Api групп

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  mixins: [withSnackbar],
  computed: {
    ...mapGetters(["specialities", "groups"]),
    combo_groups: function() {
      if (!this.groups) return undefined;
      return this.groups.filter(res => {
        if (res.id == this.item.id) {
          return false;
        }
        if (res.departament_id == this.item.departament_id) {
          return true;
        }
        return false;
      });
    }
  },
  data() {
    return {
      dialog: false,
      curses: ['1', '2', '3', '4', '5'],
      item: {
        group_name: null,
        curs: '1',
        departaments_id: null,
        child_id: null
      },
      resolve: null,
      group_nameRules: [
        v => !!v || "Поле не должно оставаться пустым"],
      specRules: [v => !!v || "Поле не должно оставаться пустым"],
      cursRules: [v => !!v || "Поле не должно оставаться пустым"]
    };
  },

  async beforeMount() 
  {
    if(this.specialities == null)
    {
      let items = await apiDepartment.getDepartments(this);
      this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);
    }
  },

  methods: {
    pop() {
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    clickSave() 
    {
      if (this.$refs.form.validate()) 
      {
        this.dialog = false;
        let data = this.item;
        this.clearForm();
        this.resolve(data);
      } 
      else 
      {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля!");
      }
    },

    clickCancel() 
    {
      this.dialog = false;
      this.clearForm();
      this.resolve(false);
    },

    clearForm()
    {
      this.item.group_name = null;
      this.item.curs = "1";
      this.item.departaments_id = null;
      this.item.child_id = null;
    }
  }
};
</script>