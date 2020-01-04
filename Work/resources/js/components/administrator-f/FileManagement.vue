<template lang="pug">
  v-layout.row
    v-hover(v-slot:default='{ hover }')
      v-card.mx-auto.pa-2(width='100%' height='auto' :elevation='hover ? 12 : 2')
        v-data-table.elevation-1.pa-0.ma-0(
          :headers="headers"
          :items="files"
          :search="search"
          item-key="id"
          no-results-text='Нет результатов' 
          no-data-text='Нет результатов'
          :page.sync="page"
          :mobile-breakpoint=200
          hide-default-footer
          @page-count="pageCount = $event"
          :items-per-page="itemsPerPage")
          template(v-slot:top)
            v-toolbar(color="white" flat)
              v-toolbar-title
                v-card-text.my-2.ma-0.pa-0.title Управление файлами
            v-layout.row.pa-0.align-self-center.justify-center(sm="2" md="0")
              v-btn.dark.ma-2(color="primary" @click="initialize()") Обновить
              v-dialog(v-model="dialog" max-width="500px")
                template(v-slot:activator="{ on }")
                  v-btn.ma-2.dark(color="primary" v-on="on") Новый файл
                v-card
                  v-card-title.span.headline {{ formTitle }}
                  v-card-text
                    v-form(ref="SaveDialog")
                      v-layout.row
                        v-text-field(v-model="editedItem.name" label="Название")
                      v-layout.row
                        v-file-input(v-model="editedItem.file" :rules="rulesFile" show-size placeholder="Не более 100 МБ" prepend-icon="mdi-paperclip" label="Новый файл")
                          template(v-slot:selection="{ index, text }")
                            v-chip(v-if="index < 2" color="deep-purple accent-4" dark label small) {{ text }}
                      v-card-actions
                        v-spacer
                        v-btn(color="blue darken-1" text @click="close") Отмена
                        v-btn(color="blue darken-1" text @click="save") Сохранить
            v-card-title.ma-0.ml-4.mr-4.pa-0
              v-text-field.ma-0.pa-0.mt-4.single-line.hide-details(v-model="search" label="Поиск")
          template(v-slot:item.action="{ item }")
            v-icon.small(@click="editItem(item)") edit
            v-icon.small(@click="deleteItem(item)") delete
            v-icon.small(@click="downloadItem(item)") cloud_download
          template(v-slot:no-data)
            v-btn(color="primary" @click="initialize(true)") Обновить
        v-layout.row.text-center.pa-2.ma-2
          v-pagination(v-model="page" :length="pageCount")
          v-text-field(:value="itemsPerPage" label="Количество отображаемых записей" v-mask="mask" @input="itemsPerPage = parseIntLoc($event)")  
</template>

<script>
import apifiles from "../../api/files"; //api для Файлов
import { mask } from "vue-the-mask"; //маски vue
import FileDownload  from "js-file-download"; //Требуется для скачивания файла

export default {
  directives: {
    mask
  },
  data: () => ({
    files: [],
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 10, //Количество отображаемых пользователей
    pageCount: 0, //Количество страниц
    mask: "####", //Маска для количества отображаемых строк
    dialog: false, //Активатор диалога
    rulesFile: [
      v => !!v || "Файл не указан",
      value => !value || value.size < (100*1024*1024) || 'Не более 100 МБ! Текущий размер = ' + value.size + ' байт!',
    ], //Проверка на файл. Минимальный размер 100 МБ значение изменяется в байтах
    headers: [
      {
        text: "№",
        align: "left",
        value: "id"
      },
      { text: "Название", value: "name", },
      { text: "Файл", value: "path" }, //Будет убрано!
      { text: "Действия", value: "action", sortable: false }
    ], //Структура таблицы и с полями которые требуется выводить
    editedIndex: -1, //Текущий индекс редактируемой строки
    editedItem: {
      id: "",
      name: "",
      file: null,
    } //Массив с данным для сохранения в бд
  }),
  props: {
    _files: {
      data: String,
      default: null
    }, //JSON пользователей
  },
  //Получаем данные при старте
  mounted() {
    this.files = JSON.parse(this._files);
  },

  computed: {
    //Получение названия диалога
    formTitle() {
      return this.editedIndex === -1
        ? "Новый файл"
        : "Редактировать файл";
    }
  },

  methods: {
    //Иницилизации данных
    initialize(){
      apifiles
        .getFiles()
        .then(res => {
          this.files = JSON.parse(res.data.files);
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    //Редактирование файла
    editItem(item) 
    {
      this.editedIndex = this.files.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    //Удаление файла
    deleteItem(item) 
    {
      confirm("Вы действительно хотите удалить данный файл?") &&
      apifiles
        .deleteFile({id: item.id})
        .then(res => {
          alert("Удалён!");
          this.initialize();
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    //Загрузка файлов
    downloadItem(item) 
    {
      var name = "files/file.txt";
      apifiles
        .getFile(name)
        .then(res => {
            FileDownload(res.data, name.split("/").pop())
        })
    },
    //Закрытие диалога
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, {
          id: "",
          name: "",
          file: null,
        });
        this.editedIndex = -1;
      }, 300);
    },
    //Сохранение файла
    save() {
      if (this.editedIndex == -1) this.editedItem.id = -1;
      if (this.$refs.SaveDialog.validate())
      apifiles
        .saveFile({
          file: this.editedItem
        })
        .then(res => {
          switch(res.data.success) //Проверяем результат отправки запроса
          {
            case 'errorname':
              alert("Имя уже используется!");
              break;
            case true:
              this.initialize();
              alert("Сохранён!");
              this.close();
              break;
          }   
        })
        .catch(ex => {
          alert("Сохранение не было произведено!");
          console.log(ex);
        });
    },
    //Требуется для определения количества страниц
    parseIntLoc(val) {
      if (val == "" || val == null || val == "0")
        return 1;
      return parseInt(val);
    }
  }
};
</script>