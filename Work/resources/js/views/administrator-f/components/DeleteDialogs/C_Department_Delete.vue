<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="500px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field.ma-2(v-model="item.image" label="Ссылка на картинку" disabled)
          v-text-field.ma-2(v-model="item.dep_name_full" label="Название специальности" disabled)
          v-text-field.ma-2(v-model="item.qualification" label="Квалификация" disabled)
          v-textarea.ma-2(outlined v-model="item.info.text" label="Описание" disabled)
          v-autocomplete.ma-2(v-model="item.studysperiod" :items="studysperiods" label="Период обучения" disabled)
          v-alert.mx-2(text dense type="warning" disabled)
            span Перечислите все необходимые спецификации через запятую
          v-textarea.ma-2(v-model="item.info.certifications" outlined multi-line label="Профессиональные сертификации" disabled)
          v-textarea.ma-2(v-model="item.info.skills" outlined multi-line label="Наши выпускники умеют" disabled)
          v-textarea.ma-2(v-model="item.info.learning" outlined multi-line label="На специальности изучаются" disabled)
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
          text: null
        }
      },
      resolve: null
    };
  },

  methods: {
    pop(item) {
      this.item = JSON.parse(JSON.stringify(item));
      this.dialog = true;
      this.item.info.certifications = this.item.info.certifications.join(",");
      this.item.info.skills = this.item.info.skills.join(",");
      this.item.info.learning = this.item.info.learning.join(",");
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