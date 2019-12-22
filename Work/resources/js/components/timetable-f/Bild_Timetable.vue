<template lang="pug">
    v-layout.column.wrap
      v-flex.ma-2.row
        v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
        v-combobox.ma-1(label="Группа" @change="group_change" item-text="group_name" :items="groups_info.groups"  v-model="groups_info.selected_group")
      v-divider.ma-0
      v-flex.ma-0.pa-0.row
        v-tabs(background-color="transparent" color="basil" mobile-break-point=0 grow next-icon="mdi-arrow-right-bold-box-outline" prev-icon="mdi-arrow-left-bold-box-outline" show-arrows)
          v-tab(v-for="(day_key,day_index) in days" :key="day_index") {{day_key}}
          v-tab-item(v-for="(day_key, day_index) in days" :key="day_index") 
            v-card.mx-auto.pa-1.max(width='100%' height='auto')
              //- p {{schedule[day_key]}}
              v-select.pa-0.mb-0.mt-2(v-model="schedule[day_key]['Place']" label="Место проведения" solo :items="places" item-text="place_name" item-value="id")
              v-card.pa-2(width='100%' outlined tile v-for="(lesson_key,lesson_index) in 7" :key="lesson_index") 
                v-card-title.primary-title.pt-0.px-0 {{lesson_key}} пара
                v-card-title.pa-0.accent--text.font-weight-light.text-truncate(v-if="checkbox[day_index][lesson_index]") Числитель
                v-autocomplete(v-model="schedule[day_key][lesson_key]['Lesson']" label="Дисциплины" :items="discip" item-text='discipline_name' small-chips chips multiple)
                v-autocomplete(v-model="schedule[day_key][lesson_key]['Teacher']" label="Преподаватели" :items="teachers" item-text='name' small-chips chips multiple)
                v-switch(v-model="checkbox[day_index][lesson_index]" color="primary" inset label="Числитель/Знаменатель" @change="changeCheckBox(day_index, lesson_index)")
                v-card-title.pa-0.accent--text.font-weight-light.text-truncate(v-if="checkbox[day_index][lesson_index]") Знаменатель
                v-autocomplete(v-model="schedule[day_key][lesson_key]['Lesson']" v-if="checkbox[day_index][lesson_index]" label="Дисциплины" :items="discip" item-text='discipline_name' small-chips chips multiple)
                v-autocomplete(v-model="schedule[day_key][lesson_key]['Teacher']" v-if="checkbox[day_index][lesson_index]" label="Преподаватели" :items="teachers" item-text='name' small-chips chips multiple)
        v-btn.mt-2.justify-center(color="accent" block dark @click="sendQuery") Принять
</template>

<style scoped>
.v-expansion-panel-content__wrap {
  padding: 0;
}
</style>

<script>
import group_api from "./../../api/group";
import schedule_api from "./../../api/schedule";

export default {
  data: () => {
    return {
      groups_info: null, //Группы
      departaments_info: null, //Отделения
      schedule: null, //Расписание
      places: null, //Места проведения
      teachers: null, //Преподаватели
      discip: null, //Дисциплины
      checkbox: [], //Чек боксы для числителя знаменателя
      days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]
    };
  },
  props: {
    _departaments_info: {
      type: Object,
      default: null
    },
    _groups_info: {
      type: Object,
      default: null
    },
    _places: {
      type: String,
      default: null
    },
    _teachers: {
      type: String,
      default: null
    },
    _discip: {
      type: String,
      default: null
    },
    _schedule: {
      type: Object,
      default: null
    }
  },
  methods: {
    departament_change() {
      group_api
        .getGroup(this.departaments_info.selected_departament.id)
        .then(res => {
          this.groups_info.groups = res.data.groups;
          this.groups_info.selected_group = this.groups_info.groups[0];
          this.group_change();
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    group_change() {
      schedule_api
        .getBildSchedule(this.groups_info.selected_group.id)
        .then(res => {
          this.schedule = res.data.schedule;
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    changeCheckBox(day, lesson){
      if(!this.checkbox[day][lesson])
      {
        //this.schedule[day][lesson] = [];
      }
    },
    sendQuery(){
      schedule_api
        .saveSchedule({group_id: this.groups_info.selected_group.id, schedule: this.schedule})
        .then(res => {
          this.group_change();
          alert('Расписание сохранено!');
        })
        .catch(ex => {
          console.log(ex);
          alert('Расписание не сохранено!');
        });
    }
  },
  beforeMount() {
    this.groups_info = this._groups_info;
    this.departaments_info = this._departaments_info;
    this.schedule = this._schedule;
    this.places = JSON.parse(this._places);
    this.teachers = JSON.parse(this._teachers);
    this.discip = JSON.parse(this._discip);
    for(var i = 0; i < 6; i++)
    {
      this.checkbox.push([]);
      for(var j = 0; j < 7; j++)
      {
        this.checkbox[i].push(false);
      }  
    }
  }
};
</script>