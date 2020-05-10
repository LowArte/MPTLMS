<template lang="pug">
  v-content.ma-0.pa-2
    v-layout.column.wrap()
      v-flex
        v-card
          v-system-bar(dark color="info")
            span(style="color: white;") Фильтры
          v-combobox.mx-3.mt-6(dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-text="dep_name_full" :items="specialities" v-model="selected_department" )
          v-combobox.mx-3.mt-2(dense label="Группа" no-data-text="Нет данных" @change="group_change" item-text="group_name" :items="combo_groups" v-model="selected_group")
          v-content.pa-1
            router-link(class='nounderline' :to="'timetable'") 
              v-btn(color="accent" text block dark) Расписание      
      v-divider.ma-0
      v-flex.ma-0.pa-0.row(v-if="schedule != null")
        v-form.ma-0.pa-0.grow(ref="BildTimetable")
          v-tabs(background-color="transparent" color="basil" mobile-break-point=0 grow next-icon="mdi-arrow-right-bold-box-outline" prev-icon="mdi-arrow-left-bold-box-outline" show-arrows)
            v-tab(v-for="(day_key,day_index) in days" :key="day_index") {{day_key}}
            v-tab-item(v-for="(day_key, day_index) in days" :key="day_index") 
              v-card.mx-auto.pa-1.max(width='100%' height='auto')
                v-select.pa-0.mb-0.mt-2(v-model="schedule[day_key]['Place']" label="Место проведения" solo :items="places_combo" item-text="place_name" item-value="id")
                v-card.pa-2(width='100%' outlined tile v-for="(lesson_key,lesson_index) in 7" :key="lesson_index") 
                  v-card-title.primary-title.pt-0.px-0 {{lesson_key}} пара
                  v-card-title.pa-0.accent--text.font-weight-light.text-truncate(v-if="schedule[day_key][lesson_key].chisl") Числитель
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['LessonChisl']" label="Дисциплины" :items="disciplines_combo" item-value='id' item-text='discip_name' small-chips chips multiple)
                  v-autocomplete(v-if="schedule[day_key][lesson_key]['LessonChisl'].length > 0" v-model="schedule[day_key][lesson_key]['TeacherChisl']" label="Преподаватели" :items="teachers_combo" :rules="[TeacherRules.required]" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple)
                  v-switch(v-model="schedule[day_key][lesson_key].chisl" color="primary" inset label="Числитель/Знаменатель")
                  v-card-title.pa-0.accent--text.font-weight-light.text-truncate(v-if="schedule[day_key][lesson_key].chisl") Знаменатель
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['LessonZnam']" v-if="schedule[day_key][lesson_key].chisl" label="Дисциплины" :items="disciplines_combo" no-data-text="Нет данных" item-value='id' item-text='discip_name' small-chips chips multiple)
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['TeacherZnam']" v-if="schedule[day_key][lesson_key].chisl && schedule[day_key][lesson_key]['LessonZnam'].length > 0" label="Преподаватели" :rules="[TeacherRules.required]" no-data-text="Нет данных" :items="teachers_combo" item-value='id' item-text='fullFio' small-chips chips multiple)
          v-btn.mt-2.justify-center(color="accent" block dark @click="sendQuery") Принять
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
import api_department from "@/js/api/department"; //Отделения
import api_schedule from "@/js/api/schedule"; //Api расписания
import api_place from "@/js/api/place"; //Api мест проведений
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

  //*Вычисляемые свойства
  post_name: {
    name: "Конструктор учебного расписания",
    url: "bild_timetable"
  },
  
  computed: {
    ...mapGetters(["specialities", "groups_combo", "teachers_combo", "disciplines_combo", "places_combo"]),
    combo_groups: function() {
      if (!this.groups_combo) return undefined;
      this.selected_group = this.groups_combo[0];
      console.log(this.groups_combo)
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
      loaded: false,
      TeacherRules: {
          required: value => {
              return !!value.length || "Преподаватель не указан!";
          },
      },
      DiscipRules: {
          required: value => {
              return !!value.length || "Дисциплина не указана!";
          },
      },
      selected_department: null,
      selected_group: null,
      days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"], //Дни недели
      schedule: null
    }
  },

  beforeMount()
  {
    this.getDepartments();
    this.getPlaces();
    this.getTeachers();
  },

  methods: {
//?----------------------------------------------
//!           Методы страницы
//?----------------------------------------------
    //Получение всех преподавателей
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

    //Получение всех дисциплин
    async getDisciplines()
    {
      this.showLoading("Получение дисциплин");
      let items = await api_discipline.getDisciplines({"curs": this.selected_group.curs, "department_id": this.selected_department.id});
      this.$store.commit(mutations.SET_DISCIPLINES_COMBO, items)
      this.closeLoading("Получение дисциплин");
    },

    //Получение мест проведений
    async getPlaces()
    {
      this.showLoading("Получение мест проведения");
      if(this.places_combo == null)
      {
        let items = await api_place.getPlaces();
        this.$store.commit(mutations.SET_PLACES_COMBO, items)
      }
      this.closeLoading("Получение мест проведения");
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

    //Отправка учебного расписания на сохранение
    async sendQuery()
    {
      if (this.$refs.BildTimetable.validate())
      {
        if(await api_schedule.editSchedule({group_id: this.selected_group.id, schedule: this.schedule}))
          this.showMessage("Выполнено!");
      }
      else
        this.showError('Поля заполнены не корректно!');
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
      this.showLoading("Получение расписания");
      this.schedule = await api_schedule.getScheduleBildByGroupId(this.selected_group.id);
      this.closeLoading("Получение расписания");
      this.getDisciplines();
    },
  }
};
</script>