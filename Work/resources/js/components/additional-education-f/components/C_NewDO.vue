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
                v-text-field.ma-2(v-model="item.title" label="Название программы")
                v-text-field.ma-2(v-model="item.cost" label="Стоимость программы")
                v-text-field.ma-2(v-model="item.time" label="Кол-во академических часов")
                v-textarea.ma-2(outlined v-model="item.text" label="Описание")
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      item: {
        href: null,
        title: null,
        cost: null,
        time: null,
        text: null
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
    add() {
      this._add(this.item);
      this.dialog = false;
    }
  }
};
</script>