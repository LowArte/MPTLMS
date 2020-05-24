<template lang="pug">
v-content.ma-0.pa-1
  v-layout.column.wrap
    v-data-iterator(:items="сertificate" :search="search" :items-per-page.sync="сertificate.length" :sort-by="sortBy.toLowerCase()" hide-default-footer no-data-text="" no-results-text="")
      template(v-slot:header)
        v-toolbar(dense floating)
          v-text-field(hide-details v-model="search" prepend-icon="search" single-line label="ФИО")
          v-btn.ma-0.mx-2(small icon @click="done = !done" color="primary")
            v-icon(:color="!done ? 'primary' : 'success'") mdi-swap-vertical
      template(v-slot:default="props" v-if="сertificate" )
        v-layout.row.wrap
          v-flex(v-if="item.done == 0 && done == false" v-for="item in props.items" :key="item.id" )
            c-certificate-granted-dialog(:_item='item')
          v-flex(v-if="item.done == 1 && done" v-for="item in сertificate" :key="item.id" )
            v-card.mx-auto(min-width="300px" max-width="480px")
              v-system-bar(color="success" dark)
                small Получено: {{item.created_at}} | Отвечено
              div.body-2.pa-4.pb-1 
                kbd ФИО: {{item.fullFio}}
              div.body-2.px-4.py-1 
                kbd email: {{item.email}}
              div.body-2.mb-1.px-4.py-1 
                kbd Тема: {{item.type}}
              v-card-text.pt-0(v-for="(info,i) in Object.keys(item.certificates_data)" :key="i") {{info}} : {{item.certificates_data[info]}}
</template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";
import withSnackbar from "@/js/components/mixins/withSnackbar";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

//?----------------------------------------------
//!           Подключение компонентов
//?----------------------------------------------
import CertificateGrantedDialog_С from "@/js/components/certificate-f/CertificateGrantedDialog";

export default {
  post_name: {
    name: "Заказанные справки",
    url: "list_certificate"
  },

  mixins: [withSnackbar, withOverlayLoading],

  components: {
    "c-certificate-granted-dialog": CertificateGrantedDialog_С
  },

  data() {
    return {
      search: "",
      sortBy: "name",
      done: false
    };
  },

  computed: {
    ...mapGetters(["сertificate"]),
  },

  async beforeMount() {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.SET_СERTIFICATE);
    this.closeLoading("Получение данных");
  },
};
</script>