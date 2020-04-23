<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" _flood="specialities" :_func_init="init" :_func_add="add" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Отделения'")
    c-add-dialog(ref='new')
    c-comfirm-dialog(ref='qwestion')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_department from "@/js/api/department"; //api для отделений

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

//?----------------------------------------------
//!           Подключение шаблона CRUD
//?----------------------------------------------
import CRUD_C from "@/js/views/administrator-f/CRUDpattern";

//?----------------------------------------------
//!           Подключение диалогов CRUD
//?----------------------------------------------
import addDialog_C from "@/js/views/administrator-f/components/AddDialogs/C_Department_Add";
import editDialog_C from "@/js/views/administrator-f/components/EditDialogs/C_Department_Edit";
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_Department_Delete";
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  computed: {
    ...mapGetters(["specialities"]),
  },
  post_name: {
    name: "CRUD отделений",
    url: "departments_crud"
  },
  mixins: [withSnackbar, withOverlayLoading],
  data: () => ({
    headers: [
      { text: "Наименование", value: "dep_name_full" },
      { text: "Квалификация", value: "qualification" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),
  components: {
    "c-crud-form": CRUD_C,
    "c-add-dialog": addDialog_C,
    "c-comfirm-dialog": confirmDialog_C,
    "c-edit-dialog": editDialog_C,
    "c-remove-dialog": removeDialog_C
  },

  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    async init() {
      if (this.specialities == null) 
        await this.update();
    },

    async update() {
      this.showLoading("Обновление данных");
      await this.$store.commit(mutations.SET_SPECIALITIES_FULL, await api_department.getDepartments(this));
      this.closeLoading("Обновление данных");
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    async add() {
      await this.$refs.new.pop().then(result => {
        if (result) {
          this.$store.dispatch(actions.ADD_SPECIALITIE,{ context: this, result: result });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
      this.$refs.new.$refs.form.reset();
    },
    //?----------------------------------------------
    //!           Изменение объекта
    //?----------------------------------------------
    async edit(item) {
      await this.$refs.revue.pop(item).then(result => {
        if (result) {
          this.$store.dispatch(actions.EDIT_SPECIALITIE,{ context: this, result: result });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
      this.$refs.revue.$refs.form.reset();
    },
    //?----------------------------------------------
    //!           Удаление объектa
    //?----------------------------------------------
    remove(item) {
      this.$refs.rem.pop(item).then(result => {
        if (result) {
          this.$store.dispatch(actions.DELETE_SPECIALITIE,{ context: this, result: result });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
    }
  }
};
</script>