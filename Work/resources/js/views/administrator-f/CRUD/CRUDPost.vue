<template lang="pug">
  div
    c-crud-form(ref='crud' _flood="userposts" :_func_update="update" :_func_init="init" :_func_add="add" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Роли'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api from "@/js/api/userPosts";

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
import addDialog_C from "@/js/views/administrator-f/components/AddDialogs/C_Post_Add";
import editDialog_C from "@/js/views/administrator-f/components/EditDialogs/C_Post_Edit";
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_Post_Delete";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["userposts"])
  },
  post_name: {
    name: "CRUD роли",
    url: "posts_crud"
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
      { text: "Наименование", value: "name" },
      { text: "Действия", value: "action", sortable: false }
    ],
  }),

  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    async init() {
      if (this.userposts == null)
        return this.update();
    },

    async update() {
      let items = await api.getPostsForManagement(this);
      this.$store.commit(mutations.SET_USERPOSTS_FULL, items)
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          this.$store.dispatch(mutations.ADD_USERPOST,{ context: this, result: result });
          this.$refs.new.clearForm();
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
          this.$store.dispatch(mutations.EDIT_USERPOST,{ context: this, result: result });
          this.$refs.revue.clearForm();
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление объектa
    //?----------------------------------------------
    remove(item) {
      this.$refs.rem.pop(item).then(result => {
        if (result) {
          this.$store.dispatch(mutations.DELETE_USERPOST,{ context: this, result: result });
          this.$refs.rem.clearForm();
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    }
  }
};
</script>