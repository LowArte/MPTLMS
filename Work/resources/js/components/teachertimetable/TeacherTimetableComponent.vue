<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab :key="item">Расписание</v-tab>
    <v-tab :key="item">Замены</v-tab>
    <v-tab-item :key="item">
      <TeacherTimeTable />
    </v-tab-item>
    <v-tab-item :key="item">
      <TeacherReplacements />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import TeacherTimeTable from "./Components/TeacherTimeTable";
import TeacherReplacements from "./Components/TeacherReplacements";
export default {
  data: () => ({
    tab: null,
    tabs: 2,
    tabitem: [
      {
        name: "Расписание",
        com: TeacherTimeTable
      },
      {
        name: "Замены",
        com: TeacherReplacements
      }
    ]
  }),
  components: {
    TeacherTimeTable,
    TeacherReplacements
  }
};
</script>

