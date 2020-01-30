<template lang="pug">
    v-dialog(v-model="dialog" max-width="500px")
        v-card.ma-0.pa-0
            v-card-title.headline 
                h4.text-truncate Редактирование
            v-form
              v-card-text
                  v-text-field(v-model="item.code" :rules="codeRules" label="Код отделения")
                  v-text-field(v-model="item.name" :rules="nameRules" label="Наименование")
              v-card-actions              
                  v-btn(color="accent darken-1" text @click="clickCancel") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="clickEdit") Изменить
</template>

<script>
import apidepartments from "../../../../api/departments"; //*api для отделений
import withSnackbar from "../../../mixins/withSnackbar"; //*Оповещения

export default {
  data() {
    return {
      dialog: false,
      item: {
        id: -1,
        code: "",
        name: "",
        full: ""
      },
      resolve: null,
      codeRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => v.length <= 255 || "Максимальное кол-во символов 255"
      ],
      nameRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => v.length <= 255 || "Максимальное кол-во символов 255"
      ]
    };
  },
  props: {
    _item: {
      type: Object,
      default: {
        id: -1,
        code: "",
        name: "",
        full: ""
      }
    } //! Данные
  },
  mounted() {
    this.item = this._item;
  },
  mixins: [withSnackbar],
  methods: {
    pop() {
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    clickEdit() {
      this.item.full = this.item.code + " " + this.item.name;
      if (this.item.code != "") {
        if (this.item.name != "") {
          apidepartments
            .editDepartment({ department: this.item })
            .then(result => {
              this.dialog = false;
              this.resolve(true);
            })
            .catch(exception => {
              this.showError(
                "Изменение не было произведено по причине: " + exception
              );
              this.dialog = false;
              this.resolve(false);
            });
        }
      }
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>