<template lang="pug">
    v-layout.row.wrap
      v-card.mx-auto.pa-3(height='auto' width='100%')
        c-comfirm-dialog(ref='qwestion')
        v-data-table.elevation-0.pa-0.ma-0(:headers="headers" :items="flood" :search="search" item-key="id" no-results-text='Данные отсутствуют' no-data-text='Данные отсутствуют' :page.sync="page" hide-default-footer @page-count="pageCount = $event" :items-per-page="itemsPerPage")
            template(v-slot:top)
                v-card-title.my-2.ma-0.py-2.text-truncate CRUD {{title}}
                v-tooltip(bottom)
                    template(v-slot:activator="{ on }")
                        v-btn.ma-2.ml-1(text v-on="on" @click="add")
                            v-icon add
                            span.ma-2 Добавить запись
                    span Новая запись
                v-tooltip(bottom)
                    template(v-slot:activator="{ on }")
                        v-btn.ma-2.ml-1(text color="red" v-on="on" @click="clear")
                            v-icon mdi-delete
                            span.ma-2 Удалить все записи
                    span Удалить все
                v-tooltip(bottom)
                    template(v-slot:activator="{ on }")
                        v-btn.ma-2.ml-1(text color="info" v-on="on" @click="upload")
                            v-icon mdi-upload
                            span.ma-2 Загрузить документ
                    span Загрузить файл с данными
                v-tooltip(bottom)
                    template(v-slot:activator="{ on }")
                        v-btn.ma-2.ml-1(text color="success" v-on="on" @click="download")
                            v-icon mdi-download
                            span.ma-2 Выгрузить документ
                    span Скачать файл с данными
                v-text-field.ma-0.pa-0.mt-4.single-line.hide-details(v-model="search" label="Поиск")
            template(v-slot:item.action="{ item }")
                v-tooltip(bottom)
                    template(v-slot:activator="{ on }" @click="edit(item)")
                        v-icon.small(v-on="on") edit
                    span Редактировать
                v-tooltip(bottom)
                    template(v-slot:activator="{ on }")
                        v-icon.small(v-on="on") mdi-delete
                    span Удалить
        v-layout.row.text-center.pa-2.ma-2
            v-pagination(v-model="page" :length="pageCount")
</template>

<script>
import AddDialog_C from "./components/AddDialogs/C_Department_Add"; //*Диалог add
import EditDialog_C from "./components/EditDialogs/C_Department_Edit"; //*Диалог edit
import ConfirmDialog_C from "./../expention-f/ConfirmDialog"; //*Диалог валидации
import withSnackbar from "../mixins/withSnackbar"; //*Оповещения

export default {
  data: () => ({
    title: "", //Заголовок страницы
    flood: [], //Массив данных
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 30, //Количество отображаемых строк
    pageCount: 0, //Количество страниц
    headers: [], //Структура таблицы и с полями которые требуется выводить
    index: Object
  }),

  mixins: [withSnackbar],

  components: 
  {
    "c-comfirm-dialog": ConfirmDialog_C,
    "c-add-dialog": AddDialog_C,
    "c-edit-dialog": EditDialog_C
  },

  props: {
    _flood: {
      type: Array,
      default: null
    }, //! Табличные данные
    _headers: {
      type: Array,
      default: null
    }, //! Данные заголовков
    _title: {
      type: String,
      default: " - Нет данных заголовка"
    }, //! Данные заголовка CRUD страницы
    _func_add: {
      type: Function,
      default: null
    },
    _slug: {
      type: String,
      default: ""
    } //Модуль
  },

  mounted() {
    this.flood = this._flood;
    this.headers = this._headers;
    this.title = this._title;
  },

  methods: 
  {
    add() 
    {
      this._func_add('пидор');
    },

    edit(item) 
    {

    },

    clear() 
    {

    },

    upload() 
    {
      this.showMessage("Данная функция будет не доступна до релизной версии");
    },

    download() 
    {
      this.showMessage("Данная функция будет не доступна до релизной версии");
    }
  }
};
</script>