<template lang="pug">
  v-layout.row.wrap
    v-flex.my-2(v-if="printing == 1")
      v-card.mx-auto(width="420px" style="display: flex; flex-direction: column;" height="100%")
        v-skeleton-loader(max-height='200px' type="image")
        v-skeleton-loader.grow
          v-skeleton-loader.my-1.subtitle-1.black--text.pa-3(type="heading" max-height="70")
          v-skeleton-loader.my-1.subtitle-1.black--text.pa-3(type="text@3")
          v-skeleton-loader.my-1.subtitle-1.black--text.pa-3(type="text@3")
        v-card-actions(wrap)
          v-btn.mx-auto(text small block color="accent") Добавить
    c-retraining(v-for="(item, index) in _info" :key="index" :_user="_user" :_item="item")
</template>

<script>
import Retraining_C from "./components/Com_Ret";
export default {
  data: () => ({
    printing: 0
  }),
  props: {
    _info: {
      type: Array,
      default: null
    },
    _user: {
      type: Object,
      default: null
    },
    _printing: {
      type: Number,
      default: 0
    }
  },
  components: {
    "c-retraining": Retraining_C
  },
  mounted() {
    this.printing = this._printing;
  }
};
</script>