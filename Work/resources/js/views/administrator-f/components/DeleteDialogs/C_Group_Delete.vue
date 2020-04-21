<template lang="pug">
  v-dialog(v-model="dialog" persistent scrollable max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.group_name" label="Название группы" readonly)
          v-text-field(v-model="item.curs" label="Текущий курс" dense readonly)
          v-autocomplete.my-3(:items="specialities" v-model="item.departament_id" item-text="dep_name_full" no-data-text="Нет данных" item-value="id" readonly label="Отделение")
          v-autocomplete.my-3(:items="groups" v-model="item.child_id" item-text="group_name" no-data-text="Нет данных" item-value="id" readonly label="Дополнительная группа")
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickDel") Удалить
</template>

<script>
import apiDepartment from "@/js/api/departments";
import group_api from "@/js/api/group"; //Api групп

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["specialities", "groups"]),
  },
  data() {
    return {
      dialog: false,
      item: {
        id:null,
        group_name: null,
        curs: "1",
        departament_id: null,
        child_id: null
      },
      resolve: null
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
    pop(item) {
      this.item = JSON.parse(JSON.stringify(item));
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    clickDel() {
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
      this.item.group_name = null;
      this.item.curs = "1";
      this.item.departaments_id = null;
      this.item.child_id = null;
    }
  }
};
</script>