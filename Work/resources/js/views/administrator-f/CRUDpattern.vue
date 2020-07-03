<template lang="pug">
  v-content.ma-0.pa-2
    c-upload-file-dialog(ref="upload_dialog")
    v-layout.row.wrap
      v-card.mx-auto(height='auto' width='100%')
        v-system-bar(color="info" dark)
          span Управление: {{_title}}
        v-data-table.elevation-0.pa-0.ma-0(:headers="_headers" v-if="items" :items="items"  :search="search" item-key="id" no-results-text='Данные отсутствуют' no-data-text='Данные отсутствуют' :page.sync="page" hide-default-footer @page-count="pageCount = $event" :items-per-page="itemsPerPage")
            template(v-slot:top)
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
              v-tooltip(bottom  v-if="_func_upload != null")
                template(v-slot:activator="{ on }")
                  v-btn.ma-2.ml-1(text color="info" v-on="on" @click="upload")
                    v-icon mdi-upload
                    span.ma-2 Загрузить документ
                span Загрузить файл с данными
              v-tooltip(bottom v-if="_func_download != null")
                  template(v-slot:activator="{ on }")
                    v-btn.ma-2.ml-1(text color="success" v-on="on" @click="download")
                      v-icon mdi-download
                      span.ma-2 Выгрузить документ
                  span Скачать файл с данными
              v-text-field.ma-0.pa-3.single-line.hide-details(v-model="search" label="Поиск" dense outlined prepend-inner-icon="search" clearable)
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
              v-tooltip(bottom v-if="_func_reset_password != null")
                template(v-slot:activator="{ on }")
                  v-icon.small(v-on="on" @click="reset_password(item)") mail_outline
                span Отправить письмо на смену пароля
        v-layout.row.text-center.pa-2.ma-2
          v-pagination(v-model="page" :length="pageCount")
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

import UploadFileDialog_C from "@/js/components/expention-f/UploadFileDialog";

import { mapGetters } from "vuex";

export default {
  post_name: {
    name: "CRUD паттер",
    url: "pattern_crud"
  },
  mixins: [withSnackbar],
  data: () => ({
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 30, //Количество отображаемых строк
    pageCount: 0, //Количество страниц
  }),
  props: {
    //?----------------------------------------------
    //!           Данные
    //?----------------------------------------------
    _flood: {
      type: String,
      default: null
    },
    _floodArray: {
      type: Array,
      default: null
    },
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
    _func_init: {
      type: Function,
      default: null
    },
    _func_update: {
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
    _func_reset_password: {
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
  components: {
    "c-upload-file-dialog": UploadFileDialog_C
  },
  computed: {
    items() {
      if(this._floodArray != null)
        return this._floodArray;
      if(this._flood == null)
        return [];
      else
        return this.$store.getters[this._flood];
    }
  },

  async beforeMount() {
    await this.init();
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

    reset_password(item) {
      this._func_reset_password(item);
    },

    async init() {
      await this._func_init();
    },

    async update() {
      await this._func_update();
    },

    async upload() {
      await this.$refs.upload_dialog.pop().then(result => {
        if (result) {
          this._func_upload(result);
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    },

    download() {
      this._func_download();
    }
  }
};
</script>