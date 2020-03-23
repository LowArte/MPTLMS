<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" :_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="_users" :_headers="headers" :_title="'Учетные записи пользователей'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api from "@/js/api/users";

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
import addDialog_C from "@/js/views/administrator-f/components/AddDialogs/C_User_Add";
import editDialog_C from "@/js/views/administrator-f/components/EditDialogs/C_User_Edit";
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_User_Delete";

export default {
  post_name: {
    name: "CRUD пользователей",
    url: "users_crud"
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
    users: [],
    headers: [
      { text: "Почта", value: "email" },
      { text: "Роль", value: "post.name" },
      { text: "Блокировка", value: "disabled" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),

  props: {
    _users: {
      data: Array,
      default: null
    }
  },

  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    update() {
      api
        .getUsers()
        .then(result => {
          this.$refs.crud.refresh(result.data.users);
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
            .saveUser(result)
            .then(result => {
              this.showMessage("Действие было выполнено успешно");
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
    //!           Изменение объекта
    //?----------------------------------------------
    edit(item) {
      this.$refs.revue.pop(item).then(result => {
        if (result) {
          api
            .editUser(result)
            .then(result => {
              this.showMessage("Действие было выполнено успешно!");
            })
            .catch(exception => {
              this.showError(
                "Действие было отклонено в следствии: " + exception
              );
            });
          this.showMessage("Действие было выполнено успешно!");
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
          api
            .dropUsers()
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
    //!           Удаление всех объектa
    //?----------------------------------------------
    remove(item) {
      this.$refs.rem.pop(item).then(result => {
        if (result) {
          api
            .deleteUser(result)
            .then(result => {
              this.showMessage("Действие было выполнено успешно");
            })
            .catch(exception => {
              this.showError(
                "Действие не было выполнено! " + exception
              );
            });
        } else {
          this.showInfo("Действие было отменено пользователем!");
        }
      });
    }
  }
};
</script>