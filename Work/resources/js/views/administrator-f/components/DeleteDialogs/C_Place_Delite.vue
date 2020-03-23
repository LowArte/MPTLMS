<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.place_name" label="Наименование места проведения" disabled)
          v-text-field(v-model="item.place_index" label="Индекс" disabled)
          v-text-field(v-model="item.place_country" label="Страна" disabled)
          v-text-field(v-model="item.place_city" label="Город" disabled)
          v-text-field(v-model="item.place_street" label="Улица" disabled)
          v-text-field(v-model="item.place_building_number" label="Номер здания" disabled)
          v-text-field(v-model="item.place_piy" label="Корпус" disabled)
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickDelete") Удалить
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
        id: null,
        place_name: null,
        place_index: null,
        place_country: null,
        place_city: null,
        place_street: null,
        place_building_number: null,
        place_piy: null
      },
      resolve: null
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
      this.resolve(this.item.id);
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>