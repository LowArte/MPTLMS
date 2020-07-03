<template lang="pug">
  div
    c-crud-form(ref='crud' _flood="groups" :_func_upload="upload" :_func_download="download" :_func_update="update" :_func_init="init" :_func_add="add" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Группы'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_group from "@/js/api/group";
import api_department from "@/js/api/department";

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
import addDialog_C from "@/js/views/administrator-f/components/AddDialogs/C_Group_Add";
import editDialog_C from "@/js/views/administrator-f/components/EditDialogs/C_Group_Edit";
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_Group_Delete";

import { mapGetters } from "vuex";
import FileDownload from "js-file-download";

import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  computed: {
    ...mapGetters(["groups"])
  },
  post_name: {
    name: "CRUD групп",
    url: "groups_crud"
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
      { text: "№", value: "id" },
      { text: "Группа", value: "group_name" },
      { text: "Курс", value: "curs" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),
  methods: {
    async beforeMount() {
      if (this.specialities == null) {
        let items = await api_department.getDepartments();
        this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);
      }
    },
    async download() {
      let response = await api_group.exportGroup();
      FileDownload(response.data, "groups.xlsx");
    },
    async upload(result) {
      await api_group.importGroup(result);
      this.update();
    },
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    async init() {
      if (this.groups == null) return this.update();
    },

    async update() {
      this.showLoading("Обновление данных");
      await this.$store.commit(mutations.SET_GROUPS_FULL, await api_group.getGroups());
      this.closeLoading("Обновление данных");
    },

    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    async add() {
      await this.$refs.new.pop().then(result => {
        if (result) {
          this.$store.dispatch(actions.ADD_GROUP, {
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
          this.$store.dispatch(actions.EDIT_GROUP, {
            context: this,
            result: result
          });
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
      this.$refs.revue.$refs.form.reset();
    },
    //?----------------------------------------------
    //!           Удаление всех объектa
    //?----------------------------------------------
    async remove(item) {
      await this.$refs.rem.pop(item).then(result => {
        if (result) {
          this.$store.dispatch(actions.DELETE_GROUP, {
            context: this,
            result: result
          });
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    }
  }
};
</script>