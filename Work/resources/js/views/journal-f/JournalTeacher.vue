<template lang="pug">
    
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_journal from "@/js/api/journal";

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withOverlayLoading],
  computed: {
    ...mapGetters(["user"])
  },

  post_name: {
    name: "Журнал учителей",
    url: "journal_teacher"
  },

  data() {
    return {};
  },

  beforeMount() {},
  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {}
};
</script>