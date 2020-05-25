<template lang="pug">
v-content.ma-0.pa-2
  v-layout.column.wrap
    v-flex
      c_panel_control(ref="panel")
    v-flex
      v-card.pa-2(min-width="300px")
        v-alert(type="warning" elevation="3") Внимание: в данном разделе не учитываются изменения в расписании.
        v-alert(v-if="checkReplacement" outlined prominent type="error" elevation="0") 
          v-row(align="center")
            v-col(class="grow") Внимание: для вас имеются изменения в расписании.
            v-col(class="shrink")
              router-link(class='nounderline' :to="'/' + user.post.slug + '/replacements'")
                v-btn(icon)
                  v-icon mdi-chevron-right
        v-card-text В данном разделе вы можете отслеживать своё расписание учебных занятий. Имеется возможность просмотра как на текущий день, так и на всю предстоящую рабочую неделю.
        v-card-actions.px-0
          v-btn(block outlined :color="isColor" dark @click="getFull") {{allTabel ? "сегодня" : "неделя"}}
    v-chip.ma-1(min-width="300px" label dark :color="isColor") {{!isChisl ? "Числитель" : "Знаменатель"}}
    v-flex(v-if="!allTabel && timetable_by_day")
      c-teacher-training-schedule-by-today(:_items="timetable_by_day")
    v-flex(v-if="allTabel && timetable_by_week")
      c-teacher-training-schedule-by-week(:_items="timetable_by_week")
</template>

<script>
//?----------------------------------------------
//!       Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import PanelControl_C from "@/js/components/expention-f/Panel"; //Панель для вывода расписания
import TeacherTrainingScheduleByToday_C from "@/js/components/timetable-f/TeacherTrainingScheduleByToday";
import TeacherTrainingScheduleByWeek_C from "@/js/components/timetable-f/TeacherTrainingScheduleByWeek";

import api_call_schedule from "@/js/api/callSchedule"; //Расписания звонков
import api_replacement from "@/js/api/replacement"; //Замены

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
    "c-teacher-training-schedule-by-today": TeacherTrainingScheduleByToday_C,
    "c-teacher-training-schedule-by-week": TeacherTrainingScheduleByWeek_C
  },
  //*Вычисляемые свойства
  post_name: {
    name: "Расписание",
    url: "timetable_teacher"
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

    isColor: function() {
      return this.isChisl ? "cobalt" : "alizarin";
    }
  },

  data() {
    return {
      allTabel: false,
      checkReplacement: false,
      timetable_by_day: null,
      timetable_by_week: null,
      days: [
        "Воскресенье",
        "Понедельник",
        "Вторник",
        "Среда",
        "Четверг",
        "Пятница",
        "Суббота"
      ]
    };
  },

  async beforeMount() {
    this.showLoading("Загрузка");
    await this.$store.dispatch(actions.SET_TEACHER_TIMETABLE, {
      id: this.user.id,
      date: this.days[new Date().getDay()]
    });
    if (!this.tieacher_timetable)
      this.showError(
        "Что-то пошло не так во время получения вашео расписания. Возможно оно отсутсвует или имеются проблемы с данными."
      );
    this.timetable_by_day = this.tieacher_timetable;
    this.closeLoading("Загрузка");
    this.checkReplacement = await api_replacement.getCheckTeacherReplacement(
      this.user.id
    );
  },

  mounted() {
    this.getCallScheduleForPanel();
  },

  methods: {
    //?----------------------------------------------
    //!           Методы страницы
    //?----------------------------------------------
    //*Получение панели с расписанием
    async getCallScheduleForPanel() {
      this.showLoading("Получение расписания звонков");
      this.$refs.panel.loadData(
        await api_call_schedule.getCallScheduleForPanel()
      );
      if (this.call_schedule == null) {
        var timeTable = await api_call_schedule.getCallSchedule();
        await this.$store.commit(mutations.SET_CALL_SCHEDULE, timeTable);
      }
      this.closeLoading("Получение расписания звонков");
    },
    //?----------------------------------------------
    //!           Методы компонентов
    //?----------------------------------------------
    async getFull() {
      this.showLoading("Загрузка");
      if (!this.allTabel) {
        this.allTabel = true;
        await this.$forceUpdate();
        await this.$store.dispatch(
          actions.SET_TEACHER_TIMETABLE_FULL,
          this.user.id
        );
        this.timetable_by_week = null;
        this.timetable_by_week = this.tieacher_timetable;
      } else {
        this.allTabel = false;
        await this.$forceUpdate();
        await this.$store.dispatch(actions.SET_TEACHER_TIMETABLE, {
          id: this.user.id,
          date: this.days[new Date().getDay()]
        });
        this.timetable_by_day = null;
        this.timetable_by_day = this.tieacher_timetable;
      }
      if (!this.tieacher_timetable)
        this.showError(
          "Что-то пошло не так во время получения вашео расписания. Возможно оно отсутсвует или имеются проблемы с данными."
        );
      this.closeLoading("Загрузка");
    }
  }
};
</script>+