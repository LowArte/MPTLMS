<template lang="pug">
  div
    c-crud-form(ref='crud' :_floodArray="this.flood" :_func_update="update" :_func_init="init" :_func_add="add" :_func_edit="edit" :_func_remove="remove" :_headers="headers" :_title="'Дисциплины'")
    c-comfirm-dialog(ref="qwestion")
    c-add-dialog(ref='new')
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_discipline from '@/js/api/discipline';

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
import addDialog_C from "@/js/views/administrator-f/components/AddDialogs/C_Discipline_Add";
/*import editDialog_C from "@/js/views/administrator-f/components/EditDialogs/C_Group_Edit";
import removeDialog_C from "@/js/views/administrator-f/components/DeleteDialogs/C_Group_Delete";*/

import { mapGetters } from "vuex";
import FileDownload from "js-file-download";

import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  computed: {
    ...mapGetters(["groups"])
  },
  post_name: {
    name: "CRUD дисциплин",
    url: "disciplines_crud"
  },
  mixins: [withSnackbar, withOverlayLoading],
  components: {
    "c-crud-form": CRUD_C,
    "c-comfirm-dialog": confirmDialog_C,
    "c-add-dialog": addDialog_C,
  },

  props:{
      _db_name:{
          type: String,
          default: null
      }
  },

  data: () => ({
    headers: [
      { text: "№", value: "id" },
      { text: "Отделение", value: "dep_name_full" },
      { text: "Дисциплина", value: "discip_name" },
      { text: "I семестр", value: "discip_hours_first" },
      { text: "II семестр", value: "discip_hours_second" },
      { text: "Действия", value: "action", sortable: false }
    ],
    flood: [],
  }),
  methods: {
    async beforeMount() {
      this.init();
    },

    //?----------------------------------------------
    //!           Обновление
    //?----------------------------------------------
    async init() {
      return this.update();
    },

    async update() {
      this.showLoading("Обновление данных");
      this.flood = await api_discipline.getDisciplinesDBContent(this._db_name);
      console.log(this.flood);
      this.closeLoading("Обновление данных");
    },

    //?----------------------------------------------
    //!           Добавление объекта
    //?----------------------------------------------
    async add() {
      await this.$refs.new.pop().then(res => {
        if (res) {}
        else
          this.showInfo("Действие было отменено пользователем!");
      });
      this.$refs.new.$refs.form.reset();
    },
    //?----------------------------------------------
    //!           Изменение объекта
    //?----------------------------------------------
    async edit(item) {
    },
    //?----------------------------------------------
    //!           Удаление всех объектa
    //?----------------------------------------------
    async remove(item) {

    }
  }
};
</script>