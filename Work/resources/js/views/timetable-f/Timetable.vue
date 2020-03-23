<template lang="pug">
  v-layout.column.wrap
    v-flex.ma-2.mt-0.row
    v-flex.ma-2.mb-0.row
        v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
        v-combobox.ma-1.mb-0(label="Группа" @change="group_change" item-text="group_name" :items="groups_info.groups"  v-model="groups_info.selected_group")
    v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition" v-if="_schedule_bild != null")
      template(v-slot:activator="{ on }")
        v-btn.ma-3(color="accent" text block dark v-on="on") {{titleDialog}}
      v-card
        v-toolbar(dark color="primary")
          v-btn(icon dark @click="dialog = false; group_change()")
            v-icon mdi-close
          v-toolbar-title {{titleDialog}}
          v-spacer
        c_bildTimetable.pa-2(:_departaments_info="_departaments_info" 
                        :_groups_info="_groups_info" 
                        :_schedule_bild="_schedule_bild"
                        :_places="_places"
                        :_disciplines="_disciplines"
                        :_teachers="_teachers")
    v-card-title.primary-title.pt-0.px-0.ml-3
        v-chip.pa-2.ml-3(label) 
          v-card-title.pa-0.accent--text.font-weight-light.text-truncate.title Неделя {{ isToday ==0 ? "Числитель" :"Знаменатель" }}
    v-layout.row.wrap
      v-flex.ma-2(v-for="(day_key,day_index) in days" :key="day_index")
        v-hover(v-slot:default='{ hover }')
          v-card.pa-2.pb-0.mx-auto(:elevation='hover ? 12 : 6'  min-width="265px" max-width="265px" style="display: flex; flex-direction: column;")
            v-card-title.primary-title.pt-0.px-0.pb-5 {{day_key}} 
            v-card-subtitle.px-0.pt-0.pb-0 {{schedule[day_key].Place.place_name}} 
            v-divider
            v-container.grid-list-xs.pa-0(v-for="(lesson,lesson_index) in schedule[day_key]" :key="'l'+lesson_index")
                v-container.pa-0.ma-0(v-if="lesson.chisl == false") <!--Прорисовка обычной пары-->
                  v-container.pa-0.ma-0(v-if="lesson.LessonChisl != null && lesson.LessonChisl != ''")
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonChisl}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                v-container.pa-0.ma-0(v-else) <!--Прорисовка числителя/знаменателя-->
                  v-container.pa-0.ma-0(v-if="isToday == 0")
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonChisl}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                    v-divider.ma-0(v-if="lesson.LessonZnam!= null && lesson.LessonZnam != ''")
                    v-expansion-panels.px-1.py-0(v-if="lesson.LessonZnam!= null" style="z-index: initial;")                    
                      v-expansion-panel.px-1.py-0
                          v-expansion-panel-header.px-1.py-0 {{ isToday == 0 ? "Знаменатель" :"Числитель" }}                 
                          v-expansion-panel-content.px-0.mx-0
                            v-card-text.pa-0.wrap.text-black {{ lesson.LessonZnam }} 
                            v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherZnam }}
                    v-divider.ma-0(v-if="lesson.LessonZnam!= null")
                  v-container.pa-0.ma-0(v-else)
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonZnam}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherZnam }}
                    v-expansion-panels.px-1.py-0(v-if="lesson.LessonChisl!= null && lesson.LessonChisl != ''" style="z-index: initial;")                    
                      v-expansion-panel.px-1.py-0
                          v-expansion-panel-header.px-1.py-0 {{ isToday == 0 ? "Знаменатель" :"Числитель" }}                 
                          v-expansion-panel-content.px-0.mx-0
                            v-card-text.pa-0.wrap.text-black {{ lesson.LessonChisl }} 
                            v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                    v-divider.ma-0
</template>

<style scoped>
.v-expansion-panel-content__wrap {
  padding: 0;
}
</style>

<script>
import group_api from "./../../api/group"; //Api групп
import schedule_api from "./../../api/schedule"; //Api расписания
import withSnackbar from "../mixins/withSnackbar"; //Alert
import bildTimetable from "./Bild_Timetable"; //Конструктор замен
Date.prototype.getWeek = function() {
  const onejan = new Date(this.getFullYear(), 0, 1);
  return Math.ceil(((this - onejan) / 86400000 + 1) / 7);
};

export default {
  mixins: [withSnackbar],

  components: {
    c_bildTimetable: bildTimetable
  },

  data: () => {
    return {
      groups_info: null, //Группы
      departaments_info: null, //Отделения
      schedule: null, //Расписание
      isToday: null, //Текущий день
      titleDialog: "Конструктор расписания",
      dialog: false,
      days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"] //Дни недели
    };
  },

  props: {
    _departaments_info: {
      type: Object,
      default: null
    }, //Отделения
    _groups_info: {
      type: Object,
      default: null
    }, //Группы
    _schedule: {
      type: Object,
      default: null
    }, //Расписания
    _places: {
      type: Array,
      default: null
    }, //Места проведений
    _teachers: {
      type: Array,
      default: null
    }, //Преподаватели
    _disciplines: {
      type: Array,
      default: null
    }, //Дисциплины
    _schedule_bild: {
      type: Object,
      default: null
    } //Расписание
  },

  methods: {
    //Получение группы при изменении отделения
    departament_change() {
      group_api
        .getGroupsByDepartamentId(this.departaments_info.selected_departament.id)
        .then(res => {
          this.groups_info.groups = res.data.groups_info.groups;
          this.groups_info.selected_group = this.groups_info.groups[0];
          this.group_change();
        })
        .catch(ex => {
          this.showError(ex);
        });
    },

    //Определение числителя
    isChisl() {
      var today = new Date(new Date().getTime() + 8 * (24 * 60 * 60 * 1000));
      return today.getWeek() % 2;
    },

    //Получение расписания при изменении выбранной группы
    group_change() {
      schedule_api
        .getScheduleByGroupId(this.groups_info.selected_group.id)
        .then(res => {
          this.schedule = res.data.schedule;
          this.parseSchedule();
        })
        .catch(ex => {
          this.showError(ex);
        });
    },

    //Парсировка данных для вывода, перевод массивов с данными в строки для вывода
    parseSchedule() {
      var tag = 0;
      for (var i = 0; i < this.days.length; i++) {
        for (var j = 1; j <= 7; j++) {
          if (Array.isArray(this.schedule[this.days[i]][j]["LessonChisl"]))
            this.schedule[this.days[i]][j]["LessonChisl"] = this.schedule[
              this.days[i]
            ][j]["LessonChisl"].join(" / ");
          if (Array.isArray(this.schedule[this.days[i]][j]["LessonZnam"]))
            this.schedule[this.days[i]][j]["LessonZnam"] = this.schedule[
              this.days[i]
            ][j]["LessonZnam"].join(" / ");
          if (Array.isArray(this.schedule[this.days[i]][j]["TeacherChisl"]))
            this.schedule[this.days[i]][j]["TeacherChisl"] = this.schedule[
              this.days[i]
            ][j]["TeacherChisl"].join(" / ");
          if (Array.isArray(this.schedule[this.days[i]][j]["TeacherZnam"]))
            this.schedule[this.days[i]][j]["TeacherZnam"] = this.schedule[
              this.days[i]
            ][j]["TeacherZnam"].join(" / ");

          if (
            (this.schedule[this.days[i]][j]["LessonChisl"] == null &&
              this.schedule[this.days[i]][j]["LessonZnam"] == null) ||
            (this.schedule[this.days[i]][j]["LessonChisl"] == "" &&
              this.schedule[this.days[i]][j]["LessonZnam"] == "") ||
            (this.schedule[this.days[i]][j]["LessonChisl"] == null &&
              this.schedule[this.days[i]][j]["LessonZnam"] == "") ||
            (this.schedule[this.days[i]][j]["LessonChisl"] == "" &&
              this.schedule[this.days[i]][j]["LessonZnam"] == null)
          )
            tag++;

          if (tag >= 7) {
            this.schedule[this.days[i]][1]["LessonChisl"] = "Домашнее обучение";
            this.schedule[this.days[i]][1]["time"] = "Весь день";
            this.schedule[this.days[i]]["Place"] = [];
          }
        }
        tag = 0;
      }
    }
  },

  //Преднастройка
  beforeMount() {
    this.groups_info = this._groups_info;
    this.departaments_info = this._departaments_info;
    this.schedule = this._schedule;
    this.isToday = this.isChisl();
    this.parseSchedule();
  }
};
</script>