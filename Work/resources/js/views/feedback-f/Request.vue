<template lang="pug">
  v-layout.row.wrap(align='center' justify='center')
    v-col(cols='12')
      c-comfirm-dialog(ref="qwestion")
      v-card.mx-auto.pa-2(outline height='auto' width='max')
        v-data-table.pa-0(:headers='headers' :items='items' :single-expand='true' no-results-text='Нет результатов' no-data-text='Нет результатов' :expanded.sync='expanded' item-key='id' show-expand :page.sync='page' hide-default-footer @page-count='pageCount = $event' :search='search' :items-per-page='itemsPerPage')
          template(v-slot:top)
            v-card-title.ma-0.pa-0 Обращение пользователей
            v-tooltip(bottom)
              template(v-slot:activator="{ on }")
                  v-btn.ma-2.ml-1(text v-on="on" @click="Update()")
                      v-icon replay
                      span.ma-2 Обновить
              span Обновить таблицу
            v-text-field.ma-0(v-model='search' label='Поиск' single-line hide-details)
          template(v-slot:item.answered="{ item }")
            v-card-text.ma-0.pa-0(v-if="item['answered']") Да
            v-card-text.ma-0.pa-0(v-else) Нет
          template(v-slot:expanded-item='{ headers }')
            td(:colspan='headers.length' v-if='expanded.length > 0')
              v-card-text.my-1.ma-0.pa-0.text(v-if="expanded[0].fio != null") ФИО: {{expanded[0].fio}}
              v-card-text.my-1.ma-0.pa-0.text Текст: {{expanded[0].text}}
              v-form.ma-2.pt-2(v-model='form')
                v-textarea.mt-0.pt-0(v-model='modelmessage' :auto-grow='true' :clearable='false' :counter='255 ? 255 : false' :filled='false' :flat='true' :hint="'Не более 255 символов'" :label="'Сообщение'" :loading='false' :no-resize='false' :outlined='false' :persistent-hint='false' :placeholder="''" :rounded='false' :row-height='24' :rows='3' :shaped='false' :single-line='false' :solo='false' :rules='messageRules')
                v-btn.ma-1.white--text(:disabled='!form' color='blue' depressed @click='sendQuery(expanded[0].email)') Ответить
        .text-center.pt-2.mx-auto.pa-0
            v-pagination(v-model='page' :length='pageCount')
</template>

<script>
//?----------------------------------------------
//!           Подключение масок vue
//?----------------------------------------------
import { mask } from "vue-the-mask"; //Маска

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import feedbackApi from "@/js/api/feedback";

//?----------------------------------------------
//!           Подключение диалогов
//?----------------------------------------------
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";

export default {
  post_name: {
    name: "Просмотр обращений пользователей",
    url: "requests"
  },
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
        { text: "Тема", value: "type" },
        { text: "E-mail", value: "user.email" },
        { text: "Отвечено", value: "answered" },
        { text: "Дата", value: "created_at" },
        { text: "", value: "data-table-expand" }
      ],
      items: []
    };
  },

  components: {
    "c-comfirm-dialog": confirmDialog_C
  },

  //Преднастройка
  beforeMount() {
    this.Update();
  },

  methods: {
    clear() {
      this.$refs.qwestion.pop().then(result => {
        if (result) {
          this.showMessage("Действие было выполнено успешно");
        } else {
          this.showInfo("Действие было отменено пользователем");
        }
      });
    },
    sendQuery(email) {
      feedbackApi
        .sendEmail({
          mail: email,
          text: this.modelmessage,
          id: this.expanded[0].id
        })
        .then(result => {
          this.showMessage("Сообщение отправлено");
          this.items.splice(this.expanded[0]);
        })
        .catch(ex => {
          this.showError("Произошла следующая ошибка! " + ex);
        });
      this.modelmessage = "";
    },

    //Отправка сообщения о том, что справка готова
    Update() 
    {
        feedbackApi
          .getFeedbackRequests()
          .then(res => {
            this.items = res.data.feedback;
          })
          .catch(ex => {
            this.showError("Произошла ошибка! " + ex);
          });
    }
  }
};
</script>