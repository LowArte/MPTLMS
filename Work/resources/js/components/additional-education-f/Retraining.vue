<template lang="pug">
  v-layout.row.wrap
    c-retraining(v-for="(item, index) in _info" :key="index" :_user="_user" :_item="item")
</template>

<script>
import Retraining_C from "./components/Com_Ret";
export default {
  props: {
    _info: {
      type:Array,
      default:null
    },
    _user: {
      type:Object,
      default:null
    }
  },
  components: {
    "c-retraining": Retraining_C
  }
};
</script>