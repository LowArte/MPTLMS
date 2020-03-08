<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="500px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.id" :rules="codeRules" label="Код отделения" disabled)
          v-text-field(v-model="item.dep_name_full" :rules="nameRules" label="Наименование" disabled)
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickSave") Удалить
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
    pop(item) {
      this.item = item;
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    clickSave() {
      this.dialog = false;
      this.resolve(this.item);
    },

    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>