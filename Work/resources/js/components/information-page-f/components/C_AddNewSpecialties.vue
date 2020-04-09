<template lang="pug">
    v-flex.my-2
      v-card.mx-auto(width='420px' color="info" lighten-2 style='display: flex; flex-direction: column;' height='100%')
        v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
          template(v-slot:activator="{ on }")
            v-btn.mx-auto.my-auto(fab text dark large v-on="on")
              v-icon mdi-plus
          v-card
            v-toolbar(color="white")
              v-btn(icon dark @click="dialog = false")
                v-icon(color="primary") mdi-close
              v-toolbar-title(text--primary) Новая специальность
              v-spacer
              v-btn(color="success" @click="add") Сохранить
            v-content.pa-0
              v-card.ma-2.pt-3
                v-text-field.ma-2(v-model="item.image" label="Ссылка на картинку")
                v-text-field.ma-2(v-model="item.dep_name_full" label="Название специальности")
                v-text-field.ma-2(v-model="item.qualification" label="Квалификация")
                v-textarea.ma-2(outlined v-model="item.info.text" label="Описание")
                v-autocomplete.ma-2(v-model="item.studysperiod" :items="studysperiods" label="Период обучения")
                v-alert.mx-2(text dense type="warning")
                  span Перечислите все необходимые спецификации через запятую
                v-textarea.ma-2(v-model="item.info.certifications" outlined multi-line label="Профессиональные сертификации")
                v-textarea.ma-2(v-model="item.info.skills" outlined multi-line label="Наши выпускники умеют")
                v-textarea.ma-2(v-model="item.info.learning" outlined multi-line label="На специальности изучаются")
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      studysperiods:[
        "3 года 10 месяцев",
        "2 года 10 месяцев",
        "1 год 10 месяцев",
      ],
      item: {
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
      }
    };
  },

  props: {
    _add: {
      type: Function,
      default: null
    }
  },

  methods: {
    add(item) {
      this.item.info.certifications = this.item.info.certifications.split(",");
      this.item.info.skills = this.item.info.skills.split(",");
      this.item.info.learning = this.item.info.learning.split(",");
      this._add(this.item);
      this.item = {
        dep_name_full: null,
        image: null,
        qualification: null,
        info: {
          certifications: [],
          skills: [],
          learning: [],
          text: null
        }
      };
      this.dialog = false;
    }
  }
};
</script>