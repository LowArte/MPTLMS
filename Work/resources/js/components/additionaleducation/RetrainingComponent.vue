<template lang="pug">
  v-layout.row.wrap
    retraining(v-for="(item, index) in data" :key="index" :item="item")
</template>

<script>
import Retraining from "./RetCom";
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
    retraining: Retraining
  }
};
</script>