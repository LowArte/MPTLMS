<template lang="pug">
    vue-extend-layout
</template>

<script>
import VueExtendLayout from '@/js/components/extended-layout-f/vue-extend-layout';
import * as mutations from "@/js/store/mutation-types";

export default {
  components: { VueExtendLayout },
  props: {
    _name: {
      type: String,
      default: "Личный кабинет"
    },
    _is_profilactic:{
      type:Boolean,
      default:false
    }
  },
  mounted(){
    this.$store.commit(mutations.SET_SERVER,{isProfilactic:this._is_profilactic,name:this._name})
  },
};
</script>