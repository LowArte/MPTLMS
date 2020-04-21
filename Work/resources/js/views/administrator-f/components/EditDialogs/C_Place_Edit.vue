<template lang="pug">
  v-dialog(v-model="dialog" scrollable persistent max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Добавить запись
      v-form(ref='form')
        v-card-text
          v-text-field(v-model="item.place_name" :rules="place_nameRules" label="Наименование места проведения")
          v-text-field(v-model="item.info.place_country" :rules="place_countryRules" label="Страна")
          v-text-field(v-model="item.info.place_index" :rules="place_indexRules" label="Почтовый индекс")
          v-text-field(v-model="item.info.place_city" :rules="place_cityRules" label="Город")
          v-text-field(v-model="item.info.place_street" :rules="place_streetRules" label="Улица")
          v-text-field(v-model="item.info.place_building_number" :rules="place_building_numberRules" label="Номер здания")
          v-text-field(v-model="item.info.place_piy" label="Корпус")    
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickEdit") Изменить
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
      resolve: null,
      place_nameRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[А-Я && а-я]*$/.test(v) || "Только буквы"
      ],
      place_indexRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[0-9]*$/.test(v) || "Только целочисленные значения (0-9)"
      ],
      place_countryRules: [v => !!v || "Поле не должно оставаться пустым"],
      place_cityRules: [v => !!v || "Поле не должно оставаться пустым"],
      place_streetRules: [v => !!v || "Поле не должно оставаться пустым"],
      place_building_numberRules: [
        v => !!v || "Поле не должно оставаться пустым", 
        v => /^[0-9]*$/.test(v) || "Только целочисленные значения (0-9)"
      ],
      place_piyRules: [v => !!v || "Поле не должно оставаться пустым"],
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
    clickEdit() {
      if (this.$refs.form.validate()) 
      {
        this.dialog = false;
        let data = Object.assign({}, this.item);
        this.resolve(data);
      } else {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля!");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.clearForm();
      this.resolve(false);
    },

    clearForm()
    {
      this.item.place_name = null;
    }
  }
};
</script>