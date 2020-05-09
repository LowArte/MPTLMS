<template lang="pug">
    v-content.ma-0.pa-2
        v-layout.column.wrap
            v-flex
                v-card(min-width="300px" v-if="user != null && user.post_id != null")
                    v-system-bar(dark :color="isChisl ? 'info' : 'accent'")
                        span Доступные действия
                    v-autocomplete.pa-3.pt-4(outlined dense v-model="teacher_id" label="Преподаватели" :items="teachers_combo" @change="teacher_change()" no-data-text="Нет данных" item-value='id' item-text='fullFio')
                    v-card-actions
                        v-btn(text color="primary") редактор
                        v-btn(text color="primary") обновить данные
            v-chip.ma-1(min-width="300px" label :color="isChisl ? 'info' : 'accent'") {{!isChisl ? "Числитель" : "Знаменатель"}}
        v-layout.row.wrap
            v-flex(v-if="teachers_combo")
                v-card.mb-1(min-width="300px")
                    v-system-bar(:color="isChisl ? 'info' : 'accent'" dark)
                        span Преподаватели
                    v-alert.ma-2(type="warning" border="left" dense colored-border elevation="2") В данном списке представлены преподаватели, у которых имеются пары на {{days[(new Date()).getDay() + 1].toLowerCase()}}
                    v-list(nav flat dense v-if="teachers_day")
                      v-list-item(v-for="(item, index) in teachers_day" :key="index" inactive @click="listChange(item.id)")
                          v-list-item-content
                              v-list-item-title {{item.fio}} 
            v-flex(v-if="schedule")
                v-card(min-width="300px")
                    v-system-bar(:color="isChisl ? 'info' : 'accent'" dark)
                        span {{days[(new Date()).getDay() + 1]}}
                        v-spacer
                        v-btn(x-small text dark) очистить
                    v-alert.ma-2(type="warning" border="left" dense colored-border elevation="2") Если необходимо указать несколько аудиторий для группы, используйте символ <kbd> / </kbd> чтобы визуально разделить новера аудиторий.
                    v-expansion-panels(v-if="isChisl" flat popout)
                        v-expansion-panel.pa-1(v-for="(groups, i) in schedule" :key="i")
                            v-expansion-panel-header {{groups.group_name}}
                            v-expansion-panel-content
                                div.pa-0.ma-0.mb-3(color="blue lighten-5")
                                    v-form  
                                        div.overline.mb-0 {{groups.show.Place.place_name}}
                                        div.ma-0.pa-0(v-for="(item, index) in groups.show" :key="index")
                                            v-card.pa-0.ma-0.mb-3(flat v-if="index != 'Place'") 
                                                v-card-title.pl-1.py-1 {{item.time}} • {{item.classroom ? item.classroom : "НУ"}}
                                                v-card-text.pl-1.pb-1 {{item.LessonZnam.join(" / ")}}
                                                v-text-field.mt-3(solo clearable dense label="Номер аудитории" v-model="schedule[i].bild[index].classroom" @change="item.classroom = schedule[i].bild[index].classroom")
                    v-expansion-panels(v-else flat popout)
                        v-expansion-panel.pa-1(v-for="(groups, i) in schedule" :key="i")
                            v-expansion-panel-header {{groups.group_name}}
                            v-expansion-panel-content
                                div.pa-0.ma-0.mb-3(color="blue lighten-5")
                                    v-form  
                                        div.overline.mb-0 {{groups.show.Place.place_name}}
                                        div.ma-0.pa-0(v-for="(item, index) in groups.show" :key="index")
                                            v-card.pa-0.ma-0.mb-3(flat v-if="index != 'Place'") 
                                                v-card-title.pl-1.py-1 {{item.time}} • {{item.classroom ? item.classroom : "НУ"}}
                                                v-card-text.pl-1.pb-1 {{item.LessonChisl.join(" / ")}}
                                                v-text-field.mt-3(solo clearable dense label="Номер аудитории" v-model="item.classroom")
                    v-card-actions
                        v-btn(block text color="success" @click="sendQuery" :loading="loading" :disabled="loading") сохранить          
</template>

<script>
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка

import api_schedule from "@/js/api/schedule"; //Api расписания
import api_teacher from "@/js/api/teacher";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withSnackbar, withOverlayLoading],
  computed: {
    ...mapGetters(["user", "teachers_combo"]),

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
      teacher_id: null,
      loading: false,
      day: "Понедельник",
      days: [
        "Воскресенье",
        "Понедельник",
        "Вторник",
        "Среда",
        "Четверг",
        "Пятница",
        "Суббота",
        "Понедельник",
      ],
      teachers_day: null,
      schedule: null,
      classroom: null
    };
  },

  async beforeMount() {
    await this.getTeachers();
  },

  methods: {
    //?----------------------------------------------
    //!           Методы страницы
    //?----------------------------------------------
    async teacher_change() {
      this.showLoading("Получение расписания");
      this.schedule = await api_schedule.getScheduleBildShowDayByTeacherId({
        teacher_id: this.teacher_id,
        day: this.day
      });
      this.teachers_day = await api_schedule.getTeachersForScheduleDay({
        chisl: this.isChisl,
        day: this.day
      });
      this.closeLoading("Получение расписания");
    },

    async listChange(id) {
      if (this.teacher_id != id) {
        this.showLoading("Получение расписания");
        this.teacher_id = id;
        this.schedule = await api_schedule.getScheduleBildShowDayByTeacherId({
          teacher_id: this.teacher_id,
          day: this.day
        });
        this.closeLoading("Получение расписания");
      }
    },

    //Отправка учебного расписания на сохранение
    async sendQuery() 
    {
      this.loading = true;
      await api_schedule.editScheduleClassroom({
        schedule: this.schedule,
        day: this.day
      });
      this.loading = false;
    },

    //Получение всех преподавателей
    async getTeachers() {
      this.showLoading("Получение преподавателей");
      if (this.teachers_combo == null)
        await this.$store.commit(
          mutations.SET_TEACHERS_COMBO,
          await api_teacher.getTeachers()
        );
      this.teacher_id = this.teachers_combo[0].id;
      this.teacher_change();
      this.closeLoading("Получение преподавателей");
    }
  }
};
</script>