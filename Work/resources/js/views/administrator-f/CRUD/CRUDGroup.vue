<template lang="pug">
  div
    c-crud-form(ref='crud' :_func_update="update" :_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="_groups" :_headers="headers" :_title="'Группы'")
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

export default {
  post_name: {
    name: "CRUD групп",
    url: "/groups_crud"
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

  props: {
    _groups: {
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
        .getGroups()
        .then(result => {
          this.$refs.crud.refresh(result.data.groups);
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
            .saveGroup(result)
            .then(res => {
              this.showMessage("Действие было выполнено успешно!");
            })
            .catch(exception => {
              this.showError(
                "Сохранение не было произведено по причине: " + exception
              );
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
          console.log(result);
          api
            .editGroup(result)
            .then(res => {
              this.showMessage("Действие было выполнено успешно!");
            })
            .catch(exception => {
              this.showError(
                "Сохранение не было произведено по причине: " + exception
              );
            });
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
            .dropGroups()
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
            .deleteGroup(item.id)
            .then(result => {
              this.showMessage("Действие было выполнено успешно!");
            })
            .catch(exception => {
              this.showError(
                "Удаление не было произведено по причине: " + exception
              );
            });
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    }
  }
};
</script>