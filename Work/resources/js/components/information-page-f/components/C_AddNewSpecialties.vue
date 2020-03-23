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
                v-text-field.ma-2(v-model="item.href" label="Ссылка")
                v-text-field.ma-2(v-model="item.title" label="Название специальности")
                v-text-field.ma-2(v-model="item.qualification" label="Квалификация")
                v-textarea.ma-2(outlined v-model="item.text" label="Описание")
                v-alert.mx-2(text dense type="warning")
                  span Перечислите все необходимые спецификации через запятую
                v-textarea.ma-2(outlined multi-line label="Профессиональные сертификации")
                v-textarea.ma-2(outlined multi-line label="Наши выпускники умеют")
                v-textarea.ma-2(outlined multi-line label="На специальности изучаются")
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      item: {
        href: null,
        title: null,
        qualification: null,
        certifications: [],
        skills: [],
        learning: [],
        text: null
      },
    };
  },

  props: 
  {
    _add: {
      type: Function,
      default: null
    }
  },

  methods: 
  {
      add(item) 
      {
        this._add(this.item);
        this.dialog = false;
      }
  }
};
</script>