<template lang="pug">
  v-layout.row.wrap.pa-3
    v-card.mx-auto.pa-3(height='auto' width='100%')
      v-card-text.my-2.ma-0.pa-0.title Панель управления
      v-divider
      v-switch.mx-2(v-if="options != null" v-model='options.option_value' label='Режим профилактики' color='accent')
      v-btn.justify-center(color="accent" block dark @click="sendQuery") Принять
</template>

<script>
import panelApi from "@/js/api/panel";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения

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
    this.update();
  },

  methods: {
    //Получение данных настроек сервера
    update()
    {
      panelApi
        .getSiteOptions({})
        .then(res => {
          this.options = res.data.siteOptions;
          this.options.option_value = this.options.option_value == "true";
        })
        .catch(ex => {
          this.showError("Ошибка получения данных! " + ex);
        });
    },

    sendQuery() {
      panelApi
        .setOptionValue({
          id: this.options.id,
          value: this.options.option_value
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