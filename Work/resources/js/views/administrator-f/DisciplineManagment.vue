<template lang="pug">
    v-content.ma-0.pa-2
        c-upload-file-dialog(ref="upload_dialog")
        v-layout.row.wrap 
            v-flex
              v-card.mx-auto
                v-system-bar(color="info" dark)
                  span Менеджмент дисциплин
                v-data-table.elevation-0.pa-0.ma-0(:headers="headers" :items="items" item-key="id" no-results-text='Данные отсутствуют' no-data-text='Данные отсутствуют' :page.sync="page" @page-count="pageCount = $event" hide-default-footer :items-per-page="itemsPerPage")
                  template(v-slot:top)
                    v-tooltip(bottom)
                      template(v-slot:activator="{ on }")
                          v-btn.ma-2.ml-1(text v-on="on" @click="Update")
                              v-icon replay
                              span.ma-2 Обновить
                      span Обновить таблицу
                    v-tooltip(bottom)
                      template(v-slot:activator="{ on }")
                          v-btn.ma-2.ml-1(text color="info" v-on="on" @click="LoadFile")
                              v-icon mdi-upload
                              span.ma-2 Загрузить документ
                      span Загрузить файл с данными
                  template(v-slot:item.action="{ item }")
                    v-tooltip(bottom)
                      template(v-slot:activator="{ on }")
                        router-link(class='nounderline' replace :to="'disciplines_crud/'+item.db_name")
                          v-icon.small edit
                      span Просмотреть
              v-layout.row.text-center.pa-2.ma-2
                v-pagination(v-model="page" :length="pageCount")
</template>

<script>
//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";

//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import CRUD_Discipline from "@/js/views/administrator-f/CRUD/CRUDDiscipline";
import api_discipline from "@/js/api/discipline";

import UploadFileDialog_C from "@/js/components/expention-f/UploadFileDialog";

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение дополнительных компонентов
  mixins: [withSnackbar, withOverlayLoading],

  post_name: {
    name: "Менеджер дисциплин",
    url: "discipline_managment",
    dop_com:[
        {
            url:"disciplines_crud/:dbName",
            path:"@/js/views/administrator-f/CRUD/CRUDDiscipline"
        }
    ]
  },

  components: {
    "c-upload-file-dialog": UploadFileDialog_C,
    "c-crud-discipline": CRUD_Discipline
  },
  data() {
    return {
      headers: [
        { text: "Наименование", value: "db_name" },
        { text: "Год", value: "created_at" },
        { text: "Действия", value: "action", sortable: false }
      ],
      items: [],
      page: 1, //Текущая страница
      itemsPerPage: 30, //Количество отображаемых строк
      pageCount: 0, //Количество страниц
      showCRUD: false,
      db_name: ""
    };
  },
  async beforeMount() {
    await this.Update();
  },

  methods: {
    async Update() {
      this.showLoading("Обновление данных");
      await this.loadData();
      this.closeLoading("Обновление данных");
    },

    async loadData() {
      let items = await api_discipline.getDisciplinesDB();
      this.items = items;
    },

    async LoadFile() {
      this.showLoading("Загрузка и обработка файлов");
      var res = await this.$refs.upload_dialog.pop().then(res => {
        return res;
      });

      if (res) {
        if (await api_discipline.loadDiscipline(res)) {
          this.showMessage("Файл загружен!");
          await this.loadData();
          this.showInfo("Завершено!");
        } else this.showError("Произошла ошибка при загрузке!");
      } else this.showInfo("Действие отменено пользователем!");
      this.closeLoading("Загрузка и обработка файлов");
    }
  }
};
</script>