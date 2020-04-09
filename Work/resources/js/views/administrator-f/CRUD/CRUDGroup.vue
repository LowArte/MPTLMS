<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" :_func_init="init" :_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Группы'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api from "@/js/api/group";

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
import addDialog_C from "@/js/views/administrator-f/components/AddDialogs/C_Group_Add";
import editDialog_C from "@/js/views/administrator-f/components/EditDialogs/C_Group_Edit";
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_Group_Delete";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["groups"])
  },
  post_name: {
    name: "CRUD групп",
    url: "groups_crud"
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
      { text: "Группа", value: "full_group_name" },
      { text: "Курс", value: "сurs" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),

  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------

    async init() {
      if (this.groups == null)
        return this.update();
      else
        return this.groups;
    },

    async update() {
      let data = await api.getGroups(this);
      return data;
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          api.saveGroup(result, this);
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
          api.editGroup(result, this);
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление всех объектов
    //?----------------------------------------------
    clear() {
      this.$refs.qwestion.pop().then(result => {
        if (result) {
          api.dropGroups(this);
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление всех объектa
    //?----------------------------------------------
    remove(item) {
      this.$refs.rem.pop(item).then(result => {
        if (result) {
          api.deleteGroup(item.id, this);
        } else {
          this.showInfo("Действие отменено пользователем");
        }
      });
    }
  }
};
</script>