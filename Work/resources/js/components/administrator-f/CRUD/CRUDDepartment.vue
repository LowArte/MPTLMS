<template lang="pug">
  div
    c-crud-form(:_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="_departments" :_headers="headers" :_title="'Отделения'")
    c-add-dialog(ref='new')
    c-comfirm-dialog(ref='qwestion')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import apidepartments from "../../../api/departments"; //api для отделений

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "../../mixins/withSnackbar"; //Alert

//?----------------------------------------------
//!           Подключение шаблона CRUD
//?----------------------------------------------
import CRUD_C from "../CRUDpattern";

//?----------------------------------------------
//!           Подключение диалогов CRUD
//?----------------------------------------------
import addDialog_C from "./../components/AddDialogs/C_Department_Add";
import editDialog_C from "./../components/EditDialogs/C_Department_Edit";
import removeDialog_C from "./../components/DeleteDialogs/C_Department_Delete";
import confirmDialog_C from "./../../expention-f/ConfirmDialog";

export default {
  mixins: [withSnackbar],
  data: () => ({
    headers: [
      { text: "Код", value: "dep_name" },
      { text: "Наименование", value: "qualification" },
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
  props: {
    _departments: {
      type: Array,
      default: null
    }
  },
  methods: {
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          apidepartments
            .saveDepartment({ department: result })
            .catch(exception => {
              this.showError(
                "Сохранение не было произведено по причине: " + exception
              );
            });
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
          apidepartments
            .editDepartment({ department: result })
            .catch(exception => {
              this.showError(
                "Сохранение не было произведено по причине: " + exception
              );
            });
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
          apidepartments.dropDepartment();
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
          apidepartments
            .deleteDepartment({ department: result })
            .then(result => {})
            .catch(exception => {
              this.showError(
                "Удаление не было произведено по причине: " + exception
              );
            });
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showError("Действие было отменено");
        }
      });
    }
  }
};
</script>