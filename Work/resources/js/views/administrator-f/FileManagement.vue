<template lang="pug">
  c-crud-form(:_func_add="add" :_func_clear="clear" :_func_edit="edit" :_func_remove="remove" :_flood="null" :_headers="headers" :_title="'Файловая система'")
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения

//?----------------------------------------------
//!           Подключение шаблона CRUD
//?----------------------------------------------
import CRUD_C from "./CRUDpattern";

export default {
  mixins: [withSnackbar],
  data: () => ({
    headers: [
      { text: "Файл", value: "dep_name" },
      { text: "Путь", value: "specialization" },
      { text: "Действия", value: "action", sortable: false }
    ]
  }),
  components: {
    "c-crud-form": CRUD_C
  },
  props: {
    _files: {
      type: Array,
      default: null
    }
  },
  methods: {
    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    add() {
      this.$refs.new.pop().then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showError("Действие было отменено");
        }
      });
    },
    //?----------------------------------------------
    //!           Изменение объекта
    //?----------------------------------------------
    edit(item) {
      this.$refs.revue.pop(item).then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showError("Действие было отменено");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление всех объектов
    //?----------------------------------------------
    clear() {
      this.$refs.qwestion.pop().then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showError("Действие было отменено");
        }
      });
    },
    //?----------------------------------------------
    //!           Удаление всех объектa
    //?----------------------------------------------
    remove(item) {
      this.$refs.rem.pop(item).then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showError("Действие было отменено");
        }
      });
    }
  }
};
</script>