<template lang="pug">
    v-layout.column.wrap
        v-flex.ma-2.row
            v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
            v-combobox.ma-1(label="Группа" @change="group_change" item-text="group_name" :items="groups_info.groups"  v-model="groups_info.selected_group")
        v-card-title.primary-title.pt-0.px-0
            v-chip.pa-2.ml-2(label) 
              v-card-title.pa-0.accent--text.font-weight-light.text-truncate.overline {{ isToday ==0 ? "Числитель" :"Знаменатель" }}
        v-layout.row.wrap
          v-flex.sm12.md6.lg4.xl2(v-for="(day_key,day_index) in days" :key="day_index")
            v-card.pa-2.mx-auto(max-width="268px"  style="display: flex; flex-direction: column;" height="100%" :elevation="0" )
              v-card-title.primary-title.pt-0.px-0 {{day_key}} 
                v-card-subtitle.px-0.pt-0 Место проведения: {{schedule[day_key].Place}}
                v-divider
                v-container.grid-list-xs.pa-0(v-for="(lesson,lesson_index) in schedule[day_key]" :key="'l'+lesson_index" v-if="lesson.Lesson != null")
                    v-container.pa-0.ma-0(v-if="Array.isArray(lesson.Lesson) == false")
                        v-card-title.pa-0.accent--text.font-weight-light.text-truncate {{lesson.time}} 
                        v-card-text.pa-0.wrap.text-black {{lesson.Lesson}} 
                        v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.Teacher }}
                        v-divider.ma-0
                    v-container.pa-0.ma-0(v-else-if="lesson.Lesson[isToday] != null")
                        v-card-title.pa-0.accent--text.font-weight-light.text-truncate() {{ lesson.time }} 
                        v-container.pa-0.ma-0
                            v-container.pa-0.ma-0(v-if="Array.isArray(lesson.Lesson[isToday])==false")
                                v-card-text.pa-0.wrap.text-black {{ lesson.Lesson[isToday]}} 
                                v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.Teacher[isToday] }}
                            v-container.pa-0.ma-0(v-else)
                                v-card-text.pa-0.wrap.text-black {{ lesson.Lesson[isToday][0] == lesson.Lesson[isToday][1] ? (lesson.Lesson[isToday][0]) : (lesson.Lesson[isToday][0] + ',' + lesson.Lesson[isToday][1])  }} 
                                v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.Teacher[isToday][0] == lesson.Teacher[isToday][1] ? (lesson.Teacher[isToday][0]) : (lesson.Teacher[isToday][0] + ',' + lesson.Teacher[isToday][1])  }} 
                            v-container.pa-0.ma-0
                                v-divider.mt-2
                                v-expansion-panels.px-1.py-0(v-if="lesson.Lesson[isToday == 0 ?  1 : 0] != null" style="z-index: initial;")                    
                                    v-expansion-panel.px-1.py-0
                                        v-expansion-panel-header.px-1.py-0 {{ isToday == 0 ? "Знаменатель" :"Числитель" }}                 
                                        v-expansion-panel-content.px-0.mx-0
                                                v-container.pa-0.ma-0(v-if="Array.isArray(lesson.Lesson[isToday == 0 ?  1 : 0])==false")
                                                    v-card-text.pa-0.wrap.text-black {{ lesson.Lesson[isToday == 0 ?  1 : 0]}} 
                                                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.Teacher[isToday == 0 ?  1 : 0] }}
                                                v-container.pa-0.ma-0(v-else)
                                                    v-card-text.pa-0.wrap.text-black {{ lesson.Lesson[isToday == 0 ?  1 : 0][0] == lesson.Lesson[isToday == 0 ?  1 : 0][1] ? (lesson.Lesson[isToday == 0 ?  1 : 0][0]) : (lesson.Lesson[isToday == 0 ?  1 : 0][0] + ',' + lesson.Lesson[isToday == 0 ?  1 : 0][1])  }} 
                                                    v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ lesson.Teacher[isToday == 0 ?  1 : 0][0] == lesson.Teacher[isToday == 0 ?  1 : 0][1] ? (lesson.Teacher[isToday == 0 ?  1 : 0][0]) : (lesson.Teacher[isToday == 0 ?  1 : 0][0] + ',' + lesson.Teacher[isToday == 0 ?  1 : 0][1])  }} 
                                v-divider.ma-0(v-if="lesson.Lesson[isToday == 0 ?  1 : 0] != null")
</template>

<style scoped>
.v-expansion-panel-content__wrap {
  padding: 0;
}
</style>

<script>
import group_api from "./../../api/group";
import schedule_api from "./../../api/schedule";
Date.prototype.getWeek = function() {
  const onejan = new Date(this.getFullYear(), 0, 1);
  return Math.ceil(((this - onejan) / 86400000 + onejan.getDay() + 1) / 7);
};

export default {
  data: () => {
    return {
      groups_info: null,
      departaments_info: null,
      schedule: null,
      isToday: null,
      days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]
    };
  },
  props: {
    _departaments_info: {
      type: String,
      default: null
    },
    _groups_info: {
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
    isChisl() {
      const today = new Date();
      return today.getWeek() % 2;
    },
    group_change() {
      schedule_api
        .getSchedule(this.groups_info.selected_group.id)
        .then(res => {
          this.schedule = res.data.schedule;
        })
        .catch(ex => {
          console.log(ex);
        });
    }
  },
  beforeMount() {
    this.groups_info = JSON.parse(this._groups_info);
    this.departaments_info = JSON.parse(this._departaments_info);
    this.schedule = this._schedule;
    this.isToday = 1;
    console.log(this.isChisl());
  }
};
</script>