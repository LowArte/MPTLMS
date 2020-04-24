<template lang="pug">
v-content.ma-0.pa-1
  v-layout.row.wrap
    v-flex(v-for="items  in GET_FEEDBACK" :key="items.id")
      p 
</template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
//import api_feedback from "@/js/api/feedback";
import { mapGetters } from "vuex";

//?----------------------------------------------
//!           Подключение диалогов
//?----------------------------------------------
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";

export default {
  post_name: {
    name: "Просмотр обращений пользователей",
    url: "requests"
  },

  data() {
    return {
      feedback: []
    };
  },

  mixins: [withSnackbar, withOverlayLoading],

  components: {
    "c-comfirm-dialog": confirmDialog_C
  },

  computed: mapGetters(["GET_FEEDBACK"]),

  async mounted() 
  {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.FILL_UP_FEEDBACK);
    console.log(await this.GET_FEEDBACK);
    this.closeLoading("Получение данных");
  }
};
</script>