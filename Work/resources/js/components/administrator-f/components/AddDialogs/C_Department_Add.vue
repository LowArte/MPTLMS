<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="500px")
        v-card.ma-0.pa-0
            v-card-title.headline 
                h4.text-truncate Добавить запись
            v-form
              v-card-text
                  v-text-field(v-model="item.code" :rules="codeRules" label="Код отделения")
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
import withSnackbar from "../../../mixins/withSnackbar"; //*Оповещения

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      item: {
        dep_name: null,
        specialization: null,
        dep_name_full: null
      },
      resolve: null,
      codeRules: [v => !!v || "Поле не должно оставаться пустым"],
      nameRules: [v => !!v || "Поле не должно оставаться пустым"]
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
      this.item.dep_name_full = this.item.dep_name + " " + this.item.specialization;
      if (this.item.dep_name != null && this.item.specialization != null) {
        this.dialog = false;
        this.resolve(this.item);
      } else {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>