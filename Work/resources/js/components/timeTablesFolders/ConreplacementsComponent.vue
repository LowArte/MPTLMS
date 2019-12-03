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
import Replacements from "./Components/Replacements";
export default {
  data: () => ({
    tab: null
  }),
  props:{
    replacements:{
      data:String,
      default:null
    }
  },
  components: {
    Replacements,
    Constructor
  }
};
</script>

