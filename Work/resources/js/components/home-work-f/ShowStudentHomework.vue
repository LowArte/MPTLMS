<template lang="pug">
    v-dialog(v-model="dialog" persistent fullscreen hide-overlay transition="dialog-bottom-transition")
        v-card(scrollable v-if="homework")
          div(v-if="homework.homework.length > 0")
            v-toolbar(dark color="orange darken-1")
                v-toolbar-title {{homework.fullFio}}
                v-spacer
                v-toolbar-items
                    v-btn(text small dark @click="cancel") назад
            v-layout.column.wrap 
                v-flex(v-for="(work, index) in homework.homework" :key="index")
                    v-card.pa-2.mx-auto.my-2(max-width="920px" outlined)
                      v-card-title.font-weight-light.headline.py-2(style="color: #FB8C00") {{work.date}} {{work.info.step ? '| Этап ' + work.info.step : ''}} ({{ work.info.state == 1 ? 'Рассматривается' : work.info.state == 2 ? 'Отклонено' : work.info.state == 3 ? 'Принято': ''}}) 
                      v-divider
                      v-card-text(v-if="work.info.text") {{work.info.text}}
                      v-layout.column.wrap
                          v-flex(v-if="work.info.links")
                              v-card.pa-2.my-1(min-width="300px" v-if="work.info.links.length > 0" outlined)
                                  v-card-title.font-weight-light.body-1.pb-2 Ссылки
                                  v-card-text.py-1.text-truncate(v-for="(link, index) in work.info.links" :key="index")
                                      a.text-truncate(:href="link") {{link}}
                          v-flex(v-if="work.documents")
                              v-card.pa-2.my-1(min-width="300px" outlined v-if="Object.keys(work.documents).length > 0")
                                  v-card-title.font-weight-light.body-1.pb-2 Файлы
                                  div.pa-3(class="order-1 d-flex flex-wrap justify-start")
                                      div.ma-2(class="order-0 d-flex justify-start" v-for="(file, index) in work.documents" :key="index")
                                          v-card.mx-auto.my-2.pa-0(outlined :elevation="0" width="300px")
                                              v-list.pa-0(dense flat)
                                                  v-list-item-group
                                                      v-list-item
                                                          v-list-item-avatar
                                                              v-icon(:color="getIconColor(file.name)") {{getIconWithExtention(file.name)}}
                                                          v-list-item-content
                                                              v-list-item-title {{getFileName(file.name)}}
                                                              v-list-item-subtitle(v-if="getExt(file.name) == '.bat'") Вредоносный файл
                                                          v-list-item-action
                                                              v-btn(small @click="downloadStudent(file)" icon)
                                                                  v-icon(small) mdi-download
                      v-card-actions
                        v-spacer
                        v-menu(offset-y)
                          template(v-slot:activator="{ on }")
                            v-btn(text color="orange darken-1" v-on="on") {{ work.info.state == 1 ? 'Рассматривается' : work.info.state == 2 ? 'Отклонить' : work.info.state == 3 ? 'Принять': ''}}
                              v-icon mdi-chevron-down
                          v-list
                            v-list-item(@click="work.info.state = 1")
                              v-list-item-title Рассматривается
                            v-list-item(@click="work.info.state = 2")
                              v-list-item-title Отклонить
                            v-list-item(@click="work.info.state = 3")
                              v-list-item-title Принять
                        v-btn(text small @click="save(work)") сохранить
          div(v-else)
            v-toolbar(dark color="orange darken-1")
                v-toolbar-title {{homework.fullFio}}
                v-spacer
                v-toolbar-items
                    v-btn(text small dark @click="cancel") назад
            v-alert.mt-3.mx-auto(border="left" elevation="3" type="warning" max-width="850px" min-width="300px")
              span Тут еще нет сданных заданий! Студент не отправил ни одного задания.
              


</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";
import withSnackbar from "@/js/components/mixins/withSnackbar";
import FileDownload from "js-file-download"; //Библиотека для скачивания файлов

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_homework from "@/js/api/homework";

import FilesHelpres from "@/js/plugins/FilesHelpres"

export default {
    //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withOverlayLoading, withSnackbar, FilesHelpres],
  data() {
    return {
      dialog: false,
      homework: null
    };
  },

  methods: {
    pop(student) {
      this.homework = student;
      this.dialog = !this.dialog;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    async save(item) 
    {
      if(await api_homework.editHomeworkStudent({id: item.id, association_home_work_id: this.homework.association_home_work_id, student_id: this.homework.id, info: item.info})) //Редактирование данных data = {'association_home_work_id', 'student_id', 'info'}
        this.showMessage("Выполнено!");
      else
        this.showError("Ошибка выполнения!");
    },

    cancel() {
      this.resolve(false);
      this.dialog = !this.dialog;
    },

    async downloadStudent(item) {
      let file = await api_homework.downloadStudentDocument(item.id);
      if (file) FileDownload(file, item.name);
      else this.showError("Ошибка скачивания");
    }
  }
};
</script>