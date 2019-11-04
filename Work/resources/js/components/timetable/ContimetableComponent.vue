<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab :key="item">Расписание</v-tab>
    <v-tab :key="item">Конструктор</v-tab>
    <v-tab-item :key="item">
      <Timetable />
    </v-tab-item>
    <v-tab-item :key="item">
      <Constructor />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import Constructor from "./Components/ConstructorTimeTable";
import Timetable from "./Components/Timetable";
export default {
  data: () => ({
    tab: null,
    tabs: 2,
    tabitem: [
      {
        name: "Расписание",
        com: Timetable
      },
      {
        name: "Конструктор",
        com: Constructor
      }
    ]
  }),
  components: {
    Timetable,
    Constructor
  }
};
</script>

