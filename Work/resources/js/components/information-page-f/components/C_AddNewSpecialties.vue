<template lang="pug">
    v-flex.my-2
      v-card.mx-auto(width='420px' style='display: flex; flex-direction: column;' height='100%')
        v-fade-transition
          v-overlay(absolute color="primary")
            v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
              template(v-slot:activator="{ on }")
                v-btn(fab text light large v-on="on")
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
                    v-text-field.ma-2(name="_href" label="Ссылка")
                    v-text-field.ma-2(name="_title" label="Название специальности")
                    v-text-field.ma-2(name="_qualification" label="Квалификация")
                    v-textarea.ma-2(outlined name="_text" label="Описание")
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
  props: {
    _add: {
      type: Function,
      default: null
    }
  },
  methods: {
      add() {
        this.item.href = this._href;
        this.item.title = this._title;
        this.item.qualification = this._qualification;
        this.item.text = this._text;
        this._add(this.item);
        this.dialog = false;
      }
  }
};
</script>