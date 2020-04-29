<template lang="pug">
v-content.ma-0.pa-1
  v-layout.column.wrap
    v-data-iterator(:items="feedback" :search="search" :sort-by="sortBy.toLowerCase()" hide-default-footer no-data-text="" no-results-text="")
      template(v-slot:header)
        v-toolbar(dense floating)
          v-text-field(hide-details v-model="search" prepend-icon="search" single-line label="ФИО")
          v-btn.ma-0.mx-2(small icon @click="answered = !answered" color="primary")
            v-icon(:color="!answered ? 'primary' : 'success'") mdi-swap-vertical
      template(v-slot:default="props" v-if="feedback" )
        v-layout.row.wrap
          v-flex(v-if="feedback && (item.answered == 0 && answered == false)" v-for="item in feedback" :key="item.id")
            v-card.mx-auto(min-width="300px" max-width="480px" transition="scale-transition")
              v-system-bar(color="primary" dark)
                small Получено: {{item.created_at}}
              div.body-2.pa-4.pb-1 
                kbd ФИО: {{item.fullFio}}
              div.body-2.px-4.py-1 
                kbd email: {{item.email}}
              div.body-2.mb-1.px-4.py-1 
                kbd Тема: {{item.type}}
              v-card-text.pt-0 Сообщение: {{item.text}}
              c-request-dialog(:_item="item")
          v-flex(v-if="feedback  && (item.answered && answered)" v-for="item in feedback" :key="item.id")
            v-card.mx-auto(min-width="300px" max-width="480px" transition="scale-transition")
              v-system-bar(color="success" dark)
                small Получено: {{item.created_at}} | Отвечено
              div.body-2.pa-4.pb-1 
                kbd ФИО: {{item.fullFio}}
              div.body-2.px-4.py-1 
                kbd email: {{item.email}}
              div.body-2.mb-1.px-4.py-1 
                kbd Тема: {{item.type}}
              v-card-text.pt-0 Сообщение: {{item.text}}
      v-layout.row.wrap(v-else)
        p.text-center.px-6.py-2 Нет данных
  </template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

//?----------------------------------------------
//!           Подключение диалогов
//?----------------------------------------------
import requestDialog_C from "@/js/components/feedback-f/RequestDialog";

export default {
  post_name: {
    name: "Просмотр обращений пользователей",
    url: "requests"
  },

  data() {
    return {
      data: null,
      dialog: false,
      answered: false,
      search: "",
      sortBy: "name",
      text: null,
      textRules: [
        v => !!v || "Текст сообщения не указан",
        v =>
          (!!v && v.length <= 255) ||
          "Текст сообщения должен быть не более 255 символов"
      ],
      data: {
        id: null,
        email: null,
        text: null
      }
    };
  },

  mixins: [withOverlayLoading],

  components: {
    "c-request-dialog": requestDialog_C
  },

  computed: mapGetters(["feedback"]),

  async beforeMount() {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.FILL_UP_FEEDBACK);
    this.closeLoading("Получение данных");
  }
};
</script>