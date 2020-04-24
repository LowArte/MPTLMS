<template lang="pug">
    v-dialog(v-model="dialog" scrollable persistent max-width="550px")
        v-card.ma-0.pa-0
            v-card-title.headline 
                h4.text-truncate Изменить запись
            v-form(ref='form')
              v-card-text
                v-alert(text dense border="left" colored-border type="warning") <strong>В данной форме</strong> необходимо ввести наименование группы, курс, отделением к которому принадлежит группа и по нужде дополнительную группа. <br>
                v-text-field(v-model="item.group_name" :rules="group_nameRules" label="Название группы")
                v-combobox.my-3(v-model="item.curs" :items="curses" no-data-text="Нет данных" :rules="cursRules" label="Текущий курс" dense)
                v-autocomplete.my-3(:items="specialities"  v-model="item.department_id" item-text="dep_name_full" no-data-text="Нет данных" item-value="id" :rules="specRules" label="Отделение")
                v-autocomplete.my-3(:items="combo_groups" v-model="item.child_id" item-text="group_name" no-data-text="Нет данных" item-value="id" label="Дополнительная группа")      
              v-card-actions              
                  v-btn(color="accent darken-1" text @click="clickCancel") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="clickEdit") Изменить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  mixins: [withSnackbar],
  computed: {
    ...mapGetters(["specialities", "groups"]),
    combo_groups: function() {
      if (!this.groups) return undefined;
      let data = this.groups.filter(res => {
        if (res.id == this.item.id) {
          return false;
        }
        if (res.department_id == this.item.department_id) {
          return true;
        }
        return false;
      });
      data.addToEnd({id: null, group_name: "Пусто"});
      return data;
    }
  },
  data() {
    return {
      dialog: false,
      curses: ["1", "2", "3", "4", "5"],
      item: {
        id: null,
        group_name: null,
        curs: "1",
        department_id: null,
        child_id: null
      },
      resolve: null,
      group_nameRules: [v => !!v || "Поле не должно оставаться пустым"],
      specRules: [v => !!v || "Поле не должно оставаться пустым"],
      cursRules: [v => !!v || "Поле не должно оставаться пустым"]
    };
  },

  methods: {
    pop(item) {
      this.item = JSON.parse(JSON.stringify(item));
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    clickEdit() 
    {
      if (this.$refs.form.validate()) 
      {
        this.dialog = false;
        this.resolve(JSON.parse(JSON.stringify(this.item)));
      } 
      else 
      {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля!");
      }
    },

    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    },
  }
};
</script>