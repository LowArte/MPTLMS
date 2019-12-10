<template lang="pug">
  v-layout.row.wrap
    v-flex.my-2(v-for="(item,item_index) in table" :key="item_index")
      v-card.mx-auto(max-width="420px" height="100%")
        v-card-title.justify-center(primary-title) {{ item.place.place_name}}
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
    time_table: {
      Type: String,
      default: null
    }
  },
  mounted() {
    let arr = JSON.parse(this.time_table);
    for (let i = 0; i < arr.length; i++) {
      arr[i].schedule = JSON.parse(arr[i].schedule);
    }
    this.table = arr;
    console.log(this.table);
  }
};
</script>