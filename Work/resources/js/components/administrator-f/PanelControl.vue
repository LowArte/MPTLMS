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
              v-switch(v-model='options.option_value'  label='Режим профилактики')
            v-btn.ma-2(color='accent' dark='' @click='sendQuery') Применить
</template>

<script>
import panelApi from "../../api/panel";

export default {
  data:()=>{
    return {
      options:null
    }
  },
  props: {
    _options: {
      data: Object,
      default: null
    }
  },
  beforeMount() {
    this.options = this._options
    console.log(this.options)
    this.options.option_value = this.options.option_value == "true"
        console.log(this.options)
  },
  methods: {
    sendQuery() {
      console.log(this.options.option_value)
      panelApi
        .setOptionValue({
          id: this.options.id,
          value: this.options.option_value
        })
        .then(res => {
          console.log(res);
        })
        .catch(ex => {
          console.log(ex);
        });
    }
  }
};
</script>