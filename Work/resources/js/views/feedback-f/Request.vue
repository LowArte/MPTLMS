<template lang="pug">
v-content.ma-0.pa-1
  v-layout.row.wrap
    v-flex(v-if="feedback" v-for="item in feedback" :key="item.id")
      v-card.mx-auto(width="320px")
        v-system-bar
          small Получено: {{item.created_at}}
        v-card-title Тема: {{item.type}}
        v-card-text Сообщение: {{item.text}}
        v-card-text Отвечено? {{item.answered}}
        //- Вынести к хуям в компонент
        v-dialog(persistent max-width="600px")
          template(v-slot:activator="{ on }")
            v-btn(text block color="accent" v-on="on") Ответить
          v-card
            v-system-bar
              small Ответ на обращения пользователя
            v-form(ref="form" @submit.prevent="submit(item)")
              v-textarea.ma-2(outlined v-model="data.text" :auto-grow='true' :counter='255 ? 255 : false' :rules="textRules" label="Напишите ответ пользователю" required)
              v-card-actions
                v-btn(color="blue darken-1" text @click="dialog = false") Отменить
                v-spacer
                v-btn(color="accent darken-1" text @click="dialog = false" type="submit") Отправить  
  </template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
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
      text: null,
      textRules: [
        v => !!v || "Текст сообщения не указан",
        v => !!v && v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
      ],
      data: {
        id: null,
        email: null,
        text: null
      }
    };
  },

  mixins: [withSnackbar, withOverlayLoading],

  components: {
    "c-request-dialog": requestDialog_C
  },

  computed: mapGetters(["feedback"]),

  async beforeMount() {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.FILL_UP_FEEDBACK);
    this.closeLoading("Получение данных");
  },

  methods: {
    async submit(item) {
      if (this.$refs.form.validate()) {
        this.data.id = item.id;
        this.data.email = item.user.email;
        console.log(this.data);
        if (await this.$store.dispatch(actions.RESPOND(this.data)))
          this.$refs.form.reset();
      } else this.showError("Заполните корректно поля!");
    }
  }
};
</script>