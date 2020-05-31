<template lang="pug">
v-card.mx-auto(min-width="300px" max-width="480px")
  v-system-bar(color="primary" dark)
    small Заказано: {{item.created_at}}
    v-spacer
    c-certificate-cancel-dialog(:_item='item')
  div.body-2.pa-4.pb-1 
    kbd ФИО: {{item.fullFio}}
  div.body-2.px-4.py-1
    kbd email: {{item.email}}
  div.body-2.mb-1.px-4.py-1 
    kbd Тема: {{item.type}}
  v-card-text.pt-0(v-for="(info,i) in Object.keys(item.certificates_data)" :key="i") {{info}} : {{item.certificates_data[info]}}
  v-card-actions
    v-btn(block small color="success" @click="sendEmailDone()") Выполнить
  c-comfirm-dialog(ref='qwestion')
</template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение Vuex
//?----------------------------------------------
import { mapActions, mapGetters } from "vuex";

//?----------------------------------------------
//!           Подключение компонентов
//?----------------------------------------------
import CertificateCancelDialog_С from "@/js/components/certificate-f/CertificateCancelDialog";
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";

export default {
  components: {
    "c-certificate-cancel-dialog": CertificateCancelDialog_С,
    "c-comfirm-dialog": confirmDialog_C
  },

  mixins: [withSnackbar],

  data() {
    return {
      item: null,
      data: {
        id: null,
        to: null,
        by: null
      }
    };
  },

  computed: {
    ...mapGetters(["user"])
  },

  props: {
    _item: {
      type: Object,
      default: null
    }
  },

  async beforeMount() {
    this.item = this._item;
  },

  methods: {
    async sendEmailDone() {
      this.$refs.qwestion.pop().then(result => 
      {
        if (result) 
        {
          this.data.id = this._item.id;
          this.data.to = this._item.email;
          this.data.by = this.user.email;
          if (this.$store.dispatch(actions.RESPOND_СERTIFICATE, this.data)) 
            this.showInfo("Документ одобрен");
          else 
            this.showInfo("Что-то пошло не так. Обратитесь в службу поддержки. Спасибо.");
        }
      });
    }
  }
};
</script>