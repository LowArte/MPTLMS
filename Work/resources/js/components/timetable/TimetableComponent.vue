<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab :key="item">Расписание</v-tab>
    <v-tab :key="item">Замены</v-tab>
    <v-tab-item :key="item">
      <TimeTable v-bind:schedule="schedule"  v-bind:callSchedule="call" v-bind:groups="groups" v-bind:departaments="departaments"/>
    </v-tab-item>
    <v-tab-item :key="item">
      <Replacements />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import TimeTable from "./Components/TimeTable"
import Replacements from "./Components/Replacements"
import axios from 'axios'

export default {
  data: () => ({
    tab: null,
    tabs: 2,
    tabitem: [
      {
        name: "Расписание",
        com: TimeTable
      },
      {
        name: "Замены",
        com: Replacements
      }
    ]
  }),
  props:{
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
    }
  },
  mounted:function(){
  },
  components: {
    TimeTable,
    Replacements
  }
};
</script>

