<template lang="pug">
v-content.ma-0.pa-1
  v-layout.row.wrap
    c-comfirm-dialog(ref="qwestion")
    v-flex
      v-card
        v-system-bar
          span Обращение пользователей
        v-content.pa-0
          v-data-table.pa-0(:headers='headers' :items='items' :single-expand='true' no-results-text='Нет результатов' no-data-text='Нет результатов' :expanded.sync='expanded' item-key='id' show-expand :page.sync='page' hide-default-footer @page-count='pageCount = $event' :search='search' :items-per-page='itemsPerPage')
            template(v-slot:top)
              v-text-field.ma-0.pa-2(v-model='search' outlined dense label='Поиск' single-line hide-details)
              v-tooltip(bottom)
                template(v-slot:activator="{ on }")
                    v-btn.ma-2.ml-1(text v-on="on" @click="Update()")
                        v-icon replay
                        span.ma-2 Обновить
                span Обновить таблицу
            template(v-slot:item.answered="{ item }")
              v-card-text.ma-0.pa-0(v-if="item['answered']") Да
              v-card-text.ma-0.pa-0(v-else) Нет
            template(v-slot:expanded-item='{ headers }')
              td.pa-2(:colspan='headers.length' v-if='expanded.length > 0')
                v-form.ma-2(ref='form')
                  v-card-text.pa-1.text(v-if="expanded[0].fio != null") ФИО: {{expanded[0].fio}}
                  v-card-text.pa-1.text Текст: {{expanded[0].text}}
                  v-textarea.pa-1(v-model='modelmessage' :auto-grow='true' :clearable='false' :counter='255 ? 255 : false' :filled='false' :flat='true' :hint="'Не более 255 символов'" :label="'Сообщение'" :loading='false' :no-resize='false' :outlined='false' :persistent-hint='false' :placeholder="''" :rounded='false' :row-height='24' :rows='3' :shaped='false' :single-line='false' :solo='false' :rules='messageRules')
                  v-btn.ma-1.white--text(color='blue' depressed @click='sendQuery(expanded[0].user.email)') Ответить
        v-layout.row.text-center.pa-2.ma-2
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
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_feedback from "@/js/api/feedback";

//?----------------------------------------------
//!           Подключение диалогов
//?----------------------------------------------
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";

export default {
  post_name: {
    name: "Просмотр обращений пользователей",
    url: "requests"
  },
  mixins: [withSnackbar, withOverlayLoading],

  directives: {
    mask
  },

  data() {
    return {
      modelmessage: "",
      messageRules: [
        v => !!v || "Текст сообщения не указан",
        v => !!v && v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
      ],
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

    async sendQuery(email) 
    {
      if(this.$refs.form.validate())
      {
        if(await api_feedback.sendEmail({mail: email,text: this.modelmessage,id: this.expanded[0].id}, this))
        {
         // this.items.splice(this.expanded[0]); //!Зачем это действие мне не понят по идеии должно устанавливать отвечено
          this.$refs.form.reset();
        }
      }
      else
        this.showError("Заполните корректно поля!");   
    },

    //Получение обращений пользователя
    async Update() 
    {
      this.showLoading("Обновление данных");
      this.items = await api_feedback.getFeedbackRequests(this); //! Переписать на сторону action vuex
      this.closeLoading("Обновление данных");
    }
  }
};
</script>