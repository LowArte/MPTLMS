<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab>Расписание</v-tab>
    <v-tab>Конструктор</v-tab>
    <v-tab-item>
      <Timetable v-bind:place="place" v-bind:schedule="schedule"  v-bind:callSchedule="call" v-bind:groups="groups" v-bind:departaments="departaments"/>
    </v-tab-item>
    <v-tab-item>
      <Constructor v-bind:discip="discip" v-bind:teachers="teachers" v-bind:place="place" v-bind:schedule="schedule"  v-bind:callSchedule="call" v-bind:groups="groups" v-bind:departaments="departaments"/>
    </v-tab-item>
  </v-tabs>
</template>

<script>
import Constructor from "./Components/ConstructorTimeTable";
import Timetable from "./Components/Timetable";
export default {
  data: () => ({
    tab: null,
  }),
  props:{
    discip:{
      type: String,
      default:null
    },
    place:{
      type: String,
      default:null
    },
    schedule:{
      type: String,
      default:null
    },
    call:{
      type: String,
      default:null
    },
    groups:{
      type: String,
      default:null
    },
    departaments:{
      type:String,
      default:null
    },
    teachers:{
      type:String,
      default:null
    }
  },
  components: {
    Timetable,
    Constructor
  },
};
</script>

