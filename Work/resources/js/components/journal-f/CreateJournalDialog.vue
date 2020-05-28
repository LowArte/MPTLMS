<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="600px" v-if="item" )
        v-card
            v-system-bar(color="white")
              span Новый журнал группы {{item.group_name}}
            v-progress-linear(:active="loading" :indeterminate="loading" absolute top  color="success") 
            v-card-text.pt-2
                v-alert(v-if="alert" type="error"  border="left" elevation="3" colored-border color="red") Такой журнал уже существует.
                v-form(ref="form")
                    v-autocomplete(:disabled="loading" v-model="journal.teachers" label="Преподаватели" :rules="[TeacherRules.required]" outlined dense :items="teachers_combo" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple clearable)
                      template(v-slot:selection="data")
                        v-chip.ma-1(small dense label color="blue-grey lighten-4") 
                          span {{ !data.item.fullFio ? 'Нет данных для выбора' : data.item.fullFio }}
                    v-autocomplete(:disabled="loading" v-model="journal.discip_id"  label="Дисциплина" :rules="DiscipRules" outlined dense :items="disciplines_combo" no-data-text="Нет данных" item-value='id' item-text='discip_name' clearable)
                      template(v-slot:selection="data")
                        v-chip.ma-1(small dense label color="blue-grey lighten-4") 
                          span {{ !data.item ? 'Нет данных для выбора' : data.item.discip_name }}
                    v-autocomplete(:disabled="loading" v-model="journal.isClose"  label="Семестры" outlined dense :items="semesters" no-data-text="Нет данных" item-value='id' item-text='name' clearable)
                      template(v-slot:selection="data")
                        v-chip.ma-1(small dense label color="blue-grey lighten-4") 
                          span {{ !data.item ? 'Нет данных для выбора' : data.item.name }}
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
    ...mapGetters(["disciplines_combo", "teachers_combo", "groups_journal", 'groups_subgects'])
  },
  data() {
    return {
      dialog: false,
      item: null,
      alert: false,
      loading: false,
      semesters: [
        { id: 0, name: "Два семестра" },
        { id: 1, name: "Только первый семестр" },
        { id: 2, name: "Только второй семестр" }
      ],
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
      DiscipRules: [v => !!v || "Дисциплина не указана"],
      SemesterRules: [v => !!v || "Семестр не указан"]
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
        await api_discipline.getDisciplines({
          curs: item.curs,
          department_id: item.department_id
        })
      );
      this.closeLoading("Получение данных");
      this.loading = !this.loading;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    //Сохранение нового журнала
    async saveJournal() {
      if (this.$refs.form.validate()) {
        if (this.fingJournal()) {
          this.dialog = false;
          this.alert = false;
          await this.resolve(JSON.parse(JSON.stringify(this.journal)));
          this.$refs.form.reset();
        } else this.alert = true;
      } else this.showError("Валидация не пройдена");
    },

    fingJournal() {
      let check = true;
      this.groups_subgects.forEach(element => {
        if (element.discip_id == this.journal.discip_id && !this.journal.isClose) {
          check = false;
        }
      });
      return check;
    }
  }
};
</script>