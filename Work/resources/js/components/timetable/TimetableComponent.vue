<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab>Расписание</v-tab>
    <v-tab>Замены</v-tab>
    <v-tab-item>
      <TimeTable v-bind:place="place" v-bind:schedule="schedule"  v-bind:callSchedule="call" v-bind:groups="groups" v-bind:departaments="departaments"/>
    </v-tab-item>
    <v-tab-item>
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
  }),
  props:{
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
    }
  },
  components: {
    TimeTable,
    Replacements
  }
};
</script>

