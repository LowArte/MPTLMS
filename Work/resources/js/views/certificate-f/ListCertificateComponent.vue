<template lang="pug">
  v-card.mx-auto.pa-2(width='100%' height='auto' outline)
    v-data-table(
          :headers="headers"
          :items="items"
          :single-expand="true"
          :expanded.sync="expanded"
          item-key="id"
          show-expand
          class="elevation-1"
          no-results-text='Нет результатов' 
          no-data-text='Нет результатов'
          :page.sync="page"
          hide-default-footer
          @page-count="pageCount = $event"
          :search="search"
          :items-per-page="itemsPerPage"
    )
      template(v-slot:top='')
        v-card-title.my-2.ma-0.py-2.text-truncate Заказы документации от студентов
        v-tooltip(bottom)
          template(v-slot:activator="{ on }")
              v-btn.ma-2.ml-1(text v-on="on" @click="Update()")
                  v-icon replay
                  span.ma-2 Обновить
          span Обновить таблицу
        v-card-title.ma-0.ml-4.mr-4.pa-0
          v-text-field.ma-0.pa-0(v-model='search' label='Поиск' single-line='' hide-details='')
      template(v-slot:item.done="{ item }")
        v-icon.small(v-if="item['done']") check
        v-icon.small(v-else) close
      template(v-slot:expanded-item="{ headers }")
        td(:colspan="headers.length" v-if="expanded.length > 0")
          v-card-text.my-1.ma-0.pa-0.text(v-if="expanded[0].fio != null") ФИО: {{expanded[0].fio}}
          v-card-text.my-1.ma-0.pa-0.text(v-for="(info,i) in Object.keys(expanded[0].certificates_data)" :key="i") {{info}} : {{expanded[0].certificates_data[info]}}
          v-card-text.my-1.ma-0.pa-0.text(v-if="expanded[0].text != null") Текст: {{expanded[0].text}}
            v-form.ma-2.pt-2(v-model='modelmessage' :auto-grow='true' :clearable='false' :counter='255 ? 255 : false' :filled='false' :flat='true' :hint="'Не более 255 символов'" :label="'Сообщение'" :loading='false' :no-resize='false' :outlined='false' :persistent-hint='false' :placeholder="''" :rounded='false' :row-height='24' :rows='3' :shaped='false' :single-line='false' :solo='false' :rules='messageRules')
            v-btn.ma-1.white--text(:disabled='!form' color='blue' depressed @click='sendEmailAnswer(expanded[0].email)') Ответить
            v-btn.ma-1.white--text(color='blue' depressed @click='sendEmailDone(expanded[0].email)') Выполнено
    v-layout.row.text-center.pa-2.ma-2
      v-pagination(v-model="page" :length="pageCount")
</template>

<script>
import cerificateApi from "@/js/api/certificate";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения

export default {
  post_name: {
    name: "Просмотр сертивикатов",
    url: "list_certificate"
  },
  mixins: [withSnackbar],
  data() {
    return {
      search: "", //Поиск
      expanded: [],
      singleExpand: true,
      page: 1, //Страница
      pageCount: 0, //Количество страниц
      itemsPerPage: 10, //Количество строк
      headers: [
        { text: "Тематика", value: "type" },
        { text: "Почта", value: "email" },
        { text: "Дата обращения", value: "created_at" },
        { text: "Выполнено", value: "done" },
        { text: "", value: "data-table-expand" }
      ], //Заголовок
      modelmessage: "",
      messageRules: [
        v => v.length > 0 || "Текст сообщения не указан",
        v =>
          v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
      ],
      form: false,
      items: []
    };
  },

  props: {
    _requests: {
      data: Object,
      default: null
    }
  },

  //Получение данных
  mounted() {
    this.items = this._requests;
    for (var i = 0; i < this.items.length; i++)
      this.items[i].certificates_data = JSON.parse(
        this.items[i].certificates_data
      );
  },

  methods: {
    //Отправка сообщения-ответа от канцелярии, без фиксации того что справка выполнена
    sendEmailAnswer(email) {
      cerificateApi
        .sendEmailAnswer({
          email: email,
          text: this.modelmessage,
          id: this.expanded[0].id
        })
        .then(result => {
          this.showMessage("Сообщение отправлено");
          this.items.splice(this.expanded[0]);
        })
        .catch(ex => {
          this.showError("Произошла ошибка! " + ex);
        });
      this.modelmessage = "";
    },

    //Отправка сообщения о том, что справка готова
    sendEmailDone(email) {
      cerificateApi
        .sendEmailDone({
          email: email,
          id: this.expanded[0].id
        })
        .then(result => {
          this.showMessage("Сообщение отправлено");
          this.expanded[0].done = true;
          this.Update();
        })
        .catch(ex => {
          this.showError("Произошла ошибка! " + ex);
        });
      this.modelmessage = "";
    },

    //Отправка сообщения о том, что справка готова
    Update() {
      cerificateApi
        .getCertificates()
        .then(res => {
          this.items = res.data.certificates;
          for (var i = 0; i < this.items.length; i++)
            this.items[i].certificates_data = JSON.parse(
              this.items[i].certificates_data
            );
        })
        .catch(ex => {
          this.showError("Произошла ошибка! " + ex);
        });
    }
  }
};
</script>