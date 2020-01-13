<template lang="pug">
  v-layout.row.wrap
      v-card.mx-auto.pa-3(height='auto' width='100%')
        v-card-text.my-2.ma-0.pa-0.title Панель управления
        v-divider
        v-switch.mx-2(v-model='options.option_value' label='Режим профилактики' color='accent')
        v-btn(color='accent' block @click='sendQuery') Применить
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