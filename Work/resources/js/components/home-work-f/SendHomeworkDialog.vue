<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="640")
        v-card
            v-card-title(color="warrning darken-1" class="headline") Сдача задания
            v-card-text Ваше задание будет загружено в личный кабинет и будет ожидать оценки от преподавателя, выдавшего задание.
            v-card-text
                v-form(ref="form")
                    v-autocomplete(v-model="select" :items="items" label="Вариант сдачи" outlined dense item-value="id" item-text="text")                    
                    v-textarea.mt-3(outlined v-model="text" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Сообщение преподавателю" :row-height="18" :rows="3")
                    v-file-input(v-if="select != 2 && select != 4" outlined dense clearable multiple show-size label="Файл(ы)" v-model="files")
                    div(v-if="links.length > 0 && select != 1 && select != 4")
                        v-list(dense flat)  
                            v-list-item.px-0(v-for="(link, index) in links" :key="index")
                                v-list-item-content
                                    v-text-field(v-model="links[index]" outlined single-line dense clearable label="Ссылка" :rules="linksRules")
                                v-list-item-action.pb-5.mt-2
                                    v-btn(icon small @click="links.splice(index, 1)")
                                        v-icon mdi-link-off
                    v-card-actions.pa-0(v-if="select != 1 && select != 4")
                        v-btn(small block color="grey lighten-1" @click="links.length < 5 ? links.push('') : message('Достигнуто максимальное кол-во ссылок')")
                            v-icon mdi-link-plus
            v-card-actions
                v-btn(small text color="grey lighten-1" @click="calcel") Отмена
                v-spacer
                v-btn(small text color="orange darken-1" @click="send") Сдать

</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";
import withSnackbar from "@/js/components/mixins/withSnackbar";
import LoadFileDialogHomework_С from "@/js/components/home-work-f/LoadFileDialogHomework";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  mixins: [withSnackbar, withOverlayLoading],
  data() {
    return {
      dialog: false,
      text: null,
      links: [],
      files: null,
      select: 1,
      items: [
        { id: 1, text: "Файл(ы)" },
        { id: 2, text: "Ссылка" },
        { id: 3, text: "Файл(ы) и ссылка" },
        { id: 4, text: "Сообщение" }
      ],
      linksRules: [
        value =>
          !!value || "Данное поле не должно оставаться пустым, либо удалите его"
      ]
    };
  },
  methods: {
    pop() {
      this.dialog = !this.dialog;
      this.select = 1;
      this.links = [];
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    send() {
      switch (this.select) {
        case 1: {
          if (this.$refs.form.validate())
            if (this.files)
              if (this.files.length > 0) {
                let formData = new FormData();
                for (let i = 0; i < this.files.length; i++)
                  formData.append("file" + i, this.files[i]);
                this.resolve({
                  links: null,
                  files: formData,
                  text: this.text
                });
                this.dialog = !this.dialog;
                this.$refs.form.reset();
              } else this.showError("Нельзя отправить пустое задание");
            else this.showError("Нельзя отправить пустое задание");
          break;
        }
        case 2: {
          if (this.$refs.form.validate())
            if (this.links.length > 0) {
              this.resolve({
                links: this.links,
                files: null,
                text: this.text
              });
              this.dialog = !this.dialog;
              this.links = [];
              this.$refs.form.reset();
            } else this.showError("Нельзя отправить пустое задание");
          break;
        }
        case 3: {
          if (this.$refs.form.validate())
            if (this.files)
              if (this.files.length > 0)
                if (this.links.length > 0) {
                  let formData = new FormData();
                  for (let i = 0; i < this.files.length; i++)
                    formData.append("file" + i, this.files[i]);
                  this.resolve({
                    links: this.links,
                    files: formData,
                    text: this.text
                  });
                  this.dialog = !this.dialog;
                  this.links = [];
                  this.$refs.form.reset();
                } else this.showError("Нельзя отправить пустое задание");
              else this.showError("Нельзя отправить пустое задание");
            else this.showError("Нельзя отправить пустое задание");
          else this.showError("Нельзя отправить пустое задание");
          break;
        }
        case 4: {
          if (this.text != null) {
            this.resolve({
              links: null,
              files: null,
              text: this.text
            });
            this.dialog = !this.dialog;
            this.$refs.form.reset();
          } else this.showError("Нельзя отправить пустое задание");
          break;
        }

        default: {
          this.showError("Выберете один из доступных вариантов сдачи работы");
          break;
        }
      }
    },
    calcel() {
      this.dialog = !this.dialog;
      this.$refs.form.reset();
      this.resolve(false);
    },
    message(text) {
      this.showError(text);
    }
  }
};
</script>