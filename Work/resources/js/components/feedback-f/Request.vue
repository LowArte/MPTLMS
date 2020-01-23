<template lang="pug">
    v-layout.row.wrap(align='center' justify='center')
        v-col(cols='12')
            v-card.mx-auto.pa-2(outline height='auto' width='max')
                v-data-table.pa-0(:headers='headers' :items='items' :single-expand='true' no-results-text='Нет результатов' no-data-text='Нет результатов' :expanded.sync='expanded' item-key='id' show-expand :page.sync='page' hide-default-footer @page-count='pageCount = $event' :search='search' :items-per-page='itemsPerPage')
                    template(v-slot:top)
                        v-card-title.ma-0.pa-0 Обращение пользователей
                        v-tooltip(bottom)
                            template(v-slot:activator="{ on }")
                                v-btn.ma-2.ml-1(text v-on="on")
                                    v-icon mdi-delete
                            span Очистить
                        v-tooltip(bottom)
                            template(v-slot:activator="{ on }")
                                v-btn.ma-2.ml-1(text v-on="on")
                                    v-icon mdi-reply-all
                            span Ответить всем
                        v-text-field.ma-0(v-model='search' label='Поиск' single-line hide-details)
                    template(v-slot:expanded-item='{ headers }')
                        td(:colspan='headers.length' v-if='expanded.length > 0')
                            v-card-text.my-1.ma-0.pa-0.text ФИО: {{expanded[0].fio}}
                            v-card-text.my-1.ma-0.pa-0.text Текст: {{expanded[0].body}}
                            br
                            v-form.mt-0.pt-0(v-model='form')
                                v-container.mt-0.pt-0
                                    v-row.mt-0.pt-0
                                        v-textarea.mt-0.pt-0(v-model='modelmessage' :auto-grow='true' :clearable='false' :counter='255 ? 255 : false' :filled='false' :flat='true' :hint="'Не более 255 символов'" :label="'Сообщение'" :loading='false' :no-resize='false' :outlined='false' :persistent-hint='false' :placeholder="''" :rounded='false' :row-height='24' :rows='3' :shaped='false' :single-line='false' :solo='false' :rules='messageRules')
                                    v-row.pa-2.justify-center
                                        v-btn.white--text(:disabled='!form' color='blue' depressed @click='sendQuery(expanded[0].email)') Ответить
                .text-center.pt-2.mx-auto.pa-0
                    v-pagination(v-model='page' :length='pageCount')
                    v-text-field(:value='itemsPerPage' label='Кол-во' v-mask='mask' @input='itemsPerPage = parseIntLoc($event)')
</template>

<script>
import { mask } from "vue-the-mask";
import withSnackbar from "../mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  directives: {
    mask
  },
  data() {
    return {
      modelmessage: "",
      messageRules: [
        v => v.length > 0 || "Текст сообщения не указан",
        v =>
          v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
      ],
      form: false,
      search: "",
      mask: "####",
      expanded: [],
      singleExpand: true,
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,
      headers: [
        { text: "Тема", value: "name" },
        { text: "E-mail", value: "email" },
        { text: "Дата", value: "date" },
        { text: "", value: "data-table-expand" }
      ],
      items: []
    };
  },
  props: {
    _requests: {
      data: String,
      default: ""
    }
  },
  mounted() {
    this.items = JSON.parse(this._requests);
    console.log(this.items);
  },
  methods: {
    sendQuery(email) {
      feedbackApi
        .sendEmail({
          mail: email,
          text: this.modelmessage,
          id: this.expanded[0].id
        })
        .then(res => {
          this.showMessage("Ответ отправлен");
          this.items.splice(this.expanded[0]);
        })
        .catch(exp => {
          this.showError("Произошла ошибка");
        });
      this.modelmessage = "";
    },
    parseIntLoc(val) {
      if (val == "" || val == null || val == "0") {
        return 1;
      }
      return parseInt(val);
    }
  }
};
</script>