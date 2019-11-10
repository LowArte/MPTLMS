<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab>Расписание</v-tab>
    <v-tab>Замены</v-tab>
    <v-tab-item >
      <TimeTable />
    </v-tab-item>
    <v-tab-item>
      <TeacherReplacements />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import TimeTable from "./Components/TimeTable";
import TeacherReplacements from "./Components/TeacherReplacements";
export default {
  data: () => ({
    tab: null,
  }),
  components: {
    TimeTable,
    TeacherReplacements
  }
};
</script>

