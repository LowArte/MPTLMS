<template lang="pug">
v-dialog(v-model="dialog" persistent max-width="600px")
  template(v-slot:activator="{ on }")
    v-btn(icon x-small color="accent" v-on="on")
      v-icon.pa-0.ma-0 close
  v-card
    v-system-bar
      small Отказ
    v-form(ref="form")
      v-textarea.ma-2(v-model="data.text" outlined :auto-grow='true' :counter='255 ? 255 : false' :rules="textRules" label="Напишите ответ пользователю" required)
      v-card-actions
        v-btn(color="info darken-1" text @click="cancel") Отменить
        v-spacer
        v-btn(color="accent darken-1" text @click="apply()") Отправить 
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
import { mapActions, mapGetters } from "vuex";

export default {
  data() {
    return {
      dialog: false,
      overlay: false,
      textRules: [
        v => !!v || "Текст сообщения не указан",
        v =>
          (!!v && v.length <= 255) ||
          "Текст сообщения должен быть не более 255 символов"
      ],
      data: {
        id: null,
        to: null,
        by: null,
        text: null
      }
    };
  },

  mixins: [withSnackbar],
  
  computed: {
    ...mapGetters(["user"])
  },
  props: {
    _item: {
      type: Object,
      default: null
    }
  },
  methods: {
    async apply() {
      this.overlay = true;
      if(this.$refs.form.validate())
      {
        this.data.id = this._item.id;
        this.data.to = this._item.email;
        this.data.by = this.user.email;
        if (await this.$store.dispatch(actions.CANCEL_СERTIFICATE, this.data)) {
          this.showMessage("Уведомление об отказе отправлено");
        } else {
          this.showError(
            "Что-то пошло не так. Обратитесь в службу поддержки. Спасибо."
          );
        }
      }
      else
        this.showInfo(
            "Отменено пользователем"
          );
        this.overlay = false;
    },
    cancel() {
      this.dialog = false;
      this.$refs.form.reset();
    }
  }
};
</script>