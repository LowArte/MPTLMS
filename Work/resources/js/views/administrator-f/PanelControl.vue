<template lang="pug">
  v-layout.row.wrap.pa-3
    v-card.mx-auto.pa-3(height='auto' width='100%' v-if="loaded" )
      v-card-text.my-2.ma-0.pa-0.title Панель управления
      v-divider
      v-switch.mx-2(v-if="options != null" v-model='options.option_value' label='Режим профилактики' color='accent')
      v-btn.justify-center(color="accent" block dark @click="send") Принять
</template>

<script>
import api from "@/js/api/panel";
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import * as mutations from "@/js/store/mutation-types";

export default {
  mixins: [withSnackbar, withOverlayLoading],
  post_name: {
    name: "Настройки сервера",
    url: "/server_settings"
  },

  data: () => {
    return {
      options: null,
      loaded: true
    };
  },

  async beforeMount() 
  {
    this.showLoading("Получение настроек...");
    this.loaded = false;
    this.options = await api.getSiteOptions(this);
    if (this.options != null)
      this.options.option_value = this.options.option_value == "true";
    this.closeLoading("Получение настроек...");
    this.loaded = true;
  },

  methods: {
    async send() {
      let result = await api.setOptionValue({
        id: this.options.id,
        value: this.options.option_value
      }, this);

      if(result){
        this.$store.commit(mutations.SET_PROFILACTIC,this.options.option_value)
      }
    }
  }
};
</script>