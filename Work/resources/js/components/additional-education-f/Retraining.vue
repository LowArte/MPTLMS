<template lang="pug">
  v-layout.row.wrap
    c-new-do(v-if="printing == 1" :_add="add")
    c-retraining-cards(v-for="(item, index) in _info" :key="index" :_user="_user" :_item="item")
</template>

<script>
import Retraining_C from "./components/C_Retraining";
import NewDO_C from "./components/C_NewDO";

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
    "c-retraining-cards": Retraining_C,
    "c-new-do": NewDO_C
  },

  mounted() {
    this.printing = this._printing;
  },

  methods: {
    add(item) {
      this._info.unshift(item);
    }
  }
};
</script>