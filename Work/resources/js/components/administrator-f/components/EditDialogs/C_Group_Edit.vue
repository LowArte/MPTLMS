<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="550px")
        v-card.ma-0.pa-0
            v-card-title.headline 
                h4.text-truncate Изменить запись
            v-form
              v-card-text
                v-alert(text dense border="left" colored-border type="warning") В поле <strong>Код</strong> необходимо ввести краткое именование отделения. <br>
                    strong Например: 
                        i Программисты - П
                v-text-field(v-model="item.group_name" :rules="codeRules" label="Код")
                v-alert(text dense border="left" colored-border type="warning") В поле <strong>Номер группы</strong> указывается порядковый номер группы <br>
                    strong Например: 
                            i П-3
                v-text-field(v-model="item.group_number" :rules="countRules" label="Номер группы")
                v-alert(text dense border="left" colored-border type="warning") В поле <strong>Год поступления</strong> указываются последние два цифры года поступления <br>
                    strong Например: 
                            i П-3-16
                v-text-field(v-model="item.group_year" :rules="yearRules" label="Год поступления")
                v-alert(text dense border="left" colored-border type="warning") В поле <strong>Отделение</strong> указывается отделение, к которому прикреплена данная группа <br>
                    strong Например: 
                            i П-3-16 - (09.02.03 Программирование в компьютерных системах)
                v-combobox.my-3(v-model="item.departaments_id" :items="departaments" :rules="specRules" label="Отделение" dense)
                v-combobox.my-3(v-model="item.сurs" :items="curses" :rules="cursRules" label="Текущий курс" dense)
              v-card-actions              
                  v-btn(color="accent darken-1" text @click="clickCancel") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="clickEdit") Сохранить
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "../../../mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      curses: [1, 2, 3, 4, 5],
      departaments: [],
      item: {
        group_name: null,
        group_number: null,
        group_year: null,
        сurs: 1,
        departaments_id: null
      },
      resolve: null,
      codeRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[A-Z && А-Я]*$/.test(v) || "Только буквы в верхнем регистре"
      ],
      countRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[1-9]*$/.test(v) || "Только целочисленные значения (1-9)"
      ],
      yearRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v => /^[1-9]*$/.test(v) || "Только целочисленные значения (1-9)"
      ],
      specRules: [v => !!v || "Поле не должно оставаться пустым"],
      cursRules: [v => !!v || "Поле не должно оставаться пустым"]
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
    clickEdit() {
      if (
        this.item.group_name != null &&
        this.item.group_number != null &&
        this.item.group_year != null &&
        this.item.departaments_id != null
      ) {
        this.dialog = false;
        this.resolve(this.item);
      } else {
        this.showError("Необходимо заполнить ВСЕ имеющиеся поля");
      }
    },
    clickCancel() {
      this.dialog = false;
      this.resolve(false);
    }
  }
};
</script>