<template lang="pug">
    v-layout.column.wrap
        v-flex.ma-2.row
            v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
            v-combobox.ma-1(label="Группа" @change="group_change" item-text="group_name" :items="groups_info.groups"  v-model="groups_info.selected_group")
        v-layout.row.wrap
            v-flex.ma-2(v-for="(day_key,day_index)  in days" style="height:auto;" :key="day_index")
                v-card.pa-2.mx-auto(max-width="265px")
                    v-card-title.primary-title.pt-0 {{day_key}}
                    v-card-subtitle Место проведения: {{schedule[day_key].Place}}
                    v-divider
                    v-container.grid-list-xs(v-for="(lesson,lesson_index) in schedule[day_key]" :key="'l'+lesson_index")
                        v-card-title.pa-0.accent--text.font-weight-light.text-truncate(v-if="lesson.Lesson !=null") {{lesson.time}} 
                        |{{lesson.Lesson}} 
                        |{{lesson.Teacher}}
</template>

<script>
import group_api from "./../../api/group"
import schedule_api from "./../../api/schedule"

export default {
  data: () => {
    return {
        groups_info:null,
        departaments_info:null,
        schedule:null,
        days:[
            "Понедельник",
            "Вторник",
            "Среда",
            "Четверг",
            "Пятница",
            "Суббота",
        ]
    };
  },
  props:{
      _departaments_info:{
          type:String,
          default:null
      },
     _groups_info:{
          type:String,
          default:null
      },
     _schedule:{
          type:Object,
          default:null
      },
  },
  methods:{
      departament_change(){
          group_api.getGroup(this.departaments_info.selected_departament.id).then(
              res=>{
                  this.groups_info.groups = res.data.groups
                  this.groups_info.selected_group = this.groups_info.groups[0]
                  this.group_change()
              }
          ).catch(
              ex=>{
                  console.log(ex)
              }
          )
      },
      group_change(){
          schedule_api.getSchedule(this.groups_info.selected_group.id).then(
              res=>{
                  this.schedule = res.data.schedule
              }
          ).catch(
              ex=>{                  
                  console.log(ex)
              }
          )
      }
  },
  beforeMount(){
      this.groups_info = JSON.parse(this._groups_info)
      this.departaments_info = JSON.parse(this._departaments_info)
      this.schedule = this._schedule;
  }
};
</script>