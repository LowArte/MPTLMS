<template lang="pug">
    h1 История
</template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import * as actions from "@/js/store/action-types";
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

//?----------------------------------------------
//!           Подключение Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

export default {
  post_name: {
    name: "История системы",
    url: "history"
  },
  mixins: [withOverlayLoading],
  computed: mapGetters(["history"]),
  async beforeMount() {
    this.showLoading("Получение истории");
    if(!this.history)
      await this.$store.dispatch(actions.SET_HISTORY)
    this.closeLoading("Получение истории");
  }
};
</script>