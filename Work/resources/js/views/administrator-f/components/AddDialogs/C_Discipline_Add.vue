<template lang="pug">
  v-dialog(v-model="dialog" persistent scrollable max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Добавить запись
      v-form(ref='form')
        v-card-text
          v-autocomplete.my-3(:items="specialities" v-model="item.department_id" item-text="dep_name_full" no-data-text="Нет данных" item-value="id" :rules="specRules" label="Отделение")
          v-text-field(v-model="item.discip_name" :rules="discip_nameRules" label="Название дисциплины")
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
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  mixins: [withSnackbar],
  computed: {
    ...mapGetters(["specialities"]),
  },
  data() {
    return {
      dialog: false,
      item: {
        discip_name: null,
      },
      resolve: null,
      discip_nameRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[А-Я && а-я]*$/.test(v) || "Только буквы"
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

    clickSave() 
    {
      if (this.$refs.form.validate())
      {
        this.dialog = false;
        this.resolve(JSON.parse(JSON.stringify(this.item)));
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