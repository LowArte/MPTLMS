<template>
  <v-tabs v-model="tab" background-color="transparent" color="basil" grow>
    <v-tab>Замены</v-tab>
    <v-tab>Конструктор</v-tab>
    <v-tab-item>
      <Replacements />
    </v-tab-item>
    <v-tab-item>
      <Constructor />
    </v-tab-item>
  </v-tabs>
</template>

<script>
import Constructor from "./Components/ConstructorReplacements";
import Replacements from "./Components/TeacherReplacements";
export default {
  data: () => ({
    tab: null
  }),
  components: {
    Replacements,
    Constructor
  }
};
</script>

