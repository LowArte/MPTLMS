<template lang="pug">
  v-layout.row.wrap
    c-retraining(v-for="(item, index) in data" :key="index" :item="item")
</template>

<script>
import Retraining_C from "./components/Com_Ret";
export default {
  props: {
    components_prop: {
      type:String,
      default:null
    }
  },
  data() {
    return {
      data: {}
    };
  },
  mounted() {
    console.log(user);
    this.data = JSON.parse(this.components_prop);
  },
  components: {
    "c-retraining": Retraining_C
  }
};
</script>