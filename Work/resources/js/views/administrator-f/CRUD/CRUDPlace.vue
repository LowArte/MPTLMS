<template lang="pug">
  div
    c-crud-form(ref='crud' _flood="places" :_func_update="update" :_func_init="init" :_func_add="add" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Места проведения уч. з.'")
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
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_Place_Delete";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["places"])
  },
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
    async init() {
      if (this.places == null)
        return this.update();
    },

    async update() {
      let items = await api.getPlaces(this);
      this.$store.commit(mutations.SET_PLACES_FULL, items)
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          this.$store.dispatch(mutations.ADD_PLACE,{ context: this, result: result });
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!           Изменение объекта
    //?----------------------------------------------
    edit(item) {
      this.$refs.revue.pop(item).then(result => {
        if (result) {
          this.$store.dispatch(mutations.EDIT_PLACE,{ context: this, result: result });
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
          this.$store.dispatch(mutations.DELETE_PLACE,{ context: this, result: result });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
    }
  }
};
</script>