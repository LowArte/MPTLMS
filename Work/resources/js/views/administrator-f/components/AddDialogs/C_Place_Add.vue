<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Добавить запись
      v-form
        v-card-text
          v-text-field(v-model="item.place_name" :rules="codeRules" label="Наименование места проведения")
          v-text-field(v-model="item.place_index" :rules="codeRules" label="Индекс")
          v-text-field(v-model="item.place_country" :rules="codeRules" label="Страна")
          v-text-field(v-model="item.place_city" :rules="codeRules" label="Город")
          v-text-field(v-model="item.place_street" :rules="codeRules" label="Улица")
          v-text-field(v-model="item.place_building_number" :rules="codeRules" label="Номер здания")
          v-text-field(v-model="item.place_piy" :rules="codeRules" label="Корпус")
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickSave") Сохранить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "../../../mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      item: {
        place_name: null,
        place_index: null,
        place_country: null,
        place_city: null,
        place_street: null,
        place_building_number: null,
        place_piy: null
      },
      resolve: null,
      codeRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[А-Я && а-я]*$/.test(v) || "Только буквы в верхнем регистре"
      ]
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
      if (this.item.place_name != null) {
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