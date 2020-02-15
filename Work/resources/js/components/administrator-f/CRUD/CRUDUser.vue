<template lang="pug">
  div
    c-crud-form(:_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="_listusers" :_headers="headers" :_title="'Учетные записи пользователей'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new' :_slug="_slug")
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
//import api from "../../../api/";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "../../mixins/withSnackbar";

//?----------------------------------------------
//!           Подключение шаблона CRUD
//?----------------------------------------------
import CRUD_C from "../CRUDpattern";

//?----------------------------------------------
//!           Подключение диалогов CRUD
//?----------------------------------------------
import confirmDialog_C from "./../../expention-f/ConfirmDialog";
import addDialog_C from "./../components/AddDialogs/C_User_Add";
import editDialog_C from "./../components/EditDialogs/C_Group_Edit";
import removeDialog_C from "./../components/DeleteDialogs/C_Group_Delete";

export default {
  mixins: [withSnackbar],
  components: {
    "c-crud-form": CRUD_C,
    "c-comfirm-dialog": confirmDialog_C,
    "c-add-dialog": addDialog_C,
    "c-edit-dialog": editDialog_C,
    "c-remove-dialog": removeDialog_C
  },
  data: () => ({
    headers: [
      { text: "Почта", value: "email" },
      { text: "Роль", value: "post.name" },
      { text: "Блокировка", value: "text-disabled" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),

  props: {
    _departaments: {
      type: Array,
      default: null
    },
    _listusers: {
      data: Array,
      default: null
    },
    _usersposts: {
      type: Array,
      default: null
    },
    _slug: {
      type: String,
      default: ""
    }
  },

  methods: {
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop(this._usersposts).then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    },
    //?----------------------------------------------
    //!           Изменение объекта
    //?----------------------------------------------
    edit(item) {
      this.$refs.revue.pop(item).then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление всех объектов
    //?----------------------------------------------
    clear() {
      this.$refs.qwestion.pop().then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление всех объектa
    //?----------------------------------------------
    remove(item) {
      this.$refs.rem.pop(item).then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    }
  }
};
</script>