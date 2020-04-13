<template lang="pug">
  v-layout.column.wrap
    v-flex.ma-2.mt-0.row
      c_panel_control(ref="panel")
    v-flex.ma-2.mb-0.row
        v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
        v-combobox.ma-1.mb-0(label="Группа" @change="group_change" item-text="group_name" :items="groups_info.groups" v-model="groups_info.selected_group")
    v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
      template(v-slot:activator="{ on }")
        v-btn.ma-3(color="accent" text block dark v-on="on") {{titleDialog}}
      v-card
        v-toolbar(dark color="primary")
          v-btn(icon dark @click="dialog = false; group_change()")
            v-icon mdi-close
          v-toolbar-title {{titleDialog}}
          v-spacer
        c_bildTimetable.pa-2()
    v-chip.mx-2(v-if="isToday != 0" label color="info") Знаменатель
    v-chip.mx-2(v-if="isToday == 0" label color="accent") Числитель
    v-layout.row.wrap
      v-flex.ma-2(v-for="(day_key,day_index) in days" :key="day_index" v-if="schedule != null")
        v-hover(v-slot:default='{ hover }')
          v-card.pa-2.pb-0.mx-auto(:elevation='hover ? 12 : 6'  min-width="265px" max-width="265px" style="display: flex; flex-direction: column;")
            v-card-title.primary-title.pt-0.px-0.pb-5 {{day_key}} 
            v-card-subtitle.px-0.pt-0.pb-0 {{schedule[day_key].Place.place_name}} 
            v-divider
            v-container.grid-list-xs.pa-0(v-for="(lesson,lesson_index) in schedule[day_key]" :key="'l'+lesson_index")
                v-container.pa-0.ma-0(v-if="lesson.chisl == false && lesson_index != 'Place'") <!--Прорисовка обычной пары-->
                  v-container.pa-0.ma-0(v-if="lesson.LessonChisl != null && lesson.LessonChisl != ''")
                    v-divider.ma-0.pa-0(v-if="lesson_index != 1")
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonChisl}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                v-container.pa-0.ma-0(v-else-if="lesson_index != 'Place'") <!--Прорисовка числителя/знаменателя-->
                  v-container.pa-0.ma-0(v-if="isToday == 0 && (lesson.LessonChisl !='' || lesson.LessonZnam !='')")
                    v-divider.ma-0.pa-0(v-if="lesson_index != 1")
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonChisl}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                    v-expansion-panels.pa-0(v-if="lesson.LessonZnam!= null && lesson.LessonZnam != ''" style="z-index: initial;")                    
                      v-expansion-panel.pa-0
                          v-expansion-panel-header.px-1.py-0 {{ isToday == 0 ? "Знаменатель" :"Числитель" }}                 
                          v-expansion-panel-content.px-0.mx-0(v-if="lesson.LessonZnam != ''")
                            v-card-text.pa-0.wrap.text-black {{ lesson.LessonZnam }} 
                            v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherZnam }}
                          v-expansion-panel-content.px-0.mx-0(v-else)
                            v-card-text.pa-0.wrap.text-black Отсутствует
                  v-container.pa-0.ma-0(v-else-if="lesson.LessonChisl !='' || lesson.LessonZnam !=''")
                    v-divider.ma-0.pa-0(v-if="lesson_index != 1")
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonZnam}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherZnam }}
                    v-expansion-panels.pa-0(v-if="lesson.LessonChisl!= null && lesson.LessonChisl != ''" style="z-index: initial;")                    
                      v-expansion-panel.pa-0
                          v-expansion-panel-header.px-1.py-0 {{ isToday == 0 ? "Знаменатель" :"Числитель" }}                 
                          v-expansion-panel-content.px-0.mx-0(v-if="lesson.LessonChisl != ''")
                            v-card-text.pa-0.wrap.text-black {{ lesson.LessonChisl }} 
                            v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                          v-expansion-panel-content.px-0.mx-0(v-else)
                            v-card-text.pa-0.wrap.text-black Отсутствует
</template>

<style scoped>
.v-expansion-panel-content__wrap {
  padding: 0;
}
</style>

<script>
import callSchedule_api from "@/js/api/callSchedule"; //Api мест проведений
import departament_api from "@/js/api/departments"; //Api отделения
import group_api from "@/js/api/group"; //Api групп
import schedule_api from "@/js/api/schedule"; //Api расписания
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading
import bildTimetable from "@/js/views/timetable-f/Bild_Timetable"; //Конструктор замен
import PanelControl_C from '@/js/components/expention-f/Panel'; //Панель для вывода расписания

Date.prototype.getWeek = function() {
  const onejan = new Date(this.getFullYear(), 0, 1);
  return Math.ceil(((this - onejan) / 86400000 + 1) / 7);
};

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["specialities_combo"]),
  },
  mixins: [withSnackbar, withOverlayLoading],
  post_name: {
    name: "Учебное расписание",
    url: "timetableRoot"
  },
  components: {
    c_bildTimetable: bildTimetable,
    c_panel_control: PanelControl_C,
  },

  data: () => {
    return {
      groups_info: {groups:null, selected_group:null}, //Группы
      departaments_info: {departaments:null, selected_departament:null}, //Отделения
      schedule: null, //Расписание
      isToday: null, //Текущий день
      titleDialog: "Конструктор расписания",
      dialog: false,
      days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"] //Дни недели
    };
  },

  methods: {
    //Получение панели с расписанием 
    async getCallScheduleForPanel()
    {
      this.showLoading("Получение расписания звонков");
      this.$refs.panel.loadData(await callSchedule_api.getCallScheduleForPanel(this));
      this.closeLoading("Получение расписания звонков");
    },

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

      this.closeLoading("Получение отделений");

      if(this.departaments_info.departaments)
      {
        this.departaments_info.selected_departament = this.departaments_info.departaments[0];
        this.departament_change();
      }
    }, 

    //Получение группы при изменении отделения
    async departament_change() 
    {
      this.showLoading("Получение групп");
      this.groups_info.groups = await group_api.getGroupsByDepartamentId(this.departaments_info.selected_departament.id, this);
      this.closeLoading("Получение групп");
      if(this.groups_info.groups)
      {
        this.groups_info.selected_group = this.groups_info.groups[0];
        this.group_change();
      }
    },

    //Определение числителя
    isChisl() {
      var today = new Date(new Date().getTime() + 8 * (24 * 60 * 60 * 1000));
      return today.getWeek() % 2;
    },

    //Получение расписания при изменении выбранной группы
    async group_change() 
    {
      this.showLoading("Получение расписания");
      this.schedule = await schedule_api.getScheduleByGroupId(this.groups_info.selected_group.id, this);
      this.closeLoading("Получение расписания");
      this.closeLoading();
      if(this.schedule)
        this.parseSchedule();
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
    this.isToday = this.isChisl();
    this.getDepartament();
  },

  mounted(){
    this.getCallScheduleForPanel();
  }
};
</script>