<template lang="pug">
    v-content.ma-0.pa-0
      v-layout.column.wrap
        v-flex
          v-card(flat)
            v-tabs(v-model="tabs" centered slider-color="orange darken-1")
              v-tab Лента
              v-tab Календарь
            v-tabs-items(v-model="tabs")
              v-tab-item {{homework_list}}
              v-tab-item
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_homework from "@/js/api/homework";
//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withSnackbar, withOverlayLoading],
    post_name: {
    name: "Домашнее задание",
    url: "homework_student",
    dop_com: [
      {
        url: "homework/:homework_id",
        path: "js/views/homework-f/HomeWorkShowStudent"
      }
    ]
  },

  computed: {
    ...mapGetters([
      "user",
      "homework_list"
    ]),
  },

  async beforeMount()
  {
    this.showLoading("Получение данных");
    //Получение данных
    await this.$store.dispatch(actions.ADD_CACHE_HOMEWORK_STUDENT, {
      context: this,
      id: this.user.student.group_id
    });
    this.closeLoading("Получение данных");
  },

  data() {
    return {
      tabs: null
    };
  },

  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods:{

  }
}
</script>