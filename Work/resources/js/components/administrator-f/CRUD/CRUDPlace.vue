<template lang="pug">
  div
    c-crud-form(:_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="_places" :_headers="headers" :_title="'Места проведения уч. з.'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api from "../../../api/places";

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
import addDialog_C from "./../components/AddDialogs/C_Place_Add";
import editDialog_C from "./../components/EditDialogs/C_Place_Edit";
import removeDialog_C from "./../components/DeleteDialogs/C_Place_Delite";

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
      { text: "Наименование", value: "place_name" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),

  props: {
    _places: {
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
          api
            .savePlace(result)
            .then(result => {
              this.showMessage("Действие было выполнено успешно");
            })
            .catch(exception => {
              this.showInfo("Действие было отклонено по причине: " + exception);
            });
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
          api
            .editPlace(result)
            .then(result => {
              this.showMessage("Действие было выполнено успешно");
            })
            .catch(exception => {
              this.showInfo("Действие было отклонено по причине: " + exception);
            });
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
          api
            .deletePlace(result)
            .then(result => {
              this.showMessage("Действие было выполнено успешно");
            })
            .catch(exception => {
              this.showInfo("Действие было отклонено по причине: " + exception);
            });
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    }
  }
};
</script>