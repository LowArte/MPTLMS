<template lang="pug">
  div
    c-crud-form(ref='crud' _flood="users" :_func_reset_password="reset_password" :_func_update="update" :_func_init="init" :_func_add="add" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Учетные записи пользователей'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
    c-edit-dialog(ref='revue')
    c-remove-dialog(ref='rem')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_user from "@/js/api/user";
import api_user_post from "@/js/api/userPost";
import api_department from "@/js/api/department";
import api_group from "@/js/api/group";

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
import addDialog_C from "@/js/views/administrator-f/components/AddDialogs/C_User_Add";
import editDialog_C from "@/js/views/administrator-f/components/EditDialogs/C_User_Edit";
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_User_Delete";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  computed: {
    ...mapGetters(["users", "specialities", "groups"])
  },
  post_name: {
    name: "CRUD пользователей",
    url: "users_crud"
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
      { text: "Почта", value: "email" },
      { text: "Роль", value: "post.name" },
      { text: "Блокировка", value: "disabled" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),
  async beforeMount()
  {
    this.showLoading("Загрузка аддонов");
    if (this.specialities == null)
      await this.$store.commit(mutations.SET_SPECIALITIES_FULL,await api_department.getDepartments());

    if (this.userposts == null)
      await this.$store.commit(mutations.SET_USERPOSTS_FULL,await api_user_post.getPostsForCombobox())

    if (this.groups == null)
      await this.$store.commit(mutations.SET_GROUPS_FULL, await api_group.getGroups());
    this.closeLoading("Загрузка аддонов");
  },

  methods: {
    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    async init() {
      if (this.users == null)
        return this.update();
    },

    async update() {
      this.showLoading("Обновление данных");
      await this.$store.commit(mutations.SET_USERS_FULL, await api_user.getUsers());
      this.closeLoading("Обновление данных");
    },
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    async add() {
      await this.$refs.new.pop().then(result => {
        if (result) {
          this.$store.dispatch(actions.ADD_USER,{ context: this, result: result });
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
          this.$store.dispatch(actions.EDIT_USER,{ context: this, result: result });
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
      this.$refs.revue.$refs.form.reset();
    },
    //?----------------------------------------------
    //!           Удаление объекта
    //?----------------------------------------------
    remove(item) {
      this.$refs.rem.pop(item).then(result => {
        if (result) {
          this.$store.dispatch(actions.DELETE_USER,{ context: this, result: result });
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!          Отправка письма для смены почты
    //?----------------------------------------------
    async reset_password(item) 
    {
      this.showLoading("Отправка письма");
      if(item.email != null)
        if(await api_user.EmailForResetPassword(item.email))
          this.showMessage("Письмо отправлено!");
      this.closeLoading("Отправка письма");
    }
  }
};
</script>