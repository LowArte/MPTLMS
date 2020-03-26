<template lang="pug">
  v-layout.row.wrap
    v-flex(v-for="(item,item_index) in _time_table" :key="item_index")
      v-card.mx-auto(max-width="420px" height="100%" :elevation='0')
        v-card-title.justify-center(primary-title) {{ item.place.place_name}}
        v-card-text.subtitle-1(v-for="(schedul,schedul_index) in item.schedule" :key="'s' + schedul_index") {{ schedul_index }} пара {{ schedul }}
          v-divider
</template>

<script>
import { mask } from "vue-the-mask";
export default {
  post_name: {
    name: "Рассписание звонков",
    url: "callschedule"
  },
  directives: 
  {
    mask
  },
  
  props: 
  {
    _time_table: {
      Type: String,
      default: null
    }
  }
};
</script>