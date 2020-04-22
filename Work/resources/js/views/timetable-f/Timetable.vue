<template lang="pug">
v-content.ma-0.pa-2
  v-layout.column.wrap()
    v-flex
      c_panel_control(ref="panel")
    v-flex
      v-card
        v-system-bar(dark color="info")
          span(style="color: white;") Фильтры
        v-combobox.mx-3.mt-6(dense label="Специальность" @change="departament_change" item-text="dep_name_full" :items="specialities" v-model="selected_departament" )
        v-combobox.mx-3.mt-2(dense label="Группа" @change="group_change" item-text="group_name" :items="combo_groups" v-model="selected_group")
    v-flex
       router-link(v-if="user.post_id == 1 || user.post_id == 4" class='nounderline' :to="'/' + user.post.slug + '/bild_timetable'") 
        v-btn.ma-3(color="accent" text block dark) Конструктор расписания
    v-chip.ma-1(v-if="isChisl != 0" label color="info") Знаменатель
    v-chip.ma-1(v-if="isChisl == 0" label color="accent") Числитель
    //--v-flex
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
                              v-card-text.pa-0.wrap.text-black Отсутствует --//
</template>

<style scoped>
.v-expansion-panel-content__wrap {
  padding: 0;
}
</style>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import PanelControl_C from '@/js/components/expention-f/Panel'; //Панель для вывода расписания

import api_call_schedule from "@/js/api/callSchedule"; //Расписания звонков
import api_departments from "@/js/api/departments"; //Расписания звонков

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";
//?----------------------------------------------
//!           Вспомогательные функции
//?----------------------------------------------


export default {
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
  //*Подключение вспомогательный компонентов
  mixins: [withSnackbar, withOverlayLoading],
  components: {
    c_panel_control: PanelControl_C,
  },
  //*Вычисляемые свойства
  computed: {
    ...mapGetters(["specialities", "groups_combo", "user", "timetable_full"]),
    
    combo_groups: function() {
      if (!this.groups_combo) return undefined;
        this.selected_group = this.groups_combo[0];
      return this.groups_combo;
    },
    //*Получение четности недели
    isChisl: function() {
      var year = new Date().getFullYear();
      var month = new Date().getMonth();
      var today = new Date(year, month, 0).getTime();
      var now = new Date().getTime();
      var week = Math.round((now - today) / (1000 * 60 * 60 * 24 * 7));
      return week % 2;
    }
  },

  data() {
    return {
      selected_departament: null,
      selected_group: null,
    }
  },

  beforeMount()
  {
    this.getDepartments();
  },

  mounted()
  {
    this.getCallScheduleForPanel();
  },

//?----------------------------------------------
//!           Методы страницы
//?----------------------------------------------
  methods: {
    //*Получение панели с расписанием
    async getCallScheduleForPanel() {
      this.showLoading("Получение расписания звонков");
      this.$refs.panel.loadData(await api_call_schedule.getCallScheduleForPanel(this));

      if(this.call_schedule == null)
      {
        let timeTable = await api_call_schedule.getCallSchedule(this);
        await this.$store.commit(mutations.SET_CALL_SCHEDULE, timeTable);
      }
      this.closeLoading("Получение расписания звонков");
    },
    //*Получение отделений для выпадающего списка
    async getDepartments()
    {
      if (!this.specialities) {
        this.showLoading("Получение отделений");
        let items = await api_departments.getDepartments(this);
        this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);
        this.closeLoading("Получение отделений");
      }

      if (this.specialities) 
      {
        this.selected_departament = this.specialities[0];
        this.departament_change();
      }
    },
//?----------------------------------------------
//!           Методы компонентов
//?----------------------------------------------
    //Получение группы при изменении отделения
    async departament_change() {
      this.showLoading("Получение групп");
      await this.$store.dispatch(mutations.ADD_CACHE_GROUP_DATA, {
        context: this,
        result: this.selected_departament.id
      });
      this.closeLoading("Получение групп");

      if (this.combo_groups) 
      {
        //*Отображение отделения и группы студента
        if (this.user.post_id == 2 && this.start) 
        {
          for (let i = 0; i < this.combo_groups.length; i++) 
          {
            if (this.combo_groups[i].id == this.user.student.group_id) 
            {
              this.selected_group = this.combo_groups[i];
              i = this.combo_groups.length;
            }
          }

          for (let i = 0; i < this.specialities.length; i++) 
          {
            if (this.selected_group.departament_id == this.specialities[i].id) 
            {
              this.selected_departament = this.specialities[i];
              i = this.specialities.length;
            }
          }
          this.start = false;
        } 
        else 
          this.selected_group = this.combo_groups[0];
        this.group_change();
      }
    },

    //*Получение расписания при изменении выбранной группы
    async group_change() {
      /*this.schedule = await this.schedules();
      if (this.schedule) this.parseSchedule();*/
    },
  }
}
</script>