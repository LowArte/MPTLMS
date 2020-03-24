<template lang="pug">
  v-layout.row.wrap
    v-card.mx-auto.pa-3(height='auto' width='100%')
      v-card-text.my-2.ma-0.pa-0.title Панель управления
      v-divider
      v-switch.mx-2(v-model='options.option_value' label='Режим профилактики' color='accent')
      v-btn.justify-center(color="accent" block dark @click="sendQuery") Принять
</template>

<script>
import panelApi from "@/js/api/panel";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения

export default {
  mixins: [withSnackbar],
  post_name: {
    name: "Настройки сервера",
    url: "server_settings"
  },
  data: () => {
    return {
      options: null
    };
  },

  props: {
    _options: {
      data: Object,
      default: null
    },
    _slug: {
      type: String,
      default: ""
    }
  },

  beforeMount() {
    this.options = this._options;
    this.options.option_value = this.options.option_value == "true";
  },

  methods: {
    sendQuery() {
      panelApi
        .setOptionValue({
          id: this.options.id,
          value: this.options.option_value,
          slug: this._slug
        })
        .then(res => {
          this.showMessage("Настройки сохранены!");
        })
        .catch(ex => {
          this.showError(ex);
        });
    }
  }
};
</script>