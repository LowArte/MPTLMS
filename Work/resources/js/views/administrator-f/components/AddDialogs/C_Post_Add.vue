<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Добавить запись
      v-form(ref='form')
        v-card-text
          v-text-field(v-model="item.name" :rules="nameRules" label="Наименование")
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickSave") Сохранить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      item: {
        name: null,
        slug: null
      },
      resolve: null,
      nameRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[А-Я && а-я]*$/.test(v) || "Только кирилические символы"
      ],
    };
  },
  methods: {
    pop() {
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickSave() {
      if (this.$refs.form.validate()) 
      {
        this.dialog = false;
        this.resolve(this.item);
        this.item = Object.assign({}, null);
      } else {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.item = Object.assign({}, null);
      this.resolve(false);
    }
  }
};
</script>