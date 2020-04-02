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
    _isProfilactic:{
      type:Boolean,
      default:false
    }
  },
  mounted(){
    console.log(this._isProfilactic)
    this.$store.commit(mutations.SET_SERVER,{isProfilactic:this._isProfilactic,name:this._name})
  },
};
</script>