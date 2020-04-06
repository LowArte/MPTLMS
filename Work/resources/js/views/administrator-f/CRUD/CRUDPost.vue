<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" :_headers="headers" :_title="'Роли'")
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
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_Post_Delite";

export default {
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
    headers: [{ text: "Наименование", value: "name" }]
  }),

  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    async update() {
      let data = await api.getPostsFull();
      return data
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          api.savePost(result);
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
          api.editPost(result);
        } else {
          this.showInfo("Действие отменено пользователем");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление всех объектов
    //?----------------------------------------------
    clear() {
      this.$refs.qwestion.pop().then(result => {
        if (result) {
          api.dropPosts();
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
          api.deletePost(result);
        } else {
          this.showInfo("Действие отменено пользователем");
        }
      });
    }
  }
};
</script>