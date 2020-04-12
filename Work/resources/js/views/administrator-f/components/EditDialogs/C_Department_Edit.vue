<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="500px")
        v-card.ma-0.pa-0
            v-card-title.headline 
                h4.text-truncate Изменить запись
            v-form(ref='form')
              v-card-text
                v-text-field.ma-2(v-model="item.image" :rules="allRules" label="Ссылка на картинку")
                v-text-field.ma-2(v-model="item.dep_name_full" :rules="allRules" label="Название специальности")
                v-text-field.ma-2(v-model="item.qualification" :rules="allRules" label="Квалификация")
                v-textarea.ma-2(outlined v-model="item.info.text" :rules="allRules" label="Описание")
                v-autocomplete.ma-2(v-model="item.studysperiod" :rules="allRules" :items="studysperiods" label="Период обучения")
                v-alert.mx-2(text dense type="warning")
                  span Перечислите все необходимые спецификации через запятую
                v-textarea.ma-2(v-model="item.info.certifications" :rules="allRules" outlined multi-line label="Профессиональные сертификации")
                v-textarea.ma-2(v-model="item.info.skills" :rules="allRules" outlined multi-line label="Наши выпускники умеют")
                v-textarea.ma-2(v-model="item.info.learning" :rules="allRules" outlined multi-line label="На специальности изучаются")
              v-card-actions              
                  v-btn(color="accent darken-1" text @click="clickCancel") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="clickEdit") Изменить
</template>

<script>
import withSnackbar from "@/js/components/mixins/withSnackbar"

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      studysperiods:[
        "3 года 10 месяцев",
        "2 года 10 месяцев",
        "1 год 10 месяцев",
      ],
      item: {
        id: null,
        dep_name_full: null,
        image: null,
        qualification: null,
        studysperiod:"3 года 10 месяцев",
        info: {
          certifications: [],
          skills: [],
          learning: [],
          text: ""
        }
      },
      resolve: null,
      allRules: [v => !!v || "Поле не должно оставаться пустым"],
      dep_name_fullRules: [v => !!v || "Поле не должно оставаться пустым"],
      qualificationRules: [v => !!v || "Поле не должно оставаться пустым"],
      imageRules: [v => !!v || "Поле не должно оставаться пустым"],
      infoRules: [v => !!v || "Поле не должно оставаться пустым"],
      studysperiodRules: [v => !!v || "Поле не должно оставаться пустым"],
    };
  },
  methods: {
    pop(item) {
      this.item = JSON.parse(JSON.stringify(item));
      this.item.info.certifications = this.item.info.certifications.join(",");
      this.item.info.skills = this.item.info.skills.join(",");
      this.item.info.learning = this.item.info.learning.join(",");
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickEdit() {
      if (this.$refs.form.validate()) 
      {
        this.dialog = false;
        this.item.info.certifications = this.item.info.certifications.split(",");
        this.item.info.skills = this.item.info.skills.split(",");
        this.item.info.learning = this.item.info.learning.split(",");
        this.resolve(this.item);
      } else {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля!");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>