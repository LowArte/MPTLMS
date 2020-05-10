<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="600px" v-if="item" )
        v-card
            v-system-bar(dark color="primary")
                span Новый журнал
            v-progress-linear(:active="loading" :indeterminate="loading" absolute bottom color="success")
            v-card-title {{item.group_name}}
            v-card-text
                v-form(ref="form")
                    v-autocomplete(v-model="journal.teachers" label="Преподаватели" :items="teachers_combo" :rules="[TeacherRules.required]" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple)
                    v-autocomplete(dack v-model="journal.discip_id"  label="Дисциплина" :rules="DiscipRules" outlined dense :items="disciplines_combo" no-data-text="Нет данных" item-value='id' item-text='discipline_name')
                    v-autocomplete(dack v-model="journal.isClose"  label="Семестры" :rules="SemesterRules" outlined dense :items="semesters" no-data-text="Нет данных" item-value='id' item-text='name')
            v-card-actions
                v-btn(small text dark color="red" @click="dialog = !dialog") отмена
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
import api_discipline from "@/js/api/discipline"; //Api дисциплин

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
      dialog: false,
      item: null,
      loading: false,
      semesters: [{id: 0, name: "Два семестра"}, {id: 1, name: "Только первый семестр"}, {id: 2, name: "Только второй семестр"}],
      journal: {
        //Объект для создания журнала (Отправить в бэк на сохранение)
        isClose: null,
        group_id: null,
        discip_id: null,
        teachers: []
      },
      TeacherRules: {
        required: value => {
          return !!value || "Преподаватель не указан";
        }
      },
      DiscipRules: [v => !!v ||  "Дисциплина не указана"],
      SemesterRules: [v => !!v ||  "Семестры не указаны"]
    };
  },

  methods: {
    async pop(item) {
      console.log(item);
      this.dialog = true;
      this.loading = !this.loading;
      this.item = item;
      this.journal.group_id = this.item.group_id;
      this.showLoading("Получение данных");
      this.$store.commit(
        mutations.SET_TEACHERS_COMBO,
        await api_teacher.getTeachers()
      );
      this.$store.commit(
        mutations.SET_DISCIPLINES_COMBO,
        await api_discipline.getDisciplines({"curs":item.curs, "department_id": item.department_id})
      );
      this.closeLoading("Получение данных");
      this.loading = !this.loading;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },
    async saveJournal() {
      //Сохранение нового журнала
      if (this.$refs.form.validate()) {
        this.dialog = false;
        this.resolve(this.journal);
      } else this.showError("Валидация не пройдена");
    }
  }
};
</script>