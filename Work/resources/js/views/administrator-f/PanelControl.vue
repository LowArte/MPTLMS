<template lang="pug">
  v-layout.row.wrap.pa-3
    v-card.mx-auto.pa-3(height='auto' width='100%')
      v-card-text.my-2.ma-0.pa-0.title Панель управления
      v-divider
      v-switch.mx-2(v-if="options != null" v-model='options.option_value' label='Режим профилактики' color='accent')
      v-btn.justify-center(color="accent" block dark @click="send") Принять
</template>

<script>
import api from "@/js/api/panel";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert

export default {
  mixins: [withSnackbar],
  post_name: {
    name: "Настройки сервера",
    url: "/server_settings"
  },

  data: () => {
    return {
      options: null
    };
  },

  beforeMount() {
    this.options = api.getSiteOptions(this);
    if (this.options != null)
      this.options.option_value = this.options.option_value == "true";
  },

  methods: {
    send() {
      api.setOptionValue({
        id: this.options.id,
        value: this.options.option_value
      }, this);
    }
  }
};
</script>