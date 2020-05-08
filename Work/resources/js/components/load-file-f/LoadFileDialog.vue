<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="600px")
        v-card( dark raised )
            v-progress-linear(indeterminate color="success" v-if="loading" bottom)
            v-form(ref="form")
              v-card-text.pa-2 Загружаемый файл должен соотвествовать стандарту системы. Загружая КТП вы гарантируете, что файл соотвествует стандарту, в противном случе система отвергнет файл.
              v-card-actions.pa-2
                v-file-input(v-model="fileOreder" label="Тематический план" show-size outlined dense @change="validateExt(fileOreder)")
                  template(v-slot:selection="{ text }")
                    v-chip(small label color="success") {{ text }}
              v-card-actions.pa-2
                v-btn.mx-auto(small text dark color="red" @click="close") отмена
                v-spacer
                v-btn.mx-auto(small text dark color="success" @click="uploadFile()") загрузить
              
              
            
</template>

<script>
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_journal from "@/js/api/journal";

export default {
  data() {
    return {
      dialog: false,
      loading: false,
      fileOreder: null,
      resolve: null,
      imageRules: [
        value =>
          !value ||
          value.size < 5000000 ||
          "Размер изображения не должен привышать 5 MB",
        value =>
          !!value || "Поле не должно быть пустым, либо его необходимо удалить"
      ]
    };
  },
  methods: {
    async pop() {
      this.dialog = !this.dialog;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    async uploadFile() {
      if (this.$refs.form.validate()) {
        this.loading = !this.loading;
        console.log(this.fileOreder);
        let data = new FormData();
        data.append('file',this.fileOreder);
        if (await api_journal.getExcelTitles(data)) {
          this.fileOreder = null;
          this.dialog = false;
          this.loading = !this.loading;
          this.resolve(true);
        } else {
          this.loading = !this.loading;
        }
      }
    },
    validateExt(item) {
      if (item) {
        if (item.name) {
          var extFile = item.name
            .substr(item.name.lastIndexOf(".") + 1, item.name.length)
            .toLowerCase();

          if (extFile == "xlsx" || extFile == "xls")
            item.identity = true;
          else item.identity = false;
        }
      }
    },
    close() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>