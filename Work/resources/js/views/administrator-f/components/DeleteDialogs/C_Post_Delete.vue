<template lang="pug">
  v-dialog(v-model="dialog" persistent scrollable max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.name" label="Наименование" readonly)
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickDelete") Удалить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      item: {
        id: null,
        name: null,
        slug: null
      },
      resolve: null,
      nameRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[А-Я && а-я]*$/.test(v) || "Только кирилические символы"
      ],
      codeRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[A-Z && a-z]*$/.test(v) || "Только латинские символы"
      ]
    };
  },
  methods: {
    pop(item) {
      this.item = Object.assign({}, item);
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickDelete() {
      this.dialog = false;
      this.resolve(this.item.id);
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>