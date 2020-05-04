<template lang="pug">
  v-layout.row.wrap.pa-3
    v-card.mx-auto.pa-3(height='auto' width='100%')
      v-card-text.my-2.ma-0.pa-0.title Панель управления
      v-divider
      v-switch.mx-2(v-model="profilactic" label='Режим профилактики' color='accent')
      v-btn.justify-center(color="accent" block dark @click="send") Принять
</template>

<script>
import api_panel from "@/js/api/panel";
import { mapGetters } from "vuex";

import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import * as mutations from "@/js/store/mutation-types";

export default {
  mixins: [withSnackbar, withOverlayLoading],
  post_name: {
    name: "Настройки сервера",
    url: "/server_settings"
  },
  computed: {
    profilactic: 
    {
      get() {
        return this.$store.getters.profilactic.option_value == "true";
      },
      set(value) {
        this.$store.commit(mutations.SET_PROFILACTIC, String(value));
      }
    }
  },

  methods: 
  {
    async send() {
      if(await api_panel.setOptionValue({
          id: this.$store.getters.profilactic.id,
          value: this.$store.getters.profilactic.option_value
      }))
        this.showMessage("Принято!");
      else
        this.showError("Ошибка выполнения!");

    }
  }
};
</script>