<template lang="pug">
  v-row
    v-col(cols='12')
      v-hover(v-slot:default='{ hover }')
        v-card.mx-auto.pa-0(:elevation='hover ? 12 : 2' height='auto' width='max')
          v-container.pa-0.ma-0
            v-row.pa-2.ma-0
              v-card-text.my-2.ma-0.pa-0.text-center.title Панель управления
            v-divider
            v-row.pa-2.ma-0
              v-checkbox(v-model='options.prof' :label='`Режим профилактики`')
            v-btn.ma-2(color='accent' dark='' @click='sendQuery') Применить
</template>

<script>
import panelApi from "../../api/panel";

export default {
  data: () => ({
    options: {
      prof: false
    }
  }),
  components: {},
  props: {
    options_prop: {
      data: String,
      default: null
    }
  },
  mounted() {
    this.options = JSON.parse(this.options_prop);
    console.log(this.options);
  },
  methods: {
    sendQuery() {
      Object.keys(this.options).forEach(element => {
        switch (element) {
          case "prof": {
            panelApi
              .setOptionValue({
                prop: "isProfilacticServer",
                value: this.options[element]
              })
              .then(res => {
                console.log(res);
              })
              .catch(ex => {
                console.log(ex);
              });
            break;
          }
        }
      });
    }
  }
};
</script>