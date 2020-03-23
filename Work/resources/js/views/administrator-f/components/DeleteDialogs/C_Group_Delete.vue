<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="550px")
    v-card.ma-0.pa-0
      v-card-title.headline 
        h4.text-truncate Удалить запись
      v-form
        v-card-text
          v-alert(dense type="info") Данное действие необратимо
          v-text-field(v-model="item.group_name" label="Код" disabled)
          v-text-field(v-model="item.group_number" label="Номер группы" disabled)
          v-text-field(v-model="item.group_year" label="Год поступления" disabled)
          v-combobox.my-3(v-model="item.departaments_id" label="Отделение" dense disabled)
          v-combobox.my-3(v-model="item.сurs" label="Текущий курс" dense disabled)
        v-card-actions              
          v-btn(color="accent darken-1" text @click="clickCancel") Отмена
          v-spacer
          v-btn(color="info darken-1" text @click="clickDel") Удалить
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      item: {
        group_name: null,
        group_number: null,
        group_year: null,
        сurs: 1,
        departaments_id: null
      },
      resolve: null
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

    clickDel() {
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