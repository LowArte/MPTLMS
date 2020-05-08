<template lang="pug">
v-content.ma-0.pa-2
  v-layout.column.wrap
    v-flex
      c_panel_control(ref="panel")
    v-flex
      v-card(v-if="user != null && user.post_id != null")
        v-system-bar(dark color="info")
          span(style="color: white;") Дополнительные возможности
        v-card-actions
          v-btn(block text color="primary" dark @click="getFull") {{allTabel ? "Расписание на сегодня" : "Расписание на неделю"}}
    v-chip.ma-1(label :color="isChisl ? 'info' : 'accent'") {{!isChisl ? "Числитель" : "Знаменатель"}}
    v-flex(v-if="!allTabel")
      v-card(v-if="tieacher_timetable")
        v-system-bar(:color="isChisl ? 'info' : 'accent'" dark)
          span {{days[(new Date()).getDay()]}} | Сегодня
        div.ma-0.pa-0(v-for="(item, index1) in tieacher_timetable" v-if="item.GroupChisl")
          v-card-title.ma-0.pa-0.pl-1 Занятие №{{index1}}
          div.ma-0.pa-0(v-if="!item.chisl && !isChisl && item.GroupChisl.length > 0")
            v-chip.ma-2(label) {{item.PlaceChisl.join(" / ")}}
            v-card-title.pl-1.py-1 {{item.TimeChisl.join(" / ")}} • {{item.Classroom.join(" / ") ? item.Classroom.join(" / ") : "НУ"}} • {{item.GroupChisl.join(" / ")}}
            v-card-text.pl-1 {{item.LessonChisl.join(" / ")}}
          div.ma-0.pa-0(v-if="!item.chisl && !isChisl && item.GroupChisl.length == 0")
            v-card-text.pl-1.py-1 Отсутствует
          div.ma-0.pa-0(v-if="!item.chisl && isChisl && item.GroupChisl.length > 0")
            v-chip.ma-2(label) {{item.PlaceChisl.join(" / ")}}
            v-card-title.pl-1.py-1 {{item.TimeChisl.join(" / ")}} • {{item.Classroom.join(" / ") ? item.Classroom.join(" / ") : "НУ"}} • {{item.GroupChisl.join(" / ")}}
            v-card-text.pl-1 {{item.LessonChisl.join(" / ")}}
          div.ma-0.pa-0(v-if="!item.chisl && isChisl && item.GroupChisl.length == 0")
            v-card-text.pl-1.py-1 Отсутствует
          //-Числитель/Знаменатель
          div.ma-0.pa-0(v-if="!isChisl && item.chisl")
            v-card.pa-1.ma-1.mb-3(outlined color="red lighten-5" v-if="item.GroupChisl.length > 0")
              div.overline.mb-0 Числитель | {{item.PlaceChisl.join(" / ")}}
              v-card-title.pl-1.py-1 {{item.TimeChisl.join(" / ")}} • {{item.Classroom.join(" / ") ? item.Classroom.join(" / ") : "НУ"}} • {{item.GroupChisl.join(" / ")}}
              v-card-text.pb-1.pl-1 {{item.LessonChisl.join(" / ")}}
            v-card.pa-1.ma-1.mb-3(outlined color="red lighten-5" v-else)
              div.overline.mb-0 Числитель | Отсутствует
            v-expansion-panels.px-2(flat)
              v-expansion-panel
                v-expansion-panel-header.px-1
                  div.overline.mb-0 Знаменатель
                v-expansion-panel-content
                  v-card.pa-1.ma-1.mb-3(outlined color="boring" v-if="item.GroupZnam.length > 0")
                    div.overline.mb-0 {{item.PlaceZnam.join(" / ")}}
                    v-card-title.pl-1.py-1 {{item.TimeZnam.join(" / ")}} • {{item.GroupZnam.join(" / ")}}
                    v-card-text.pb-1.pl-1 {{item.LessonZnam.join(" / ")}}
                  v-card.pa-1.ma-1.mb-3(outlined color="boring" v-else)
                    v-card-text.pb-1.pl-1 Отсутствует
          div.ma-0.pa-0(v-if="isChisl  && item.chisl") 
            v-card.pa-1.ma-1.mb-3(outlined color="blue lighten-5" v-if="item.GroupZnam.length > 0")
              div.overline.mb-0 Знаменатель | {{item.PlaceZnam.join(" / ")}}
              v-card-title.pl-1.py-1 {{item.TimeZnam.join(" / ")}} • {{item.Classroom.join(" / ") ? item.Classroom.join(" / ") : "НУ"}} • {{item.GroupZnam.join(" / ")}}
              v-card-text.pb-1.pl-1 {{item.LessonZnam.join(" / ")}}
            v-card.pa-1.ma-1.mb-3(outlined color="red lighten-5" v-else)
              div.overline.mb-0 Знаменатель | Отсутствует
            v-expansion-panels.px-2(flat)
              v-expansion-panel
                v-expansion-panel-header.px-1
                  div.overline.mb-0 Числитель
                v-expansion-panel-content
                  v-card.pa-1.ma-1.mb-3(outlined color="boring" v-if="item.GroupChisl.length > 0")
                    div.overline.mb-0 {{item.PlaceChisl.join(" / ")}}
                    v-card-title.pl-1.py-1 {{item.TimeChisl.join(" / ")}} • {{item.GroupChisl.join(" / ")}}
                    v-card-text.pb-1.pl-1 {{item.LessonChisl.join(" / ")}}
                  v-card.pa-1.ma-1.mb-3(outlined color="boring" v-else)
                    v-card-text.pb-1.pl-1 Отсутствует
    v-flex(v-if="allTabel")
      v-layout.row.wrap(v-if="tieacher_timetable")
        v-flex(v-for="(itemt, day_i) in tieacher_timetable" :key="day_i")
          v-card.mx-auto(min-width="300px" max-width="320px" style="display: flex; flex-direction: column;")
            v-system-bar(:color="isChisl ? 'info' : 'accent'" dark)
              span {{day_i}}
            div.ma-0.pa-0(v-for="(item, index1) in itemt" v-if="item.GroupChisl")
              v-card-title.ma-0.pa-0.pl-1 Занятие №{{index1}}
              div.ma-0.pa-0(v-if="!item.chisl && !isChisl && item.GroupChisl.length > 0")
                v-chip.ma-2(label) {{item.PlaceChisl.join(" / ")}}
                v-card-title.pl-1.py-1 {{item.TimeChisl.join(" / ")}} • {{item.Classroom.join(" / ") ? item.Classroom.join(" / ") : "НУ"}} • {{item.GroupChisl.join(" / ")}}
                v-card-text.pl-1 {{item.LessonChisl.join(" / ")}}
              div.ma-0.pa-0(v-if="!item.chisl && !isChisl && item.GroupChisl.length == 0")
                v-card-text.pl-1.py-1 Отсутствует
              div.ma-0.pa-0(v-if="!item.chisl && isChisl && item.GroupChisl.length > 0")
                v-chip.ma-2(label) {{item.PlaceChisl.join(" / ")}}
                v-card-title.pl-1.py-1 {{item.TimeChisl.join(" / ")}} • {{item.Classroom.join(" / ") ? item.Classroom.join(" / ") : "НУ"}} • {{item.GroupChisl.join(" / ")}}
                v-card-text.pl-1 {{item.LessonChisl.join(" / ")}}
              div.ma-0.pa-0(v-if="!item.chisl && isChisl && item.GroupChisl.length == 0")
                v-card-text.pl-1.py-1 Отсутствует
              //-Числитель/Знаменатель
              div.ma-0.pa-0(v-if="!isChisl && item.chisl")
                v-card.pa-1.ma-1.mb-3(outlined color="red lighten-5" v-if="item.GroupChisl.length > 0")
                  div.overline.mb-0 Числитель | {{item.PlaceChisl.join(" / ")}}
                  v-card-title.pl-1.py-1 {{item.TimeChisl.join(" / ")}} • {{item.Classroom.join(" / ") ? item.Classroom.join(" / ") : "НУ"}} • {{item.GroupChisl.join(" / ")}}
                  v-card-text.pb-1.pl-1 {{item.LessonChisl.join(" / ")}}
                v-card.pa-1.ma-1.mb-3(outlined color="red lighten-5" v-else)
                  div.overline.mb-0 Числитель | Отсутствует
                v-expansion-panels.px-2(flat)
                  v-expansion-panel
                    v-expansion-panel-header.px-1
                      div.overline.mb-0 Знаменатель
                    v-expansion-panel-content
                      v-card.pa-1.ma-1.mb-3(outlined color="boring" v-if="item.GroupZnam.length > 0")
                        div.overline.mb-0 {{item.PlaceZnam.join(" / ")}}
                        v-card-title.pl-1.py-1 {{item.TimeZnam.join(" / ")}} • {{item.GroupZnam.join(" / ")}}
                        v-card-text.pb-1.pl-1 {{item.LessonZnam.join(" / ")}}
                      v-card.pa-1.ma-1.mb-3(outlined color="boring" v-else)
                        v-card-text.pb-1.pl-1 Отсутствует
              div.ma-0.pa-0(v-if="isChisl  && item.chisl") 
                v-card.pa-1.ma-1.mb-3(outlined color="blue lighten-5" v-if="item.GroupZnam.length > 0")
                  div.overline.mb-0 Знаменатель | {{item.PlaceZnam.join(" / ")}}
                  v-card-title.pl-1.py-1 {{item.TimeZnam.join(" / ")}} • {{item.Classroom.join(" / ") ? item.Classroom.join(" / ") : "НУ"}} • {{item.GroupZnam.join(" / ")}}
                  v-card-text.pb-1.pl-1 {{item.LessonZnam.join(" / ")}}
                v-card.pa-1.ma-1.mb-3(outlined color="red lighten-5" v-else)
                  div.overline.mb-0 Знаменатель | Отсутствует
                v-expansion-panels.px-2(flat)
                  v-expansion-panel
                    v-expansion-panel-header.px-1
                      div.overline.mb-0 Числитель
                    v-expansion-panel-content
                      v-card.pa-1.ma-1.mb-3(outlined color="boring" v-if="item.GroupChisl.length > 0")
                        div.overline.mb-0 {{item.PlaceChisl.join(" / ")}}
                        v-card-title.pl-1.py-1 {{item.TimeChisl.join(" / ")}} • {{item.GroupChisl.join(" / ")}}
                        v-card-text.pb-1.pl-1 {{item.LessonChisl.join(" / ")}}
                      v-card.pa-1.ma-1.mb-3(outlined color="boring" v-else)
                        v-card-text.pb-1.pl-1 Отсутствует    
</template>

<style>
.v-expansion-panel-content__wrap {
  padding: 0;
}
</style>

<script>
//?----------------------------------------------
//!       Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import PanelControl_C from '@/js/components/expention-f/Panel'; //Панель для вывода расписания

import api_call_schedule from "@/js/api/callSchedule"; //Расписания звонков

import { mapGetters, mapMutations } from "vuex";
import * as actions from "@/js/store/action-types";
import * as mutations from "@/js/store/mutation-types";


export default {
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withSnackbar, withOverlayLoading],
  components: {
    c_panel_control: PanelControl_C,
  },
  //*Вычисляемые свойства
  post_name: {
    name: "Расписание",
    url: "timetable_teacher", 
  },

  computed: {
    ...mapGetters(["user", "tieacher_timetable"]),

    //*Получение четности недели
    isChisl: function() {
      var year = new Date().getFullYear();
      var month = new Date().getMonth();
      var today = new Date(year, month, 0).getTime();
      var now = new Date().getTime();
      var week = Math.round((now - today) / (1000 * 60 * 60 * 24 * 7));
      return week % 2;
    },
  },

  data() {
    return {
      days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"], //Дни недели
      allTabel: false
    }
  },
  async beforeMount()
  {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.SET_TEACHER_TIMETABLE, {id: this.user.teacher.id, date: this.days[new Date().getDay()]});
    if(!this.tieacher_timetable) this.showError("Данные не получены!");
    this.closeLoading("Получение данных");
  },

  mounted()
  {
    this.getCallScheduleForPanel();
  },

  methods: {
    //?----------------------------------------------
    //!           Методы страницы
    //?----------------------------------------------
    //*Получение панели с расписанием
    async getCallScheduleForPanel() 
    {
      
      this.showLoading("Получение расписания звонков");
      this.$refs.panel.loadData(await api_call_schedule.getCallScheduleForPanel());
      if(this.call_schedule == null)
      {
        var timeTable = await api_call_schedule.getCallSchedule();
        await this.$store.commit(mutations.SET_CALL_SCHEDULE, timeTable);
      }
      this.closeLoading("Получение расписания звонков");
    },
    //?----------------------------------------------
    //!           Методы компонентов
    //?----------------------------------------------
    async getFull() {
      this.showLoading("Получение данных");
      if(!this.allTabel) {
        this.allTabel = true;
        await this.$forceUpdate();
        await this.$store.dispatch(actions.SET_TEACHER_TIMETABLE_FULL, this.user.teacher.id);
      }
      else {
        this.allTabel = false;
        await this.$forceUpdate();
        await this.$store.dispatch(actions.SET_TEACHER_TIMETABLE, {id: this.user.teacher.id, date: this.days[new Date().getDay()]});
      }
      if(!this.tieacher_timetable) this.showError("Данные не получены!");
      this.closeLoading("Получение данных");
    }
  }
}
</script>