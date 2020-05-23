<template lang="pug">
v-content(max-width="816px").ma-0.pa-0
    send-homework-dialog(ref="sendHomeworkDialog")
    v-layout.column.wrap
      v-flex
        v-card(v-if="homework" flat)
            v-tabs(v-model="tabs" centered slider-color="orange darken-1")
                v-tab Задание
                v-tab Прогресс
                v-tab Комментарии
            v-tabs-items(v-model="tabs")
                v-tab-item
                    v-layout.column.wrap
                        v-flex
                            v-card.pa-2.mx-auto(max-width="850px" min-width="300px")
                                v-card-title {{homework.info.title}}
                                v-card-text {{homework.info.text}}
                                v-card-actions(v-if="homework.type != 2")
                                    v-btn(text small color="orange darken-1" @click="sendHomework(null)") Сдать
                        v-flex(v-if="homework.documents")
                            v-card.pa-2.mx-auto(max-width="850px" min-width="300px" v-if="homework.documents.length > 0")
                                v-card-title Материалы
                                v-data-iterator(:items="homework.documents" hide-default-footer no-data-text="")
                                    template(v-slot:default="props")
                                        v-layout.row.wrap
                                            div.pa-3(class="order-1 d-flex flex-wrap justify-start")
                                                div.ma-2(class="order-0 d-flex justify-start" v-for="(file, index) in homework.documents" :key="index")
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
                                                                        v-btn(small @click="download(file)" icon)
                                                                            v-icon(small) mdi-download
                        v-flex
                            v-card.mx-auto(v-if="homework && homework.type == 2" flat max-width="850px" min-width="300px")
                                v-stepper.pb-2.pt-2(v-model="steps_count" vertical)
                                    div(v-for="(item, index, i) in homework.info.date" :key="index")
                                        v-stepper-step(color="orange darken-1"  :step="i + 1" :complete="new Date(index) < new Date().toISOString().substr(0, 10) ? true : false" @click="steps_count = i + 1") {{item.title}} | {{index}}
                                            v-stepper-content.ma-0.pa-0(:step="i + 1") 
                                                v-card-text {{item.text}}
                                                v-card-actions
                                                    v-spacer
                                                    v-btn(small text color="orange darken-1" @click="sendHomework(i + 1)") Сдать
                v-tab-item
                v-tab-item
                    div.pa-3(class="order-1 d-flex flex-wrap justify-center")
                        v-card.pa-4(flat width="850px" min-width="300px")
                            v-card-title.text-truncate Комментарии
                            v-card-actions.pt-0
                                v-btn(x-small text color="orange darken-1" @click="updateComment") обновить
                            v-form(ref="comment")
                                v-list.pa-0(dense nav flat v-if="comments")
                                    v-list-item-group
                                        v-list-item(v-for="(comment, index) in comments" :key="index" disabled)
                                            v-card.pa-2.mx-auto.my-2(width="820px" min-width="300px")
                                                span(style="color: #FB8C00") {{comment.full_fio}}
                                                v-card-text.pa-0 {{comment.comment}}
                                div.pa-3.pt-1(v-else)
                                    v-alert.mx-auto(border="left" elevation="3" type="info" max-width="850px" min-width="300px")
                                        span Тут еще нет комментариев! Хотите стать первым комментатором?
                                v-card-actions.pb-0.pt-3
                                    v-textarea(outlined v-model="myComment" dense label="Текст комментария" :rules="CommentRules" clearable clear-icon="cancel" rows="1")
                                v-card-actions.pt-0
                                    v-spacer
                                    v-btn(small text color="orange darken-1" @click="sendComment") отправить
            p Домашка
            p {{homework}}
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";
import FileDownload from "js-file-download"; //Библиотека для скачивания файлов
import LoadFileDialogHomework_С from "@/js/components/home-work-f/LoadFileDialogHomework";
import SendHomeworkDialog_C from "@/js/components/home-work-f/SendHomeworkDialog";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_homework from "@/js/api/homework";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withSnackbar, withOverlayLoading],
  watch: {
    "$route.params.home_work_id": async function(home_work_id) {
      this.update();
    }
  },

  components: {
    "send-homework-dialog": SendHomeworkDialog_C,
  },

  computed: {
    ...mapGetters(["user"])
  },

  data() {
    return {
      homework: null,
      comments: null,
      tabs: null,
      myComment: null,
      steps_count: 1,
      CommentRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ]
    };
  },

  async beforeMount() {
    this.showLoading("Получение данных");
    await this.update();
    this.closeLoading("Получение данных");
    //let timerId = setInterval(() => this.updateComment(), 10000);
  },

  methods: {
    async update() {
      let id = this.$route.params.home_work_id;
      if (id) {
        let data = await api_homework.getHomeWorkStudentById(
          id,
          this.user.student.group_id,
          this.user.student.id
        );
        this.homework = data;
        this.updateComment();
      }
    },

    async updateComment() {
      let data = await api_homework.getComment(this.$route.params.home_work_id);
      this.comments = data;
    },

    async sendComment() {
      if (this.$refs.comment.validate()) {
        if (
          await api_homework.saveComment({
            comment: this.myComment,
            user_id: this.user.id,
            home_work_id: this.$route.params.home_work_id
          })
        ) {
          this.$refs.comment.reset();
          this.showMessage("Сообщение отправлено");
        } else this.showError("Ошибка отправки");
      } else this.showError("Заполните корректно сообщение");
      this.updateComment();
    },

    async sendHomework(id) {
      let res = await this.$refs.sendHomeworkDialog.pop().then(res => {
        return res;
      });

      if(res)
      {
        res.state = 1;
        res.step = id;
        let documents = res.files;
        delete res.files;

        let homework_student_id = await api_homework.saveHomeworkStudent({association_home_work_id: this.homework.association_home_work_id, student_id: this.user.student.id, info: res});
        if(homework_student_id)
        {
          console.log(homework_student_id);
          this.showMessage("Ваш ответ сохранен!");

          console.log(documents);
          if(documents)
          {
            if(await api_homework.loadHomeworkStudentDocuments(this.$route.params.home_work_id, homework_student_id, this.user.student.id, documents))
              this.showInfo("Файлы загружены!");
            else
              this.showError("Файлы не были загружены!");
          }
        }
        else
          this.showError("Ошибка выполнения!");
        //this.update();
      }
      else
        this.showInfo("Отменено пользователем!");
    },

    getIconWithExtention(file) {
      switch (this.getExt(file)) {
        case ".xlsx": {
          return "mdi-file-excel";
          break;
        }
        case ".xls": {
          return "mdi-microsoft-excel";
          break;
        }
        case ".docx": {
          return "mdi-file-word";
          break;
        }
        case ".doc": {
          return "mdi-microsoft-word";
          break;
        }
        case ".odt": {
          return "mdi-file-code";
          break;
        }
        case ".ppt":
        case ".pptx": {
          return "mdi-file-powerpoint";
          break;
        }
        case ".pdf": {
          return "mdi-file-pdf";
          break;
        }
        case ".txt": {
          return "mdi-file-document";
          break;
        }
        case ".bat": {
          return "mdi-shield-alert";
          break;
        }
        case ".zip":
        case ".7z":
        case ".gz":
        case ".gzip":
        case ".jar":
        case ".rar":
        case ".tar":
        case ".tar-gz":
        case ".tgz":
        case ".zipx": {
          return "mdi-zip-box";
          break;
        }
        default: {
          return "mdi-file-question";
          break;
        }
      }
    },
    getIconColor(file) {
      switch (this.getExt(file)) {
        case ".xlsx":
        case ".xls": {
          return "green";
          break;
        }
        case ".doc":
        case ".docx":
        case ".odt": {
          return "blue accent-4";
          break;
        }
        case ".ppt":
        case ".pptx": {
          return "deep-orange";
          break;
        }
        case ".bat":
        case ".pdf": {
          return "red";
          break;
        }
        case ".txt": {
          return "blue-grey";
          break;
        }
        case ".zip":
        case ".7z":
        case ".gz":
        case ".gzip":
        case ".jar":
        case ".rar":
        case ".tar":
        case ".tar-gz":
        case ".tgz":
        case ".zipx": {
          return "indigo";
          break;
        }
        default: {
          return "grey darken-2";
          break;
        }
      }
    },
    getExt(file) {
      let basename = file.split(/[\\/]/).pop();
      let pos = basename.lastIndexOf(".");
      if (basename === "" || pos < 1) return "";
      return basename.slice(pos);
    },
    getFileName(file) {
      return file.split("\\").pop();
    },
    async download(item) {
      let file = await api_homework.downloadDocument(item.id);
      if (file) FileDownload(file, item.name);
      else this.showError("Ошибка скачивания");
    }
  }
};
</script>