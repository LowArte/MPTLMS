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
        div
          v-toolbar.ma-0.ml-2.mr-2.pa-0(flat='' color='white')
            v-toolbar-title Заказы документации от студентов
            v-spacer
          v-card-title.ma-0.ml-4.mr-4.pa-0
            v-text-field.ma-0.pa-0(v-model='search' label='Поиск' single-line='' hide-details='')
      template(v-slot:expanded-item="{ headers }")
        td(:colspan="headers.length" v-if="expanded.length > 0")
          div
            v-card-text.my-1.ma-0.pa-0.text ФИО: {{expanded[0].fio}}
            v-card-text.my-1.ma-0.pa-0.text(v-for="(info,i) in Object.keys(expanded[0].body)" :key="i") {{info}} : {{expanded[0].body[info]}}</v-card-text>
    v-layout.row.text-center.pa-2.ma-2
      v-pagination(v-model="page" :length="pageCount")
</template>

<script>
export default {
  data() {
    return {
      search: "", //Поиск
      expanded: [],
      singleExpand: true,
      page: 1, //Страница
      pageCount: 0, //Количество страниц
      itemsPerPage: 10, //Количество строк
      headers: [
        { text: "Номер обращения", value: "id" },
        { text: "Тематика", value: "name" },
        { text: "Почта", value: "email" },
        { text: "Дата обращения", value: "date" },
        { text: "", value: "data-table-expand" }
      ], //Заголовок
      items: [
        {
          id: 1,
          name: "asdsadasda",
          email: "asdadas@mail.ru",
          date: new Date().toString(),
          fio: "sdasd asd asdadas",
          body: {
            Школа: "123113",
            Справка: "Нужна справка"
          }
        }
      ]
    };
  },
  props: {
    _requests: {
      data: Object,
      default: null
    } //Заказы справок
  },
  //Получение данных
  mounted() {
    //this.items = this._requests;
  }
};
</script>
