<template lang="pug">
v-card-actions
  v-dialog(v-model="dialog" persistent max-width="600px")
    template(v-slot:activator="{ on }")
      v-btn(text block color="success" v-on="on") Ответить
    v-card
      v-system-bar
        small Ответ на обращения пользователя
      v-form(ref="form" @submit.prevent="submit")
        v-textarea.ma-2(outlined v-model="data.text" :auto-grow='true' :counter='255 ? 255 : false' :rules="textRules" label="Напишите ответ пользователю" required)
        v-card-actions
          v-btn(color="info darken-1" text @click="cancel") Отменить
          v-spacer
          v-btn(color="accent darken-1" text @click="overlay = !overlay" type="submit") Отправить 
        v-overlay(:absolute="true" :value="overlay")
          v-layout(row)
            v-progress-circular.mx-auto(indeterminate)
          v-layout(row)
            p.text-center.px-6.py-2 Обработка запроса
</template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

export default {
  mixins: [withSnackbar],
  computed: {
    ...mapGetters(["user"])
  },
  data() {
    return {
      dialog: false,
      overlay: false,
      data: {
        id: null,
        to: null,
        by: null,
        text: null
      },
      textRules: [
        v => !!v || "Текст сообщения не указан",
        v =>
          (!!v && v.length <= 255) ||
          "Текст сообщения должен быть не более 255 символов"
      ]
    };
  },

  props: {
    _item: {
      type: Object,
      default: null
    }
  },

  mounted() {
    this.data.id = this._item.id;
    this.data.to = this._item.email;
    this.data.by = this.user.email;
  },

  methods: {
    async submit() {
      if (this.$refs.form.validate()) {
        this.overlay = true;
        await this.$store.dispatch(actions.RESPOND, this.data);
        await this.$store.dispatch(actions.EDIT_ANSWERED, this._item.id);
        this.overlay = false;
        this.dialog = false;
      }
    },
    cancel() {
      this.dialog = false;
      this.$refs.form.reset();
    }
  }
};
</script>
