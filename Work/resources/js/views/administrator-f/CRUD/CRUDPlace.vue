<template lang="pug">
  div
    c-crud-form(ref='crud' _flood="places" :_func_upload="upload" :_func_download="download" :_func_update="update" :_func_init="init" :_func_add="add" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Места проведения уч. з.'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_place from "@/js/api/place";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

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
import FileDownload from "js-file-download";

import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  computed: {
    ...mapGetters(["places"])
  },
  post_name: {
    name: "CRUD мест проведения",
    url: "places_crud"
  },
  mixins: [withSnackbar, withOverlayLoading],
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
      if (this.places == null) return this.update();
    },
    async download() {
      let response = await api_place.exportPlace();
      FileDownload(response.data, "places.xlsx");
    },
    async upload(result) {
      await api_place.importPlace(result);
      this.update();
    },
    async update() {
      this.showLoading("Обновление данных");
      await this.$store.commit(
        mutations.SET_PLACES_FULL,
        await api_place.getPlaces()
      );
      this.closeLoading("Обновление данных");
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    async add() {
      await this.$refs.new.pop().then(result => {
        if (result) {
          this.$store.dispatch(actions.ADD_PLACE, {
            context: this,
            result: result
          });
        } else {
          this.showInfo("Действие отменено пользователем!");
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
          this.$store.dispatch(actions.EDIT_PLACE, {
            context: this,
            result: result
          });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
      this.$refs.revue.$refs.form.reset();
    },
    //?----------------------------------------------
    //!           Удаление объектa
    //?----------------------------------------------
    async remove(item) {
      await this.$refs.rem.pop(item).then(result => {
        if (result) {
          this.$store.dispatch(actions.DELETE_PLACE, {
            context: this,
            result: result
          });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
    }
  }
};
</script>