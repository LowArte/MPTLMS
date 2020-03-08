<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" :_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="_departments" :_headers="headers" :_title="'Отделения'")
    c-add-dialog(ref='new')
    c-comfirm-dialog(ref='qwestion')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api from "../../../api/departments"; //api для отделений

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
  props: {
    _departments: {
      type: Array,
      default: null
    }
  },
  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    update() {
      api
        .getDepartments()
        .then(result => {
          this.$refs.crud.refresh(result.data.departments);
        })
        .catch(exception => {
          this.showError("Ошибка обновления! " + exception);
        });
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          api
            .saveDepartment(result)
            .then(res => {
              this.showMessage("Действие было выполнено успешно!");
            })
            .catch(exception => {
              this.showError(
                "Сохранение не было произведено по причине: " + exception
              );
            });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!           Изменение объекта
    //?----------------------------------------------
    edit(item) {
      this.$refs.revue.pop(item).then(result => {
        if (result) {
          api
            .editDepartment(item)
            .then(res => {
              this.showMessage("Действие было выполнено успешно!");
            })
            .catch(exception => {
              this.showError(
                "Сохранение не было произведено по причине: " + exception
              );
            });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление всех объектов
    //?----------------------------------------------
    clear() {
      this.$refs.qwestion.pop().then(result => {
        if (result) {
          api
            .dropDepartments()
            .then(res => {
              this.showMessage("Действие было выполнено успешно!");
            })
            .catch(exception => {
              this.showError("Ошибка выполнения! " + exception);
            });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление объектa
    //?----------------------------------------------
    remove(item) {
      this.$refs.rem.pop(item).then(result => {
        if (result) {
          api
            .deleteDepartment(item.id)
            .then(result => {
              this.showMessage("Действие было выполнено успешно!");
              this.update();
            })
            .catch(exception => {
              this.showError(
                "Удаление не было произведено по причине: " + exception
              );
            });
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    }
  }
};
</script>