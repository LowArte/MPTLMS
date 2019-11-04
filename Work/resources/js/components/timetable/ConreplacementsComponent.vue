<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab :key="item">Замены</v-tab>
    <v-tab :key="item">Конструктор</v-tab>
    <v-tab-item :key="item">
      <Replacements />
    </v-tab-item>
    <v-tab-item :key="item">
      <Constructor />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import Constructor from "./Components/ConstructorReplacements";
import Replacements from "./Components/TeacherReplacements";
export default {
  data: () => ({
    tab: null,
    tabs: 2,
    tabitem: [
      {
        name: "Замены",
        com: Replacements
      },
      {
        name: "Конструктор",
        com: Constructor
      }
    ]
  }),
  components: {
    Replacements,
    Constructor
  }
};
</script>

