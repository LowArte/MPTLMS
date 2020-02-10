<template lang="pug">
  div
    c-crud-form(:_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="_groups" :_headers="headers" :_title="'Группы'")
    c-comfirm-dialog(ref="qwestion")
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import apidepartments from "../../api/departments"; //api для отделений

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "../mixins/withSnackbar"; //Alert

//?----------------------------------------------
//!           Подключение шаблона CRUD
//?----------------------------------------------
import CRUD_C from "./CRUDpattern";

//?----------------------------------------------
//!           Подключение диалогов CRUD
//?----------------------------------------------
import confirmDialog_C from "./../expention-f/ConfirmDialog";

export default {
  mixins: [withSnackbar],
  components: {
    "c-crud-form": CRUD_C,
    "c-comfirm-dialog": confirmDialog_C
  },
  data: () => ({
    headers: [
      { text: "Группа", value: "group_name" },
      { text: "Курс", value: "сurs" },
      { text: "Действия", value: "action", sortable: false }
    ]
    /*     editedItem: {
      id: -1,
      group_name: "",
      study_period: "",
      arr_type_of_study: "",
      сurs: 1,
      departaments_id: 1
    } //Структура строки */
  }),

  props: {
    _groups: {
      type: Array,
      default: null
    }, //Данные групп
    _departments: {
      type: Array,
      default: null
    }, //Данные отделений
    _slug: {
      type: String,
      default: ""
    } //Модуль
  },

  methods: {
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showError("Действие было отменено");
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
          this.showError("Действие было отменено");
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
          this.showError("Действие было отменено");
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
          this.showError("Действие было отменено");
        }
      });
    }
  }
};
</script>