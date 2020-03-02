<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" :_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="_post" :_headers="headers" :_title="'Роли'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api from "../../../api/userPosts";

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
import addDialog_C from "./../components/AddDialogs/C_Post_Add";
import editDialog_C from "./../components/EditDialogs/C_Post_Edit";
import removeDialog_C from "./../components/DeleteDialogs/C_Post_Delite";

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
      { text: "Наименование", value: "name" },
      { text: "Кодовое наименование", value: "slug" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),

  props: {
    _post: {
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
        .getPosts()
        .then(result => {
          this.$refs.crud.refresh(result.data.posts);
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
            .savePost(result)
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
            .editPost(result)
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
          api
            .dropPosts()
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
            .deletePost(result)
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