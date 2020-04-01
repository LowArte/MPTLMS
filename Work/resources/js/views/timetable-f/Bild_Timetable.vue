<template lang="pug">
    v-layout.column.wrap
      v-flex.ma-2.row(v-if="departaments_info != null")
        v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
        v-combobox.ma-1(label="Группа" @change="group_change" item-text="group_name" :items="groups_info.groups" v-model="groups_info.selected_group")
      v-divider.ma-0
      v-flex.ma-0.pa-0.row(v-if="schedule != null")
        v-form.ma-0.pa-0.grow(ref="BildTimetable")
          v-tabs(background-color="transparent" color="basil" mobile-break-point=0 grow next-icon="mdi-arrow-right-bold-box-outline" prev-icon="mdi-arrow-left-bold-box-outline" show-arrows)
            v-tab(v-for="(day_key,day_index) in days" :key="day_index") {{day_key}}
            v-tab-item(v-for="(day_key, day_index) in days" :key="day_index") 
              v-card.mx-auto.pa-1.max(width='100%' height='auto')
                v-select.pa-0.mb-0.mt-2(v-model="schedule[day_key]['Place']" label="Место проведения" solo :items="places" item-text="place_name" item-value="id")
                v-card.pa-2(width='100%' outlined tile v-for="(lesson_key,lesson_index) in 7" :key="lesson_index") 
                  v-card-title.primary-title.pt-0.px-0 {{lesson_key}} пара
                  v-card-title.pa-0.accent--text.font-weight-light.text-truncate(v-if="schedule[day_key][lesson_key].chisl") Числитель
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['LessonChisl']" label="Дисциплины" :items="disciplines" item-value='id' item-text='discipline_name' small-chips chips multiple)
                  v-autocomplete(v-if="schedule[day_key][lesson_key]['LessonChisl'].length > 0" v-model="schedule[day_key][lesson_key]['TeacherChisl']" label="Преподаватели" :items="teachers" :rules="[TeacherRules.required]" item-value='id' item-text='fullFio' small-chips chips multiple)
                  v-switch(v-model="schedule[day_key][lesson_key].chisl" color="primary" inset label="Числитель/Знаменатель")
                  v-card-title.pa-0.accent--text.font-weight-light.text-truncate(v-if="schedule[day_key][lesson_key].chisl") Знаменатель
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['LessonZnam']" v-if="schedule[day_key][lesson_key].chisl" label="Дисциплины" :items="disciplines" item-value='id' item-text='discipline_name' small-chips chips multiple)
                  v-autocomplete(v-model="schedule[day_key][lesson_key]['TeacherZnam']" v-if="schedule[day_key][lesson_key].chisl && schedule[day_key][lesson_key]['LessonZnam'].length > 0" label="Преподаватели" :rules="[TeacherRules.required]" :items="teachers" item-value='id' item-text='fullFio' small-chips chips multiple)
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

export default {
  post_name: {
    name: "Конструктор учебного рассписения",
    url: "bild_timetable"
  },
  mixins: [withSnackbar],
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
      disciplines: [],
      teachers: [],
      places: [],
      groups_info: {groups:null, selected_group:null}, //Группы
      departaments_info: {departaments:null, selected_departament:null}, //Отделения
      schedule: null, //Расписание
      days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"], //Дни недели
    };
  },

  methods: 
  {
    //Получение всех дисциплин
    getDisciplines()
    {
      discipline_api
        .getDisciplines()
        .then(res => {
          this.disciplines = res.data.disciplines;
        })
        .catch(ex => {
          this.showError(ex);
        });
    },

    //Получение всех преподавателей
    getTeachers()
    {
      teacher_api
        .getTeachers()
        .then(res => {
          this.teachers = res.data.teachers;
        })
        .catch(ex => {
          this.showError(ex);
        });
    },

    //Получение мест проведений
    getPlaces()
    {
      places_api
        .getPlaces()
        .then(res => {
          this.places = res.data.places;
        })
        .catch(ex => {
          this.showError(ex);
        });
    },

    //Получение отделений
    getDepartament()
    {
      departament_api
        .getDepartmentsForCombobox()
        .then(res => {
          this.departaments_info.departaments = res.data.departaments;
          this.departaments_info.selected_departament = this.departaments_info.departaments[0];
          this.departament_change();
        })
        .catch(ex => {
          this.showError(ex);
        });
    }, 

    //Событие при изменении отделении
    departament_change() 
    {
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

    //Событие при изменении группы
    group_change() 
    {
      schedule_api
        .getScheduleBildByGroupId(this.groups_info.selected_group.id)
        .then(res => {
          this.schedule = res.data.schedule;
        })
        .catch(ex => {
          this.showError(ex);
        });
    },

    //Отправка учебного расписания на сохранение
    sendQuery()
    {
      if (this.$refs.BildTimetable.validate())
      {
        schedule_api
          .editSchedule({group_id: this.groups_info.selected_group.id, schedule: this.schedule, slug: this._slug, controller: this._controller})
          .then(res => {
            this.showMessage('Расписание сохранено!');
          })
          .catch(ex => {
            this.showError('Расписание не сохранено! ' + ex);
          });
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