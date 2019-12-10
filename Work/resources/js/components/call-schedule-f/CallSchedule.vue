<template lang="pug">
  v-layout.row.wrap
    v-flex.my-2(v-for="(item,item_index) in table" :key="item_index")
      v-card.mx-auto(max-width="500px" height="100%" :elevation="0")
        v-card-title.justify-center(primary-title) {{ item.place}}
        v-card-text.subtitle-1(v-for="(schedul,schedul_index) in item.schedule" :key="'s' + schedul_index") {{ schedul_index }} пара {{ schedul }}
          v-divider
</template>

<script>
import { mask } from "vue-the-mask";
export default {
  directives: {
    mask
  },
  data: () => {
    return {
      table: null
    };
  },
  props: {
    _time_table: {
      Type: String,
      default: null
    }
  },
  mounted() {
    let arr = JSON.parse(this._time_table);
    for (let i = 0; i < arr.length; i++) {
      arr[i].schedule = JSON.parse(arr[i].schedule);
    }
    this.table = arr;
  }
};
</script>