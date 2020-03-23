<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="500px")
        v-card.ma-0.pa-0
            v-card-title.headline 
                h4.text-truncate Изменить запись
            v-form(ref='form')
              v-card-text
                  v-text-field(v-model="item.dep_name_full" :rules="dep_name_fullRules" label="Наименование")
                  v-text-field(v-model="item.qualification" :rules="qualificationRules" label="Квалификация") 
                  v-text-field(v-model="item.image" :rules="imageRules" label="Ссылка на изображение") 
                  v-text-field(v-model="item.info" :rules="infoRules" label="Информация об отделении") 
                  v-text-field(v-model="item.studysperiod" :rules="studysperiodRules" label="Период обучения") 
              v-card-actions              
                  v-btn(color="accent darken-1" text @click="clickCancel") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="clickEdit") Изменить
</template>

<script>
import withSnackbar from "../../../mixins/withSnackbar"; //*Оповещения

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      item: {
        dep_name_full: null,
        qualification: null,
        image: null,
        info: null,
        studysperiod: null
      },
      resolve: null,
      dep_name_fullRules: [v => !!v || "Поле не должно оставаться пустым"],
      qualificationRules: [v => !!v || "Поле не должно оставаться пустым"],
      imageRules: [v => !!v || "Поле не должно оставаться пустым"],
      infoRules: [v => !!v || "Поле не должно оставаться пустым"],
      studysperiodRules: [v => !!v || "Поле не должно оставаться пустым"],
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
    clickEdit() {
      if (this.$refs.form.validate()) 
      {
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