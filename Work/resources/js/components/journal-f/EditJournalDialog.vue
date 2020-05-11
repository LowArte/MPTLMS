<template lang="pug">
  v-dialog(v-model="dialog" persistent max-width="600px" v-if="item" )
    v-card
        v-system-bar(color="white")
          span Новый журнал группы {{item.group_name}}
        v-progress-linear(:active="loading" :indeterminate="loading" absolute top  color="success") 
        v-card-text
            v-form(ref="form")
                v-autocomplete(:disabled="loading" v-model="item.teachers_id" label="Преподаватели" :rules="[TeacherRules.required]" outlined dense :items="teachers_combo" @selected no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple clearable)
                  template(v-slot:selection="data")
                    v-chip.ma-1(small dense label color="blue-grey lighten-4") 
                      span {{ !data.item.fullFio ? 'Нет данных для выбора' : data.item.fullFio }}
                v-autocomplete(disabled :label="item.discipline" outlined dense)
                  template(v-slot:selection="data")
                    v-chip.ma-1(small dense label color="blue-grey lighten-4") 
                      span {{ !data.item ? 'Нет данных для выбора' : data.item.discip_name }}
                v-autocomplete(:disabled="loading" v-model="item.isClose"  label="Семестры" outlined dense :items="semesters" no-data-text="Нет данных" item-value='id' item-text='name' clearable)
                  template(v-slot:selection="data")
                    v-chip.ma-1(small dense label color="blue-grey lighten-4") 
                      span {{ !data.item ? 'Нет данных для выбора' : data.item.name }}
        v-card-actions
            v-btn(small text dark color="red" @click="cancelJournal") отмена
            v-spacer
            v-btn(small text dark color="success" @click="saveJournal" :loading="loading" :disabled="loading") сохранить
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           api
//?----------------------------------------------
import api_teacher from "@/js/api/teacher"; //Api преподавателей

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withOverlayLoading, withSnackbar],

  computed: {
    ...mapGetters(["disciplines_combo", "teachers_combo"])
  },

  data() {
    return {
      item: null,
      dialog: false,
      loading: true,
      journal: {
        id: null,
        //Объект для создания журнала (Отправить в бэк на сохранение)
        isClose: null,
        teachers: []
      },
      semesters: [
        { id: 0, name: "Два семестра" },
        { id: 1, name: "Только первый семестр" },
        { id: 2, name: "Только второй семестр" }
      ],
      TeacherRules: {
        required: value => {
          return !!value || "Преподаватель не указан";
        }
      },
      SemesterRules: [v => null || "Семестр не указан"]
    };
  },

  methods: {
    async pop(item) {
      console.log(item);
      this.loading = true;
      this.dialog = !this.dialog;
      this.showLoading("Получение данных");
      this.$store.commit(
        mutations.SET_TEACHERS_COMBO,
        await api_teacher.getTeachers()
      );
      console.log(this.teachers_combo)
      this.item = JSON.parse(JSON.stringify(item));
      console.log(this.item);
      this.closeLoading("Получение данных");
      this.loading = !this.loading;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    async saveJournal() {
      //Сохранение изменений
      if (this.$refs.form.validate()) {
        this.dialog = false;
        this.resolve(this.item);
      } else this.showError("Валидация не пройдена");
    },
    async cancelJournal() {
      this.$refs.form.reset();
      this.dialog = !this.dialog;
    }
  }
};
</script>