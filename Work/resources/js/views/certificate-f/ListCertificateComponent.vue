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
          v-card-text.my-1.ma-0.pa-0(v-if="expanded[0].fio != null") ФИО: {{expanded[0].fio}}
          v-card-text.my-1.ma-0.pa-0(v-for="(info,i) in Object.keys(expanded[0].certificates_data)" :key="i") {{info}} : {{expanded[0].certificates_data[info]}}
          v-card-text.my-1.ma-0.pa-0(v-if="expanded[0].text != null") Текст: {{expanded[0].text}}
          v-form.mt-3(ref="sendNotDone")
            v-dialog(v-model="dialog" persistent max-width="500px")
              template(v-slot:activator="{ on }")
                v-card-actions              
                  v-spacer
                  v-btn.ma-1.white--text(color='accent' depressed v-on="on") Отказать
                  v-btn.ma-1.white--text(color='blue' depressed @click='sendEmailDone(expanded[0].email)') Выполнить
              v-card
                v-card-title.headline.grey.lighten-2.primary-title Введите причину отказа
                v-textarea.ma-2.pt-5(v-model='modelmessage' :auto-grow='true' :clearable='false' :counter='255 ? 255 : false' :filled='false' :flat='true' :hint="'Не более 255 символов'" :label="'Сообщение'" :loading='false' :no-resize='false' :outlined='false' :persistent-hint='false' :placeholder="''" :rounded='false' :row-height='24' :rows='3' :shaped='false' :single-line='false' :solo='false' :rules='messageRules')
                v-divider
                v-card-actions
                  v-btn(color="primary" text @click="dialog = false; modelmessage = ''") Отмена
                  v-spacer
                  v-btn(color="primary" text @click="sendEmailNotDone()") Отправить отказ     
    v-layout.row.text-center.pa-2.ma-2
      v-pagination(v-model="page" :length="pageCount")
</template>

<script>
import api_cerificate from "@/js/api/certificate";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //*Оповещения
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

export default {
  post_name: {
    name: "Заказанные справки",
    url: "list_certificate"
  },
  mixins: [withSnackbar, withOverlayLoading],
  data() {
    return {
      search: "", //Поиск
      expanded: [],
      singleExpand: true,
      dialog: false,
      page: 1, //Страница
      pageCount: 0, //Количество страниц
      itemsPerPage: 10, //Количество строк
      headers: [
        { text: "Тематика", value: "type" },
        { text: "Почта", value: "user.email" },
        { text: "Дата обращения", value: "created_at" },
        { text: "Выполнено", value: "done" },
        { text: "", value: "data-table-expand" }
      ], //Заголовок
      modelmessage: "",
      messageRules: [
        v => !!v || "Текст сообщения не указан",
        v => !!v && v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
      ],
      items: []
    };
  },

  //Преднастройка
  beforeMount() {
    this.Update();
  },

  methods: {
    //Отправка отказа канцелярии с ответом почему справка не выполнена
    async sendEmailNotDone(email) 
    {
      if(this.$refs.sendNotDone.validate())
      {
        if (await api_cerificate.sendEmailNotDone({ email: email, text: this.modelmessage, id: this.expanded[0].id }, this)) //! Такого даже нет
        {
          this.items.splice(this.expanded[0]);
          this.dialog = false;
          this.$refs.sendNotDone.reset();
        }
      }
      else
        this.showError("Заполните корректно ответ!");
    },

    //Отправка сообщения о том, что справка готова
    async sendEmailDone(email) 
    {
      if (
        await api_cerificate.sendEmailDone(
          { email: email, id: this.expanded[0].id },
          this
        )
      ) {
        this.expanded[0].done = true;
        this.Update();
      }
    },

    //Отправка сообщения о том, что справка готова
    async Update() 
    {
      this.showLoading("Обновление данных");
      this.items = await api_cerificate.getCertificates(this); //! перевести в action vuex
      // if (this.items != null) 
      // {
      //   for (var i = 0; i < this.items.length; i++)
      //     this.items[i].certificates_data = JSON.parse(  //! бесполезный код
      //       this.items[i].certificates_data
      //     );
      // }
      this.closeLoading("Обновление данных");
    }
  }
};
</script>