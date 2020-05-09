<template lang="pug">
  v-dialog(v-model="dialog" persistent scrollable max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form(ref='form')
        v-card-text
          v-autocomplete.my-3(:items="specialities" v-model="item.department" item-text="dep_name_full" no-data-text="Нет данных" item-value="id" :rules="notNullRules" label="Отделение" readonly)
          v-text-field(v-model="item.discip_name" :rules="notNullRules" label="Название дисциплины" readonly)
          v-text-field(v-model="item.discip_hours_first" :rules="numberRules" label="Количество часов за I семестр" readonly)
          v-text-field(v-model="item.discip_hours_second" :rules="numberRules" label="Количество часов за II семестр" readonly)
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickSave") Удалить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"

import { mapGetters } from "vuex";

export default {
  mixins: [withSnackbar],
  computed: {
    ...mapGetters(["specialities"]),
  },
  data() {
    return {
      dialog: false,
      item: {
        id:null,
        department: null,
        discip_name: null,
        discip_hours_first: null,
        discip_hours_second: null,
      },
      resolve: null,
      notNullRules: [
        v => !!v || "Поле не должно оставаться пустым",
      ],
      numberRules: [
        v => /^[0-9]*$/.test(v) || "Только цифры"
      ],
    };
  },

  methods: {
    pop() {
      this.item = JSON.parse(JSON.stringify(item));
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    clickSave() 
    {
      if (this.$refs.form.validate())
      {
        this.dialog = false;
        this.resolve(JSON.parse(JSON.stringify(this.item.id)));
      } 
      else 
      {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля!");
      }
    },

    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    },
  }
};
</script>