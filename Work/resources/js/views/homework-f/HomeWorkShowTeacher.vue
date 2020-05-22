<template lang="pug">
  v-content(max-width="816px").ma-0.pa-0
    c-comfirm-dialog(ref="qwestion")
    c-load-file-dialog-homework(ref="load_file_dialog")
    v-layout.column.wrap
      v-flex
        v-card(v-if="homework" flat)
          v-tabs(v-model="tabs" centered slider-color="orange darken-1")
            v-tab Задание
            v-tab Прогресс
            v-tab Доступ
            v-tab Журналы
            v-tab Комментарии
          v-tabs-items(v-model="tabs")
            v-tab-item
              v-form(ref="form")
                div.pa-3(class="order-1 d-flex flex-wrap justify-center")
                  div.ma-2(class="d-flex justify-end")
                    div
                      v-card(max-width="420" min-width="300")
                        v-card-title Инструменты
                        v-card-text Тут отображаются доступные вам инструменты для работы с данным ресурсом
                        v-card-actions
                          v-btn(small text color="orange darken-1" @click="deleteHomework()") Удалить задание
                          v-spacer
                          v-btn(icon small color="green" @click="loadFile()")
                            v-icon mdi-file-upload
                          v-btn(icon small :color="!editable ? 'red' : 'grey darken-1'" @click="edit()")
                            v-icon edit
                  div.ma-2(class="order-0 d-flex justify-start")
                    v-card.pa-2(v-if="!editable" width="420" min-width="300")
                      v-text-field(outlined dense v-model="homework.info.title" label="Заголовок" :rules="TitleRules")
                      v-textarea.mt-3(outlined v-model="homework.info.text" :rules="TextRules" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Сопроводительные текст" :row-height="18" :rows="3")
                      v-text-field(v-if="homework.type == 3" outlined dense v-model="homework.info.time" label="Время проведения" :rules="TitleRules")
                      v-autocomplete(v-if="homework.type == 3" outlined dense v-model="homework.info.place_id" label="Место проведения" :items="places" no-data-text="Нет данных" item-value='id' item-text='place_name')
                      v-text-field(v-if="homework.type == 3" outlined dense v-model="homework.info.classroom" label="Кабинет")
                    v-card(v-else width="420" min-width="300")
                      v-card-title.py-0 {{homework.info.title}}
                      v-card-text.py-1 {{homework.info.text}}
                      v-card-text.py-1(v-if="homework.type == 3") Время: {{homework.info.time}}
                      v-card-text.py-1(v-if="homework.type == 3") Место: {{homework.info.place_name}}
                      v-card-text.py-1(v-if="homework.type == 3") Время: {{homework.info.time}}
                      v-card-text.py-1(v-if="homework.type == 3") Кабинет: {{homework.info.classroom}}
                      v-card-text.py-1 Создано: {{homework.date}}
                v-layout.row.wrap
                  v-flex
                    v-layout.column.wrap
                      v-card.pa-2.mx-auto(max-width="850px" min-width="300px")
                        v-card-title Прикреплённые материалы
                        v-data-iterator(:items="homework.documents" hide-default-footer no-data-text="")
                          template(v-slot:default="props")
                            v-layout.row.wrap(v-if="homework.documents")
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
                                            v-btn(small @click="deleteFileInQwee(file)" icon)
                                              v-icon(small) close
                                            v-btn(small @click="download(file)" icon)
                                              v-icon(small) mdi-download
                v-layout.row.wrap(v-if="homework && homework.type == 2")
                  v-flex
                    v-card.mx-auto.pa-1(flat max-width="850px" min-width="300px")
                      v-stepper.pb-2.pt-2(v-model="steps_count" vertical)
                        span.pa-3.mt-2(v-if="!editable" style="color: red") Внимание: Активен режим редактирования
                        div(v-for="(item, index, i) in homework.info.date" :key="index")
                          v-stepper-step(color="orange darken-1"  :step="i + 1" :complete="new Date(index) < new Date().toISOString().substr(0, 10) ? true : false" @click="steps_count = i + 1") {{item.title}} | {{index}}
                          v-stepper-content(:step="i + 1") 
                            v-textarea.mt-3(:disabled="editable" outlined v-model="item.text" :rules="InsideTextRules" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Задание этапа" :row-height="24" :rows="3")
                        v-card-actions(v-if="!editable")
                          v-btn(small text color="success" @click="editHomework()") Сохранить изменения
            v-tab-item.pt-2
              v-card.mx-auto(flat max-width="850px" min-width="300px")
                v-expansion-panels.pa-0            
                  v-expansion-panel.pa-0(v-for="(item, index) in homework.association_homework" :key="index")
                    v-expansion-panel-header.px-2.py-0 Группа: {{item.group_name}}             
                    v-expansion-panel-content.px-0.mx-0(v-if="item.home_work_access.length > 0") {{item.home_work_access}}
                    v-expansion-panel-content.px-0.mx-0(v-else) Студенты еще не загрузили свои работы
            v-tab-item.pt-2
              div 
                v-layout.row.wrap
                  v-flex
                    v-card.mx-auto.pa-2(max-width="850px" min-width="300px")
                      v-form(ref="access")
                        v-card-title Инструменты 
                        v-autocomplete(outlined dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-value="id" item-text="dep_name_full" :items="specialities" v-model="selected_department_id" :rules="DepartmentRules")
                        v-autocomplete(v-if="homework.type != 3" :disabled="selected_department_id ? false : true" v-model="homework_groups" :label="'Группы (' + homework_groups.length + ')'" :items="groups" outlined dense no-data-text="Нет данных" item-value='id' small-chips chips multiple item-text='group_name' clearable :rules="[GroupsRules.required]")
                        v-autocomplete(v-if="homework.type == 3" :disabled="selected_department_id ? false : true" v-model="homework_groups[0]" label="Группа" :items="groups" outlined dense no-data-text="Нет данных" item-value='id' item-text='group_name' clearable :rules="GroupRules")
                        v-autocomplete(:disabled="loading" v-model="coauthors" label="Соавторы" outlined dense :items="getTeacher" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple clearable)
                        v-card-actions
                          v-spacer
                          v-btn(small text color="success" @click="accessSave()") Сохранить
                div.pa-3(v-if="homework.association_user_homework" class="order-1 d-flex flex-wrap justify-center")
                  div.ma-2(class="d-flex justify-start")
                    div
                      v-card(max-width="420px" min-width="300px" v-if="homework.association_user_homework.length > 0")
                        v-card-title Соавторы
                        v-list.pa-0(dense disabled flat)
                          v-list-item-group
                            v-list-item(v-for="(item, index) in homework.association_user_homework" :key="index")
                              v-list-item-content
                                v-list-item-title {{item.full_fio}}
                  div.ma-2(v-if="homework.association_homework" class="order-0 d-flex justify-start")
                    div
                      v-card(max-width="420px" min-width="300px" v-if="homework.association_homework.length > 0")
                        v-card-title Группы
                        v-list.pa-0(dense disabled flat)
                          v-list-item-group
                            v-list-item(v-for="(item, index) in homework.association_homework" :key="index")
                              v-list-item-content
                                v-list-item-title {{item.group_name}}
            v-tab-item
                div(v-if="homework.journals.length > 0")
                  v-flex.pa-3.mt-2
                    v-card.mx-auto(max-width="850px" min-width="300px")
                      v-card-text Доступные журналы
                  v-flex.pa-3.pt-1(v-for="(item, index) in homework.journals" :key="index")
                    v-alert.mx-auto.py-0.pt-1.pr-1(border="left" elevation="3" colored-border :color="item.isClose == null ? 'red' : item.isClose == 0 ? 'success' : 'yellow accent-4'"  max-width="850px" min-width="300px")
                      v-system-bar.pl-0(color="white")
                        v-tooltip(bottom)
                          template(v-slot:activator="{ on }")
                            v-icon(small v-on="on") {{item.isClose == null ?  'mdi-lock' : 'mdi-clock'}}
                          span {{item.isClose == null ?  'Журнал закрыт' : 'Журнал доступен'}} 
                      v-row(align="center")
                        v-col(class="grow")
                          span {{item.discipline}}
                          br
                          small {{item.group_name}}
                        v-col(class="shrink")
                            v-btn(small text color="success" @click="goJournal(item.id)" :disabled="item.isClose == null") открыть
                v-flex.pa-3.pt-1(v-else)
                  v-alert.mx-auto(border="left" elevation="3" type="warning"  max-width="850px" min-width="300px")
                    span Для вас нет ни одного журнала. Возможно УМО не создал их для вас.
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
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";
import FileDownload from "js-file-download"; //Библиотека для скачивания файлов
import { mask } from "vue-the-mask"; //Маска
import LoadFileDialogHomework_С from "@/js/components/home-work-f/LoadFileDialogHomework";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_homework from "@/js/api/homework";
import api_department from "@/js/api/department"; //Отделения
import api_teacher from "@/js/api/teacher"; //Преподователи
import api_place from "@/js/api/place"; //Api мест проведения

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
  post_name: {
    name: "Домашнее задание",
    url: "homework/:home_work_id"
  },

  components: {
    "c-comfirm-dialog": confirmDialog_C,
    "c-load-file-dialog-homework": LoadFileDialogHomework_С
  },

  watch: {
    "$route.params.home_work_id": async function(home_work_id) {
      this.update();
    }
  },

  computed: {
    ...mapGetters(["user", "specialities", "groups_combo", "teachers_combo", "places"]),
    getTeacher() {
      if (!this.teachers_combo) return undefined;
      let teacher = this.teachers_combo.filter(res => {
        if (res.id == this.user.id) return false;
        return true;
      });
      return teacher;
    }
  },

  async beforeMount() {
    this.showLoading("Получение данных");
    await this.update();

    //Получение отделений
    let items = await api_department.getDepartments();
    await this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);
    if (this.specialities) {
      this.selected_department_id = this.specialities[0].id;
      this.department_change();
    }
    //Получение групп
    if (this.specialities) {
      if (this.specialities.length > 0) {
        await this.$store.dispatch(actions.ADD_CACHE_GROUP_DATA, {
          context: this,
          result: this.specialities[0].id
        });
      }
    }

    //Получение мест проведения
    if(this.places == null)
    {
        let places = await api_place.getPlaces();
        this.$store.commit(mutations.SET_PLACES_FULL, places)
    }

    //Получение преподавателей
    if (this.teachers_combo == null) {
      let items = await api_teacher.getTeachers();
      this.$store.commit(mutations.SET_TEACHERS_COMBO, items);
    }
    this.closeLoading("Получение данных");

    let timerId = setInterval(() => this.updateComment(), 10000);
  },

  data() {
    return {
      tabs: null,
      homework: null,
      loading: false,
      selected_department_id: null,
      editable: true,
      coauthors: [],
      comments: null,
      myComment: null,
      groups: null,
      homework_groups: [],
      types: ["Новость", "Домашнее задание", "Поэтапное задание", "Экзамен"],
      steps_count: 1,
      InsideTextRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      DepartmentRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      GroupsRules: {
        required: value => {
          return !!value.length || "Данное поле не должно оставаться пустым";
        }
      },
      GroupRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      TitleRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      TextRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      CommentRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ]
    };
  },

  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async goJournal(id) {
      this.$router.push("/" + this.user.post.slug + "/group_journal/" + id);
    },
    //Обновление данных
    async update() {
      let id = this.$route.params.home_work_id;
      if (id) {
        let data = await api_homework.getHomeWorkTeacherById(id, this.user.id);
        this.homework = data;
        if (this.homework) 
        {
          this.coauthors = [];
          await this.homework.association_user_homework.forEach(coauthor => {
            this.coauthors.push(coauthor.user_id);
          });

          this.homework_groups = [];
          await this.homework.association_homework.forEach(group => {
            this.homework_groups.push(group.group_id);
          });
          this.$forceUpdate();
        }
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
    //Удаления задания
    async deleteHomework() {
      let res = await this.$refs.qwestion.pop().then(res => {
        return res;
      });
      if (res) {
        if (
          await api_homework.deleteHomeWork(this.$route.params.home_work_id)
        ) {
          this.showMessage("Задание удалено");
          this.$router.push("/" + this.user.post.slug + "/homework_teacher");
        } else this.showError("Произошла ошибка");
      } else this.showInfo("Действие было отменено пользователем");
    },
    //Нажатие на кнопку редактирования
    edit() {
      this.editable = !this.editable;
      if (this.editable) this.editHomework();
    },
    //Редактирование основного задания
    async editHomework() {
      if (this.$refs.form.validate()) {
        if (await api_homework.editHomeWork(this.homework)) {
          this.editable = true;
          this.showMessage("Изменения сохранены");
          this.update();
        } else {
          this.editable = false;
          this.showError("Произошла ошибка");
        }
      } else {
        this.editable = false;
        this.showError("Укажите корректно поля");
      }
    },
    //Сохранение доступа
    async accessSave() {
      if (this.$refs.access.validate()) {
        if(this.homework.type == 3 && this.homework_groups.length > 0)
        {
          let group = this.homework_groups[0];
          this.homework_groups = [];
          this.homework_groups.push(group);
        }

        if (
          await api_homework.editAccess({
            groups: this.homework_groups,
            users: this.coauthors,
            home_work_id: this.$route.params.home_work_id
          })
        ) {
          this.showMessage("Изменения сохранены");
          this.update();
        } else this.showError("Произошла ошибка");
      } else this.showError("Укажите корректно поля");
    },

    //?----------------------------------------------
    //!           Работа с дополнительными данными
    //?----------------------------------------------
    async department_change() {
      this.loading = true;
      this.showLoading("Получение групп");
      await this.$store.dispatch(actions.ADD_CACHE_GROUP_DATA, {
        context: this,
        result: this.selected_department_id
      });
      this.closeLoading("Получение групп");
      this.groups = this.groups_combo;
      this.loading = false;
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
    //Скачивание документа
    async download(item) {
      let file = await api_homework.downloadDocument(item.id);
      if (file) FileDownload(file, item.name);
      else this.showError("Ошибка скачивания");
    },

    async deleteFileInQwee(item) {
      if (await api_homework.deleteDocument(item.id)) {
        this.showMessage("Файл удалён");
        this.update();
      } else this.showError("Произошла ошибка");
    },

    async loadFile() {
      let res = await this.$refs.load_file_dialog.pop().then(res => { return res; });
      if (res) {
        {
          if(res.main)
          {
            if(await api_homework.loadDocuments({documents: res.main, homework_id: this.$route.params.home_work_id}))
              this.showMessage("Файл(ы) загружены успешно!");
            else
              this.showError("Файл(ы) не загружен(ы)!");
          }
        }
        this.update();
      } else {
        this.showInfo("Действие отменено пользователем");
      }
    }
  }
};
</script>