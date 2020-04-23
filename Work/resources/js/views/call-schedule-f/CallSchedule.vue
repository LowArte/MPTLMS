<template lang="pug">
  v-content.ma-0.pa-1
    v-layout.row.wrap
      v-flex(v-for="(item,item_index) in call_schedule" :key="item_index")
        v-card.mx-auto(max-width="420px" height="100%" :elevation='0' flat)
          v-card-title.justify-center(primary-title) {{ item.place.place_name}}
          v-card-text.subtitle-1(v-for="(schedul,schedul_index) in item.schedule" :key="'s' + schedul_index") {{ schedul_index }} пара {{ schedul }}
            v-divider
</template>

<script>
import api_call_schedule from "@/js/api/callSchedule"; //api для расписания звонков

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed:{
    ...mapGetters(["call_schedule"]),
  },
  post_name: {
    name: "Расписание звонков",
    url: "callschedule"
  },

  beforeMount()
  {
    this.init();
  },
  
  methods:{
    async init()
    {
      if(this.call_schedule == null)
      {
        let timeTable = await api_call_schedule.getCallSchedule(this);
        await this.$store.commit(mutations.SET_CALL_SCHEDULE, timeTable);
      }
    }
  }
};
</script>