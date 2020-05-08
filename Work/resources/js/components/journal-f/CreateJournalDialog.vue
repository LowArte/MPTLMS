<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="600px" v-if="item" )
        v-card(dark)
            v-system-bar(dark color="primary")
                span Новый журнал
            v-progress-linear(:active="loading" :indeterminate="loading" absolute bottom color="success")
            v-card-title {{item.group_name}}
            v-card-text
                v-form(ref="form")
                    v-autocomplete(dack v-model="journal.teacher_id" label="Преподаватель" :rules="[TeacherRules.required]" outlined dense :items="teachers_combo" no-data-text="Нет данных" item-value='id' item-text='fullFio')
                    v-autocomplete(dack v-model="journal.discip_id"  label="Дисциплина" :rules="[DiscipRules.required]" outlined dense :items="disciplines_combo" no-data-text="Нет данных" item-value='id' item-text='discipline_name')
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
      journal: {
        //Объект для создания журнала (Отправить в бэк на сохранение)
        teacher_id: null,
        group_id: null,
        discip_id: null
      },
      TeacherRules: {
        required: value => {
          return !!value || "Преподаватель не указан";
        }
      },
      DiscipRules: {
        required: value => {
          return !!value || "Дисциплина не указана";
        }
      }
    };
  },

  methods: {
    async pop(item) {
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
        await api_discipline.getDisciplines()
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