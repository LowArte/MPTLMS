<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" :_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Места проведения уч. з.'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api from "@/js/api/places";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Подключение шаблона CRUD
//?----------------------------------------------
import CRUD_C from "@/js/views/administrator-f/CRUDpattern";

//?----------------------------------------------
//!           Подключение диалогов CRUD
//?----------------------------------------------
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";
import addDialog_C from "@/js/views/administrator-f/components/AddDialogs/C_Place_Add";
import editDialog_C from "@/js/views/administrator-f/components/EditDialogs/C_Place_Edit";
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_Place_Delite";

export default {
  post_name: {
    name: "CRUD мест проведения",
    url: "places_crud"
  },
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

  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    async update() {
      let data = await api.getPlaces(this);
      return data
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          api.savePlace(result, this);
        } else {
          this.showInfo("Действие отменено пользователем");
        }
      });
    },
    //?----------------------------------------------
    //!           Изменение объекта
    //?----------------------------------------------
    edit(item) {
      this.$refs.revue.pop(item).then(result => {
        if (result) {
          api.editPlace(result, this);
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
          api.dropPlaces(this);
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
          api.deletePlace(item.id, this);
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    }
  }
};
</script>