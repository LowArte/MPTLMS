<template lang="pug">
    v-layout.column.wrap
      v-flex.ma-2.row()
        v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="specialities" v-model="selected_departament" )
        v-combobox.ma-1(label="Группа" @change="group_change" item-text="group_name" :items="combo_groups" v-model="selected_group")
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
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['LessonChisl']" label="Дисциплины" :items="disciplines_combo" item-value='id' item-text='discipline_name' small-chips chips multiple)
                  v-autocomplete(v-if="schedule[day_key][lesson_key]['LessonChisl'].length > 0" v-model="schedule[day_key][lesson_key]['TeacherChisl']" label="Преподаватели" :items="teachers_combo" :rules="[TeacherRules.required]" item-value='id' item-text='fullFio' small-chips chips multiple)
                  v-switch(v-model="schedule[day_key][lesson_key].chisl" color="primary" inset label="Числитель/Знаменатель")
                  v-card-title.pa-0.accent--text.font-weight-light.text-truncate(v-if="schedule[day_key][lesson_key].chisl") Знаменатель
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['LessonZnam']" v-if="schedule[day_key][lesson_key].chisl" label="Дисциплины" :items="disciplines_combo" item-value='id' item-text='discipline_name' small-chips chips multiple)
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['TeacherZnam']" v-if="schedule[day_key][lesson_key].chisl && schedule[day_key][lesson_key]['LessonZnam'].length > 0" label="Преподаватели" :rules="[TeacherRules.required]" :items="teachers_combo" item-value='id' item-text='fullFio' small-chips chips multiple)
          v-btn.mt-2.justify-center(color="accent" block dark @click="sendQuery") Принять
</template>

<style scoped>
.v-expansion-panel-content__wrap {
  padding: 0;
}
</style>

<script>
import places_api from "@/js/api/places"; //Api мест проведений
import departament_api from "@/js/api/departments"; //Api отделения
import group_api from "@/js/api/group"; //Api групп
import schedule_api from "@/js/api/schedule"; //Api расписания
import teacher_api from "@/js/api/teacher"; //Api преподавателей
import discipline_api from "@/js/api/discipline"; //Api дисциплин
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["specialities", "groups_combo", "teachers_combo", "disciplines_combo", "places_combo"]),
    combo_groups: function() 
    {
      if (!this.groups_combo) return undefined;
      let groups = this.groups_combo.filter(res => {
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
  post_name: {
    name: "Конструктор учебного рассписения",
    url: "bild_timetable"
  },
  mixins: [withSnackbar, withOverlayLoading],
  data: () => {
    return {
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
      selected_departament: null,
      selected_group:null,
      schedule: null, //Расписание
      days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"], //Дни недели
    };
  },

  methods: 
  {
    //Получение всех преподавателей
    async getTeachers()
    {
      this.showLoading("Получение преподавателей");
      if(this.teachers_combo == null)
      {
        let items = await teacher_api.getTeachers(this);
        this.$store.commit(mutations.SET_TEACHERS_COMBO, items)
      }
      this.closeLoading("Получение преподавателей");
    },

    //Получение всех дисциплин
    async getDisciplines()
    {
      this.showLoading("Получение дисциплин");
      if(this.disciplines_combo == null)
      {
        let items = await discipline_api.getDisciplines(this);
        this.$store.commit(mutations.SET_DISCIPLINES_COMBO, items)
      }
      this.closeLoading("Получение дисциплин");
    },

    //Получение мест проведений
    async getPlaces()
    {
      this.showLoading("Получение мест проведения");
      if(this.places_combo == null)
      {
        let items = await places_api.getPlaces(this);
        this.$store.commit(mutations.SET_PLACES_COMBO, items)
      }
      this.closeLoading("Получение мест проведения");
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

    //Событие при изменении отделении
    async departament_change() 
    {
      this.showLoading("Получение групп");
      if (this.groups_combo == null)
      {
        let items = await group_api.getGroupsForComboboxRecursive(this);
        this.$store.commit(mutations.SET_GROUPS_COMBO, items)
      }
      this.closeLoading("Получение групп");
      
      if(this.groups_combo)
      {
        this.selected_group = this.combo_groups[0];
        this.group_change();
      }
    },

    //Событие при изменении группы
    async group_change() 
    {
      this.showLoading("Получение расписания");
      this.schedule = await schedule_api.getScheduleBildByGroupId(this.selected_group.id, this);
      this.closeLoading("Получение расписания");
      this.closeLoading();
    },

    //Отправка учебного расписания на сохранение
    sendQuery()
    {
      if (this.$refs.BildTimetable.validate())
      {
        if (schedule_api.editSchedule(
        {
          group_id: this.selected_group.id, 
          schedule: this.schedule,
        }, this))
          this.group_change();
      }
      else
        this.showError('Поля заполнены не корректно!');
    }
  },
  
  //Получение данных при старте
  beforeMount() 
  {
    this.getDepartament();
    this.getPlaces();
    this.getDisciplines();
    this.getTeachers();
  }
};
</script>