<template lang="pug">
    v-layout.column.wrap
        v-flex.ma-2.mb-0.pa-0.row
            v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
            v-combobox.ma-1(label="Группа" item-text="group_name" :items="groups_info.groups" @change="caseDate()" v-model="groups_info.selected_group")
        v-flex.ma-2.mt-0.pa-0.row
            v-dialog(ref="dateDialog" v-model="dateDialog.model" :return-value.sync="dateDialog.date" persistent width="290px")
                template(v-slot:activator="{ on }")
                    v-text-field(v-model="dateDialog.date" label="Дата" readonly v-on="on")
                v-date-picker(v-model="dateDialog.date" scrollable :first-day-of-week="1" locale="ru-Ru")
                    v-btn(text color="primary" @click="dateDialog.model = false") Отмены
                    v-btn(text color="primary" @click="$refs.dateDialog.save(dateDialog.date); caseDate()") Принять
        v-layout.row.wrap(v-if="date_week != 0")
            v-flex.my-2.ma-2.col
                v-hover(v-slot:default='{ hover }')
                    v-card.mx-auto.pa-4.pb-0(:elevation='hover ? 12 : 6' min-width="265px")
                        v-card-title.primary-title.pt-0.px-0 Расписание на {{dateDialog.date}} {{ isToday ==0 ? "Числитель" :"Знаменатель" }}
                        v-container.grid-list-xs.pa-0(v-for="(lesson,lesson_index) in schedule" :key="'l'+lesson_index" v-if="lesson_index < 8 && lesson != null")
                            v-container.pa-0.ma-0(v-if="lesson.chisl == false") <!--Прорисовка обычной пары-->
                                v-btn.ma-0.pa-0(text @click="caseLesson(lesson_index)") 
                                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                                v-card-text.pa-0.wrap.text-black(v-if="lesson.LessonChisl != ''") {{lesson.LessonChisl}} 
                                v-card-text.pa-0.wrap.text-black(v-else) Дополнительное занятие 
                                v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                            v-container.pa-0.ma-0(v-else) <!--Прорисовка числителя/знаменателя-->
                                v-container.pa-0.ma-0(v-if="isToday == 0")
                                    v-btn.ma-0.pa-0(text @click="caseLesson(lesson_index)") 
                                        v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                                    v-card-text.pa-0.wrap.text-black(v-if="lesson.LessonChisl != ''") {{lesson.LessonChisl}} 
                                    v-card-text.pa-0.wrap.text-black(v-else) Дополнительное занятие 
                                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                                    v-divider.ma-0
                                v-container.pa-0.ma-0(v-else)
                                    v-btn.ma-0.pa-0(text @click="caseLesson(lesson_index)") 
                                        v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                                    v-card-text.pa-0.wrap.text-black(v-if="lesson.LessonZnam != ''") {{lesson.LessonZnam}} 
                                    v-card-text.pa-0.wrap.text-black(v-else) Дополнительное занятие 
                                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherZnam }}
                                    v-divider.ma-0
            
            v-flex.my-2.ma-2.col
                v-hover(v-slot:default='{ hover }')
                    v-card.mx-auto.pa-4.pb-0(:elevation='hover ? 12 : 6' min-width="265px")
                        v-card-title.primary-title.pt-0.px-0 Формирование замены
                        v-card-text.ma-0.pb-1.pa-0(v-if="replacement.oldlesson == '' || replacement.oldlesson == null") Дополнительное занятие
                        v-form(ref="BildReplacement")
                            v-select.pa-0.mb-2.mt-2(v-model="replacement.caselesson" :rules="numberLessonRules" label="Пара" :items="lessons" @change="caseLesson(replacement.caselesson)")
                            v-switch(v-model="cancel" color="primary" inset label="Отменить занятие!")
                            v-autocomplete.mt-0.pt-2(v-if="!cancel" v-model="replacement.lesson" :rules="[DiscipRules.required]" label="Дисциплины" :items="disciplines_combo" item-text='discipline_name' item-value="id" small-chips chips multiple)
                            v-autocomplete(v-if="!cancel" v-model="replacement.teacher" :rules="[TeacherRules.required]" label="Преподаватели" :items="teachers_combo" item-text='fullFio' item-value="id" small-chips chips multiple)
                        v-card-text.pa-2.wrap.text-black(v-if="replacement.oldlesson != '' && replacement.oldlesson != null") Замена для {{replacement.caselesson}} пары
                        v-btn.mb-2.mt-1.justify-center(color="accent" block dark @click="sendQuery") Принять
                        v-divider
</template>

<script>
import schedule_api from "@/js/api/schedule"; //Api расписания
import group_api from "@/js/api/group"; //api групп
import replacements_api from "@/js/api/replacements"; //api замен
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import teacher_api from "@/js/api/teacher"; //Api преподавателей
import discipline_api from "@/js/api/discipline"; //Api дисциплин
import departament_api from "@/js/api/departments"; //Api отделения
Date.prototype.getWeek = function() {
  const onejan = new Date(this.getFullYear(), 0, 1);
  return Math.ceil(((this - onejan) / 86400000 + 1) / 7);
};

import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["specialities_combo", "teachers_combo", "disciplines_combo"]),
  },
  post_name: {
    name: "Замены расписания",
    url: "bild_replacements"
  },
  data: () => ({
    typeReplacement: 1,
    cancel: false,
    numberLessonRules: [v => !!v || "Пара не указана!"],
    TeacherRules: {
      required: value => {
        return !!value.length || "Преподаватель не указан!";
      }
    },
    DiscipRules: {
      required: value => {
        return !!value.length || "Дисциплина не указана!";
      }
    },
    lessons: ["1", "2", "3", "4", "5", "6", "7"],
    replacement: {
      caselesson: "",
      lesson: [],
      teacher: [],
      oldlesson: [],
      oldteacher: []
    }, //Замена которая потом будет сохранена
    groups_info: { groups: null, selected_group: null }, //Группы
    departaments_info: { departaments: null, selected_departament: null }, //Отделения
    schedule: null, //Расписание выбранного дня
    schedule_bild: null, //Расписание выбранного дня
    week: [
      "Воскресенье",
      "Понедельник",
      "Вторник",
      "Среда",
      "Четверг",
      "Пятница",
      "Суббота"
    ], //Неделя
    isToday: null, //Текущая четность недели
    date_week: 0,
    disciplines: [],
    teachers: [],
    dateDialog: {
      model: false,
      date: new Date().toISOString().substr(0, 10)
    } //Диалог даты
  }),

  methods: {
    //Получение отделений
    async getDepartament()
    {
      this.showLoading("Получение отделений");
      if (this.specialities_combo == null)
      {
        this.departaments_info.departaments = await departament_api.getDepartmentsForCombobox(this);
        this.$store.commit(mutations.SET_SPECIALITIES_COMBO,this.departaments_info.departaments);
      }
      else
        this.departaments_info.departaments = this.specialities_combo;

      if(this.departaments_info.departaments)
      {
        this.departaments_info.selected_departament = this.departaments_info.departaments[0];
        this.departament_change();
      }
      this.closeLoading("Получение отделений");
    }, 

    //Получение всех преподавателей
    async getTeachers() 
    {
      if(this.teachers_combo == null)
      {
        this.showLoading("Получение преподавателей");
        let items = await teacher_api.getTeachers(this);
        this.$store.commit(mutations.SET_TEACHERS_COMBO, items)
        this.closeLoading("Получение преподавателей");
      }
    },

    //Получение всех дисциплин
    async getDisciplines() 
    {
      if(this.disciplines_combo == null)
      {
        this.showLoading("Получение дисциплин");
        let items = await discipline_api.getDisciplines(this);
        this.$store.commit(mutations.SET_DISCIPLINES_COMBO, items)
        this.closeLoading("Получение дисциплин");
      }
    },

    //Определение числителя
    isChisl() {
      var today = new Date(
        new Date(this.dateDialog.date).getTime() + 8 * (24 * 60 * 60 * 1000)
      );
      return today.getWeek() % 2;
    },

    //Получение групп при изменении отдела
    async departament_change() 
    {
      this.groups_info.groups = await group_api.getGroupsByDepartamentId(
        this.departaments_info.selected_departament.id, this
      );
      if (this.groups_info.groups) 
      {
        this.groups_info.selected_group = this.groups_info.groups[0];
        this.caseDate();
      }
    },

    //При выборе даты получать расписание выбранного дня, если воскресенье то за день
    async caseDate() 
    {
      this.showLoading("Получение расписания");
      this.date_week = new Date(this.dateDialog.date).getDay();
      if (this.date_week == 0) {
        this.dateDialog.date = new Date(
          new Date(this.dateDialog.date).getTime() - 24 * 60 * 60 * 1000
        )
          .toISOString()
          .substr(0, 10);
        this.$refs.dateDialog.save(this.dateDialog.date);
        this.showInfo("Данные отсутствуют!");
        this.caseDate();
      } 
      else 
      {
        this.schedule = await schedule_api.getScheduleByGroupId(this.groups_info.selected_group.id, this);
        if(this.schedule)
        {
            this.schedule = this.schedule[this.week[this.date_week]];
            this.parseSchedule();
        }

        this.schedule_bild = await schedule_api.getScheduleBildByGroupId(this.groups_info.selected_group.id, this);
        if(this.schedule_bild)
            this.schedule_bild = this.schedule_bild[this.week[this.date_week]];
      }
      this.closeLoading();
    },

    //Сохранение замены
    async sendQuery() {
      if (this.cancel && this.replacement.oldlesson.length == 0)
        this.showInfo("Нельзя отменить пару, которой нет!");
      else if (this.$refs.BildReplacement.validate()) {
        if (this.cancel) {
          this.replacement.lesson = [];
          this.replacement.teacher = [];
        }
        await replacements_api.saveReplacements({
          group_id: this.groups_info.selected_group.id,
          replacement: this.replacement,
          date: this.dateDialog.date
        }, this);
      } else this.showError("Форма заполнена не верно!");
    },

    //Выбор пары
    caseLesson(number) {
      this.replacement.caselesson = number;
      if (this.schedule != null)
        if (!this.schedule[number].chisl) {
          this.replacement.oldlesson = this.schedule_bild[number].LessonChisl;
          this.replacement.oldteacher = this.schedule_bild[number].TeacherChisl;
        } else {
          if (this.isChisl() == 0) {
            this.replacement.oldlesson = this.schedule_bild[number].LessonChisl;
            this.replacement.oldteacher = this.schedule_bild[
              number
            ].TeacherChisl;
          } else {
            this.replacement.oldlesson = this.schedule_bild[number].LessonZnam;
            this.replacement.oldteacher = this.schedule_bild[
              number
            ].TeacherZnam;
          }
        }
    },

    //Формирование расписания для вывода
    parseSchedule() {
      this.isToday = this.isChisl();
      if (this.schedule != null)
        for (var j = 1; j <= 7; j++) {
          if (Array.isArray(this.schedule[j]["LessonChisl"]))
            this.schedule[j]["LessonChisl"] = this.schedule[j][
              "LessonChisl"
            ].join(" / ");
          if (Array.isArray(this.schedule[j]["LessonZnam"]))
            this.schedule[j]["LessonZnam"] = this.schedule[j][
              "LessonZnam"
            ].join(" / ");
          if (Array.isArray(this.schedule[j]["TeacherChisl"]))
            this.schedule[j]["TeacherChisl"] = this.schedule[j][
              "TeacherChisl"
            ].join(" / ");
          if (Array.isArray(this.schedule[j]["TeacherZnam"]))
            this.schedule[j]["TeacherZnam"] = this.schedule[j][
              "TeacherZnam"
            ].join(" / ");
        }

      if (this.replacement.caselesson != "")
        this.caseLesson(this.replacement.caselesson);
    }
  },

  //Получение данных для работы на странице
  beforeMount() {
    this.date_week = new Date(this.dateDialog.date).getDay();
    this.getDepartament();
    this.parseSchedule();
    this.getDisciplines();
    this.getTeachers();
  },
};
</script>