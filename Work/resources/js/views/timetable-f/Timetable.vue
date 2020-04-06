<template lang="pug">
  v-layout.column.wrap
    v-flex.ma-2.mt-0.row
      c_panel_control(ref="panel")
    v-flex.ma-2.mb-0.row
        v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
        v-combobox.ma-1.mb-0(label="Группа" @change="group_change" item-text="group_name" :items="groups_info.groups" v-model="groups_info.selected_group")
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
                v-container.pa-0.ma-0(v-if="lesson.chisl == false") <!--Прорисовка обычной пары-->
                  v-container.pa-0.ma-0(v-if="lesson.LessonChisl != null && lesson.LessonChisl != ''")
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonChisl}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                v-container.pa-0.ma-0(v-else) <!--Прорисовка числителя/знаменателя-->
                  v-container.pa-0.ma-0(v-if="isToday == 0 && (lesson.LessonChisl !='' || lesson.LessonZnam !='')")
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonChisl}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                    v-expansion-panels.pa-0(v-if="lesson.LessonZnam!= null")                    
                      v-expansion-panel.pa-0
                          v-expansion-panel-header.px-1.py-0 {{ isToday == 0 ? "Знаменатель" :"Числитель" }}                 
                          v-expansion-panel-content.px-0.mx-0(v-if="lesson.LessonZnam != ''")
                            v-card-text.pa-0.wrap.text-black {{ lesson.LessonZnam }} 
                            v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherZnam }}
                          v-expansion-panel-content.px-0.mx-0(v-else)
                            v-card-text.pa-0.wrap.text-black Отсутствует 
                  v-container.pa-0.ma-0(v-else-if="lesson.LessonChisl !='' || lesson.LessonZnam !=''")
                    v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                    v-card-text.pa-0.wrap.text-black {{lesson.LessonZnam}} 
                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherZnam }}
                    v-expansion-panels.pa-0(v-if="lesson.LessonChisl!= null && lesson.LessonChisl != ''")                    
                      v-expansion-panel.pa-0
                          v-expansion-panel-header.px-1.py-0 {{ isToday == 0 ? "Знаменатель" :"Числитель" }}                 
                          v-expansion-panel-content.px-0.mx-0(v-if="lesson.LessonChisl != ''")
                            v-card-text.pa-0.wrap.text-black {{ lesson.LessonChisl }} 
                            v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.TeacherChisl }}
                          v-expansion-panel-content.px-0.mx-0(v-else)
                            v-card-text.pa-0.wrap.text-black Отсутствует 
                v-divider.ma-0.mt-1
</template>

<style scoped>
.v-expansion-panel-content__wrap {
  padding: 0;
}
</style>

<script>
import places_api from "@/js/api/places"; //Api мест проведений
import callSchedule_api from "@/js/api/callSchedule"; //Api мест проведений
import departament_api from "@/js/api/departments"; //Api отделения
import group_api from "@/js/api/group"; //Api групп
import schedule_api from "@/js/api/schedule"; //Api расписания
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import PanelControl_C from '@/js/components/expention-f/Panel'; //Панель для вывода расписания

Date.prototype.getWeek = function() {
  const onejan = new Date(this.getFullYear(), 0, 1);
  return Math.ceil(((this - onejan) / 86400000 + 1) / 7);
};

export default {
  mixins: [withSnackbar],
  post_name: {
    name: "Учебное расписание",
    url: "timetable"
  },
  components: {
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
      places: null, 
      days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"] //Дни недели
    };
  },

  methods: {
    //Получение панели с расписанием 
    getCallScheduleForPanel()
    {
      this.$refs.panel.loadData(callSchedule_api.getCallScheduleForPanel());
    },

    //Получение мест проведений
    getPlaces()
    {
      this.places = places_api.getPlaces();
    },

    //Получение отделений
    getDepartament()
    {
      this.departaments_info.departaments = departament_api.getDepartmentsForCombobox();
      if(this.departaments_info.departaments)
      {
        this.departaments_info.selected_departament = this.departaments_info.departaments[0];
        this.departament_change();
      }
    }, 

    //Получение группы при изменении отделения
    departament_change() 
    {
      this.groups_info.groups = group_api.getGroupsByDepartamentId(this.departaments_info.selected_departament.id);
      if(this.groups_info.groups)
      {
        this.groups_info.selected_group = this.groups_info.groups[0];
        this.changeFilter();
      }
    },

    //Определение числителя
    isChisl() {
      var today = new Date(new Date().getTime() + 8 * (24 * 60 * 60 * 1000));
      return today.getWeek() % 2;
    },

    //Получение расписания при изменении выбранной группы
    group_change() 
    {
      this.schedule = schedule_api.getScheduleByGroupId(this.groups_info.selected_group.id);
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
    this.getCallScheduleForPanel();
    this.isToday = this.isChisl();
    this.getDepartament();
    this.getPlaces();
  }
};
</script>