<template lang="pug">
  v-content.ma-0.pa-2
    v-layout.column.wrap
        v-flex
          v-card.mx-auto(min-width="300")
            v-system-bar(dark color="info")
              span(style="color: white;") Фильтры
            v-combobox.ma-1(label="Специальность" @change="department_change" no-data-text="Нет данных" item-text="dep_name_full" :items="specialities" v-model="selected_department" )
            v-combobox.ma-1(label="Группа" item-text="group_name" no-data-text="Нет данных" :items="combo_groups" @change="caseDate()" v-model="selected_group")
            v-dialog(ref="dateDialog" v-model="dateDialog.model" :return-value.sync="dateDialog.date" persistent width="290px")
                template(v-slot:activator="{ on }")
                  v-content.pa-2
                    v-text-field(v-model="dateDialog.date" label="Дата" readonly v-on="on")
                v-date-picker(v-model="dateDialog.date" scrollable :first-day-of-week="1" locale="ru-Ru")
                    v-btn(text color="primary" @click="dateDialog.model = false") Отмены
                    v-spacer
                    v-btn(text color="primary" @click="$refs.dateDialog.save(dateDialog.date); caseDate()") Принять
            v-content.pa-1
              c-parser
              router-link(class='nounderline' to="replacements") 
                v-btn(color="accent" text block dark) Замены
        v-layout.row.wrap(v-if="date_week != 0")
            v-flex.my-2.ma-2.col
                v-hover(v-slot:default='{ hover }')
                    v-card.mx-auto.pa-4.pb-0(:elevation='hover ? 12 : 6' min-width="265px")
                        v-card-title.primary-title.pt-0.px-0 Расписание на {{dateDialog.date}} {{ isChisl == 1 ? "Знаменатель" :"Числитель" }}
                        v-container.grid-list-xs.pa-0(v-for="(lesson,lesson_index) in schedule" :key="'l'+lesson_index" v-if="lesson_index < 8 && lesson != null")
                            v-container.pa-0.ma-0(v-if="lesson.chisl == false") <!--Прорисовка обычной пары-->
                                v-btn.ma-0.pa-0(text @click="caseLesson(lesson_index)") 
                                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                                v-card-text.pa-0.wrap.text-black(v-if="lesson.LessonChisl != ''") {{lesson.LessonChisl}} 
                                v-card-text.pa-0.wrap.text-black(v-else) Дополнительное занятие 
                                v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                            v-container.pa-0.ma-0(v-else) <!--Прорисовка числителя/знаменателя-->
                                v-container.pa-0.ma-0(v-if="isChisl == 0")
                                    v-btn.ma-0.pa-0(text @click="caseLesson(lesson_index)") 
                                        v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                                    v-card-text.pa-0.wrap.text-black(v-if="lesson.LessonChisl != ''") {{lesson.LessonChisl}} 
                                    v-card-text.pa-0.wrap.text-black(v-else) Дополнительное занятие 
                                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                                v-container.pa-0.ma-0(v-else)
                                    v-btn.ma-0.pa-0(text @click="caseLesson(lesson_index)") 
                                        v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                                    v-card-text.pa-0.wrap.text-black(v-if="lesson.LessonZnam != ''") {{lesson.LessonZnam}} 
                                    v-card-text.pa-0.wrap.text-black(v-else) Дополнительное занятие 
                                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherZnam }}
            
            v-flex.my-2.ma-2.col
                v-hover(v-slot:default='{ hover }')
                    v-card.mx-auto.pa-4.pb-0(:elevation='hover ? 12 : 6' min-width="265px")
                        v-card-title.primary-title.pt-0.px-0 Формирование замены
                        v-card-text.ma-0.pb-1.pa-0(v-if="replacement.oldlesson == '' || replacement.oldlesson == null") Дополнительное занятие
                        v-form(ref="BildReplacement")
                            v-select.pa-0.mb-2.mt-2(v-model="replacement.caselesson" :rules="numberLessonRules" label="Пара" :items="lessons" @change="caseLesson(replacement.caselesson)")
                            v-switch(v-model="cancel" color="primary" inset label="Отменить занятие!")
                            v-autocomplete.mt-0.pt-2(v-if="!cancel" v-model="replacement.lesson" no-data-text="Нет данных" :rules="[DiscipRules.required]" label="Дисциплины" :items="disciplines_combo" item-text='discip_name' item-value="id" small-chips chips multiple)
                            v-autocomplete(v-if="!cancel" v-model="replacement.teacher" no-data-text="Нет данных" :rules="[TeacherRules.required]" label="Преподаватели" :items="teachers_combo" item-text='fullFio' item-value="id" small-chips chips multiple)
                        v-card-text.pa-2.wrap.text-black(v-if="replacement.oldlesson != '' && replacement.oldlesson != null") Замена для {{replacement.caselesson}} пары
                        v-btn.mb-2.mt-1.justify-center(color="accent" block dark @click="sendQuery") Принять
                        v-divider
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import ConfirmDialog_C from "@/js/components/expention-f/ConfirmDialog"; //Диалог Да/Нет
import Parser_C from "@/js/components/parser-f/Parser"; //Парсер замен

import api_department from "@/js/api/department"; //Расписания звонков
import api_replacement from "@/js/api/replacement"; //api замен
import api_schedule from "@/js/api/schedule"; //Api расписания
import api_teacher from "@/js/api/teacher"; //Api преподавателей
import api_discipline from "@/js/api/discipline"; //Api дисциплин

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withSnackbar, withOverlayLoading],
  components: {
    "c-comfirm-dialog": ConfirmDialog_C,
    "c-parser" : Parser_C
  },

  computed: {
    ...mapGetters(["specialities", "groups_combo", "teachers_combo", "disciplines_combo", "timetable_full"]),
    
    combo_groups: function() {
      if (!this.groups_combo) return undefined;
      this.selected_group = this.groups_combo[0];
      return this.groups_combo;
    },

    //*Получение четности недели
    isChisl: function() {
     var year = new Date().getFullYear();
      var month = new Date().getMonth();
      var today = new Date(this.dateDialog.date).getTime();
      var week = Math.round(today / (1000 * 60 * 60 * 24 * 7));
      return week % 2;
    }
  },

  data() {
    return {
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
      },
      schedule: null, //Расписание выбранного дня
      schedule_bild: null, //Расписание выбранного дня
      selected_department: null,
      selected_group: null,
      week: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
      replacements: null, //Замены
      date_week: 0,
      dateDialog: {
        model: false,
        date: new Date().toISOString().substr(0, 10)
      } //Диалог даты
    }
  },

  beforeMount()
  {
    this.getDepartments();
    this.getTeachers();
  }, 

 methods: {
//?----------------------------------------------
//!           Методы страницы
//?----------------------------------------------
    //*Получение всех преподавателей
    async getTeachers()
    {
      this.showLoading("Получение преподавателей");
      if(this.teachers_combo == null)
      {
        let items = await api_teacher.getTeachers();
        this.$store.commit(mutations.SET_TEACHERS_COMBO, items)
      }
      this.closeLoading("Получение преподавателей");
    },

    //*Получение всех дисциплин
    async getDisciplines()
    {
      let items = await api_discipline.getDisciplines({"curs": this.selected_group.curs, "department_id": this.selected_department.id});
      this.$store.commit(mutations.SET_DISCIPLINES_COMBO, items)
    },

    //*Получение отделений для выпадающего списка
    async getDepartments()
    {
      if (!this.specialities) {
        this.showLoading("Получение отделений");
        let items = await api_department.getDepartments();
        this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);
        this.closeLoading("Получение отделений");
      }

      if (this.specialities) 
      {
        this.selected_department = this.specialities[0];
        this.department_change();
      }
    },

    //Перевод массив для вывода
    parseReplacement() 
    {
      this.arrgroups = [];
      this.date = [];
      this.parseReplacements = [];
      var j = -1; //Индекс группы
      var l = -1; //Индекс даты
      for (var i = 0; i < this.replacements.length; i++) 
      {
        this.replacements[i]["swap"] = JSON.parse(this.replacements[i]["swap"]);
        this.replacements[i]["swap"]["lesson"] = this.replacements[i]["swap"]["lesson"].join(" / ");
        this.replacements[i]["swap"]["oldlesson"] = this.replacements[i]["swap"]["oldlesson"].join(" / ");
        this.replacements[i]["swap"]["teacher"] = this.replacements[i]["swap"]["teacher"].join(" / ");
        this.replacements[i]["swap"]["oldteacher"] = this.replacements[i]["swap"]["oldteacher"].join(" / ");
        
        j = this.arrgroups.indexOf(this.replacements[i]["group_name"]);
        if (j == -1) 
        {
          this.arrgroups.push(this.replacements[i]["group_name"]);
          this.date.push([this.replacements[i]["swap_date"]]);
          this.parseReplacements.push([[this.replacements[i]]]);
        } 
        else 
        {
          l = this.date[j].indexOf(this.replacements[i]["swap_date"]);
          if (l == -1) 
          {
            this.date[j].push(this.replacements[i]["swap_date"]);
            this.parseReplacements[j].push([this.replacements[i]]);
          } 
          else 
          this.parseReplacements[j][l].push(this.replacements[i]);
        }
      }
    },

    //Парсировка данных для вывода, перевод массивов с данными в строки для вывода
    parseSchedule() 
    {
      if (this.schedule != null) 
      {
        for (var j = 1; j <= 7; j++) 
        {
          this.schedule[j]["LessonChisl"] = this.schedule[j]["LessonChisl"].join(" / ");
          this.schedule[j]["LessonZnam"] = this.schedule[j]["LessonZnam"].join(" / ");
          this.schedule[j]["TeacherChisl"] = this.schedule[j]["TeacherChisl"].join(" / ");
          this.schedule[j]["TeacherZnam"] = this.schedule[j]["TeacherZnam"].join(" / ");
        }
      }
      if (this.replacement.caselesson != "")
        this.caseLesson(this.replacement.caselesson);
    },
    //*Получение 
    async schedules() 
    {
      if (this.selected_group == null) return undefined;
      let schedule = this.timetable_full.filter(res => {
        if (res.group_id == this.selected_group.id) return true;
        else return false;
      });

      if (schedule.length == 0) 
      {
        schedule = await api_schedule.getScheduleByGroupId(this.selected_group.id);
        schedule["group_id"] = this.selected_group.id;
        this.$store.commit(mutations.SET_TIMETABLE_FULL, schedule);
      } 
      else 
        schedule = schedule[0];
      return schedule;
    },
//?----------------------------------------------
//!           Методы компонентов
//?----------------------------------------------
    //Получение группы при изменении отделения
    async department_change() 
    {
      this.showLoading("Получение групп");
      await this.$store.dispatch(actions.ADD_CACHE_GROUP_DATA, 
      {
        context: this,
        result: this.selected_department.id
      });
      this.closeLoading("Получение групп");

      if (this.combo_groups) 
      {
        this.selected_group = this.combo_groups[0];
        this.group_change();
      }
    },

    //*Получение расписания при изменении выбранной группы
    async group_change() 
    {
      this.getDisciplines();
      this.caseDate();
    },

    //*При выборе даты получать расписание выбранного дня, если воскресенье то за день
    async caseDate() 
    {
      this.showLoading("Получение расписания");
      this.date_week = new Date(this.dateDialog.date).getDay();
      if (this.date_week == 0) 
      {
        this.dateDialog.date = new Date(new Date(this.dateDialog.date).getTime() - 24 * 60 * 60 * 1000).toISOString().substr(0, 10);
        this.$refs.dateDialog.save(this.dateDialog.date);
        this.showInfo("Данные отсутствуют!");
        this.caseDate();
      } 
      else 
      {
        this.schedule = await JSON.parse(JSON.stringify(await this.schedules()));
        if(this.schedule)
        {
            this.schedule = this.schedule[this.week[this.date_week]];
            this.parseSchedule();
        }

        this.schedule_bild = await api_schedule.getScheduleBildByGroupId(this.selected_group.id);
        if(this.schedule_bild)
            this.schedule_bild = this.schedule_bild[this.week[this.date_week]];
      }
      this.closeLoading("Получение расписания");
    },

    //Выбор пары
    caseLesson(number) 
    {
      this.replacement.caselesson = number;
      if (this.schedule != null)
        if (!this.schedule[number].chisl) 
        {
          this.replacement.oldlesson = this.schedule_bild[number].LessonChisl;
          this.replacement.oldteacher = this.schedule_bild[number].TeacherChisl;
        } 
        else 
        {
          if (this.isChisl == 0) {
            this.replacement.oldlesson = this.schedule_bild[number].LessonChisl;
            this.replacement.oldteacher = this.schedule_bild[number].TeacherChisl;
          } 
          else 
          {
            this.replacement.oldlesson = this.schedule_bild[number].LessonZnam;
            this.replacement.oldteacher = this.schedule_bild[number].TeacherZnam;
          }
        }
    },

    //Сохранение замены
    async sendQuery() 
    {
      if (this.cancel && this.replacement.oldlesson.length == 0)
        this.showInfo("Нельзя отменить пару, которой нет!");
      else 
      if (this.$refs.BildReplacement.validate()) 
      {
        if (this.cancel) 
        {
          this.replacement.lesson = [];
          this.replacement.teacher = [];
        }
        if(await api_replacement.saveReplacements({group_id: this.selected_group.id, replacement: this.replacement, date: this.dateDialog.date}))
        {
          this.showMessage("Выполнено!");
          this.$refs.BildReplacement.reset();
        }
      } 
      else this.showError("Форма заполнена не верно!");
    },
 }
};
</script>