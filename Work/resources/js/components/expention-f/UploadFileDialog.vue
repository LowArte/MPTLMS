<template lang="pug">
  v-dialog(v-model="dialog" max-width="400")
    v-card
      v-card-title(color="warrning darken-1" class="headline") Загрузка файла
      v-card-text Выберите файл для импорта
      v-card-text
        v-file-input(multiple show-size label="Файл" v-model="file" )
      v-card-actions
        v-btn(color="accent darken-1" text @click="clickNot") Отмена
        v-spacer
        v-btn(color="green darken-1" text @click="clickYes") загрузить
  </template>

<script>
export default {
  data() {
    return {
      dialog: false,
      file: null,
      resolve: null
    };
  },

  methods: {
    pop() {
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    clickYes() {
      this.dialog = false;
      let formData = new FormData();

      if(typeof(this.file) == "object")
      {
        console.log(this.file)
        for(let i =0;i<this.file.length;i++)
          formData.append("file"+i, this.file[i]);
      }

      this.resolve(formData);
    },

    clickNot() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>