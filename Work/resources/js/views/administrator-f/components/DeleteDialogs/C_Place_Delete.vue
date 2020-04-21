<template lang="pug">
  v-dialog(v-model="dialog" persistent scrollable max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.place_name" label="Наименование места проведения" readonly)
          v-text-field(v-model="item.info.place_index" label="Индекс" readonly)
          v-text-field(v-model="item.info.place_country" label="Страна" readonly)
          v-text-field(v-model="item.info.place_city" label="Город" readonly)
          v-text-field(v-model="item.info.place_street" label="Улица" readonly)
          v-text-field(v-model="item.info.place_building_number" label="Номер здания" readonly)
          v-text-field(v-model="item.info.place_piy" label="Корпус" readonly)
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickDelete") Удалить
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
        id: null,
        place_name: null,
        info:{
          place_index: "",
          place_country: "",
          place_city: "",
          place_street: "",
          place_building_number: "",
          place_piy: ""
        }
      },
      resolve: null
    };
  },
  methods: {
    pop(item) {
      this.item = JSON.parse(JSON.stringify(item));
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
      this.clearForm();
      this.resolve(false);
    },

    clearForm()
    {
      this.item.place_name = null;
      this.item.info.place_index = "";
      this.item.place_country = "";
      this.item.place_city = "";
      this.item.place_street = "";
      this.item.place_building_number = "";
      this.item.place_piy = "";
    }
  }
};
</script>