<template lang="pug">
    v-layout.row.wrap
      v-card.mx-auto.pa-3(height='auto' width='100%')
        v-data-table.elevation-0.pa-0.ma-0(:headers="headers" v-if="flood" :items="flood" :search="search" item-key="id" no-results-text='Данные отсутствуют' no-data-text='Данные отсутствуют' :page.sync="page" hide-default-footer @page-count="pageCount = $event" :items-per-page="itemsPerPage")
            template(v-slot:top)
                v-card-title.my-2.ma-0.py-2.text-truncate Менеджмент {{title}}
                v-tooltip(bottom v-if="_func_add != null")
                    template(v-slot:activator="{ on }")
                        v-btn.ma-2.ml-1(text v-on="on" @click="add")
                            v-icon add
                            span.ma-2 Добавить запись
                    span Новая запись
                v-tooltip(bottom)
                  template(v-slot:activator="{ on }")
                      v-btn.ma-2.ml-1(text v-on="on" @click="update")
                          v-icon replay
                          span.ma-2 Обновить
                  span Обновить таблицу
                v-tooltip(bottom v-if="_func_clear != null")
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
            //-Обозначение блокировки пользователя
            template(v-slot:item.disabled="{ item }") 
              v-tooltip(bottom v-if="item['disabled'] == 1")
                  template(v-slot:activator="{ on }")
                    v-btn.ma-2.ml-1(text v-on="on")
                      v-icon done
                  span Заблокирован
              v-tooltip(bottom v-if="item['disabled'] == 0")
                  template(v-slot:activator="{ on }")
                    v-btn.ma-2.ml-1(text v-on="on")
                      v-icon close
                  span Не заблокирован                  
            template(v-slot:item.action="{ item }")
                v-tooltip(bottom v-if="_func_edit != null")
                    template(v-slot:activator="{ on }")
                        v-icon.small(v-on="on" @click="edit(item)") edit
                    span Редактировать
                v-tooltip(bottom v-if="_func_remove != null")
                    template(v-slot:activator="{ on }")
                        v-icon.small(v-on="on" @click="remove(item)") mdi-delete
                    span Удалить
        v-layout.row.text-center.pa-2.ma-2
            v-pagination(v-model="page" :length="pageCount")
</template>

<script>
export default {
  data: () => ({
    title: "", //Заголовок страницы
    flood: null, //Массив данных
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 30, //Количество отображаемых строк
    pageCount: 0, //Количество страниц
    headers: [] //Структура таблицы и с полями которые требуется выводить
  }),
  props: {
    //?----------------------------------------------
    //!           Данные
    //?----------------------------------------------
    _headers: {
      type: Array,
      default: null
    }, //! Данные заголовков
    _title: {
      type: String,
      default: " - Нет данных заголовка"
    }, //! Данные заголовка CRUD страницы
    //?----------------------------------------------
    //!           Функциональная часть
    //?----------------------------------------------
    _func_add: {
      type: Function,
      default: null
    },
    _func_update: {
      type: Function,
      default: null
    },
    _func_clear: {
      type: Function,
      default: null
    },
    _func_edit: {
      type: Function,
      default: null
    },
    _func_remove: {
      type: Function,
      default: null
    },
    _func_upload: {
      type: Function,
      default: null
    },
    _func_download: {
      type: Function,
      default: null
    }
  },
  mounted(){
    this.headers = this._headers;
    this.title = this._title;
  },

  async beforeMount() {
    await this.update();
    console.log("MOUNTED")
  },

  methods: {
    add() {
      this._func_add();
    },

    edit(item) {
      this._func_edit(item);
    },

    clear() {
      this._func_clear();
    },

    remove(item) {
      this._func_remove(item);
    },

    async update() {
      this.flood = await this._func_update();
      console.log("UPDATE")
    },

    upload() {
      this.showInfo("Данная функция будет не доступна до релизной версии!");
    },

    download() {
      this.showInfo("Данная функция будет не доступна до релизной версии!");
    }
  }
};
</script>