<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" :_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Отделения'")
    c-add-dialog(ref='new')
    c-comfirm-dialog(ref='qwestion')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api from "@/js/api/departments"; //api для отделений

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert

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

export default {
  post_name: {
    name: "CRUD отделений",
    url: "departaments_crud"
  },
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

  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    async update() {
      let data = await api.getDepartments(this);
      return data
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          api.saveDepartment(result, this);
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
          api.editDepartment(item, this);
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
          api.dropDepartments(this);
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
          api.deleteDepartment(item.id, this);
          this.update();
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    }
  }
};
</script>