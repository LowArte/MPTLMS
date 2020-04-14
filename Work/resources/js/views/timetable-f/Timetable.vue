<template lang="pug">
v-content.ma-0.pa-2
  v-layout.column.wrap
    v-flex
      c_panel_control(ref="panel")
    v-flex
      v-card
        v-system-bar(dark color="info")
          span(style="color: white;") Фильтры
        v-combobox.mx-3.mt-6(dense label="Специальность" @change="departament_change" item-text="dep_name_full" :items="specialities" v-model="selected_departament" )
        v-combobox.mx-3.mt-2(dense label="Группа" @change="group_change" item-text="group_name" :items="combo_groups" v-model="selected_group")
    v-dialog(v-if="user.post_id == 1 || user.post_id == 4" v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
      template(v-slot:activator="{ on }")
        v-btn.ma-3(color="accent" text block dark v-on="on") {{titleDialog}}
      v-card
        v-toolbar(dark color="primary")
          v-btn(icon dark @click="dialog = false; group_change()")
            v-icon mdi-close
          v-toolbar-title {{titleDialog}}
          v-spacer
        c_bildTimetable.pa-2()
    v-chip.ma-1(v-if="isToday != 0" label color="info") Знаменатель
    v-chip.ma-1(v-if="isToday == 0" label color="accent") Числитель
    v-flex
      v-layout.row.wrap
        v-flex(v-for="(day_key,day_index) in days" :key="day_index" v-if="schedule != null")
          v-card.mx-auto(min-width="300px" max-width="320px" style="display: flex; flex-direction: column;")
            v-system-bar
              span {{day_key}} 
            v-chip.ma-2(label) {{schedule[day_key].Place.place_name}} 
            v-divider
            v-content.pa-2.ma-0 
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
    ...mapGetters(["specialities", "groups", "user"]),
    combo_groups: function() 
    {
      if (!this.groups) return undefined;
      let groups = this.groups.filter(res => {
        if (res.departament_id == this.selected_departament.id) {
          return true;
        }
        return false;
      });
      if (groups != null)
        this.selected_group = groups[0];
      return groups;
    }
  },
  mixins: [withSnackbar, withOverlayLoading],
  post_name: {
    name: "Учебное расписание",
    url: "timetable"
  },
  components: {
    c_bildTimetable: bildTimetable,
    c_panel_control: PanelControl_C,
  },

  data: () => {
    return {
      selected_departament: null,
      selected_group:null,
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
      if (this.specialities == null)
      {
        let items = await departament_api.getDepartments(this);
        this.$store.commit(mutations.SET_SPECIALITIES_FULL,items);
      }
      this.closeLoading("Получение отделений");
      
      if(this.specialities)
      {
        this.selected_departament = this.specialities[0];
        this.departament_change();
      }
    }, 

    //Получение группы при изменении отделения
    async departament_change() 
    {
      this.showLoading("Получение групп");
      if (this.groups == null)
      {
        let items = await group_api.getGroups(this);
        this.$store.commit(mutations.SET_GROUPS_FULL, items)
      }
      this.closeLoading("Получение групп");

      if(this.groups)
      {
        /*if(this.user.post_id == 2) //Отображение отделения и группы студента
        {
          for(let i = 0; i < this.groups.length; i++)
          {
            if(this.groups[i].id == user.group_id)
            {
              this.selected_group = this.groups[i];
              i = this.groups.length;
            }
          }

          for(let i = 0; i < this.specialities.length; i++)
          {
            if (this.selected_group.departament_id == this.specialities[i].id) 
            {
              this.selected_departament = this.specialities[i];
              i = this.specialities.length;
            }
          }
        }
        else*/
          this.selected_group = this.combo_groups[0];
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
      this.schedule = await schedule_api.getScheduleByGroupId(this.selected_group.id, this);
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