<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab :key="item">Расписание</v-tab>
    <v-tab :key="item">Замены</v-tab>
    <v-tab-item :key="item">
      <TimeTable />
    </v-tab-item>
    <v-tab-item :key="item">
      <Replacements />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import TimeTable from "./Components/TimeTable";
import Replacements from "./Components/Replacements";
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
  components: {
    TimeTable,
    Replacements
  }
};
</script>

