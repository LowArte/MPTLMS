<template lang="pug">
    v-dialog(v-model="dialog" persistent fullscreen hide-overlay)
        c-load-file-dialog-homework(ref="load_file_dialog")
        v-card(scrollable)
            v-system-bar(color="white")
              span Конструктор задания
              v-spacer
              v-btn(text dark x-small color="orange darken-1" @click="cancel()") отмена
            v-progress-linear(:active="loading" :indeterminate="loading" absolute top  color="orange darken-1") 
            v-card-text.pt-2
                v-form(ref="form")
                  v-autocomplete(outlined dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-value="id" item-text="dep_name_full" :items="specialities" v-model="selected_department_id" :rules="DepartmentRules")
                  v-autocomplete(:disabled="selected_department_id ? false : true" v-model="homework.groups_id" :label="'Группы (' + homework.groups_id.length + ')'" :items="groups" outlined dense no-data-text="Нет данных" item-value='id' small-chips chips multiple item-text='group_name' clearable :rules="[GroupRules.required]")
                  v-autocomplete(:disabled="loading" v-model="homework.teachers" label="Соавторы" outlined dense :items="getTeacher" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple clearable)
                  v-autocomplete(outlined dense @change="type_change" item-value="id" item-text="name" :items="types" v-model="homework.type" label="Тип задания")
                  v-text-field(outlined dense v-model="homework.info.title" label="Название (основное)" :rules="TitleRules")
                  v-textarea(outlined v-model="homework.info.text" :rules="TextRules" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Описание (основное)" :row-height="24" :rows="3")
                  v-card-actions
                    v-btn(text color="orange darken-1" @click="loadFile()") Прикрепить документы
                    v-btn(small text color="red" @click="deleteFileInQwee()") Очистить документы
                  v-layout.row.wrap(v-if="files")
                    v-flex(v-if="files.length > 0")
                      v-layout.column.wrap
                        v-card.pa-2.mx-auto(flat min-width="300px")
                          v-data-iterator(:items="files" hide-default-footer no-data-text="")
                            template(v-slot:default="props")
                              v-layout.column.wrap
                                div.pa-3(class="order-1 d-flex flex-wrap justify-start")
                                  div.ma-2(class="order-0 d-flex justify-start" v-for="(file, index) in props.items" :key="index")
                                    v-card.mx-auto.my-2.pa-0(outlined :elevation="0" width="300px")
                                      v-list.pa-0(dense flat)
                                        v-list-item-group
                                          v-list-item
                                            v-list-item-avatar
                                              v-icon(:color="getIconColor(file)") {{getIconWithExtention(file)}}
                                            v-list-item-content
                                              v-list-item-title {{getFileName(file)}}
                                              v-list-item-subtitle(v-if="getExt(file) == '.bat'") Вредоносный файл
                  v-item-group
                    v-item(v-if="homework.type == 1")
                        v-date-picker(:allowed-dates="val => new Date(val).getDay() != 0" :min='new Date().toISOString().substr(0, 10)' full-width v-model="homework.info.date" no-title :first-day-of-week="1" locale="ru-Ru")
                    v-item(v-if="homework.type == 2")
                      div
                        v-menu(ref="multi_homework" v-model="drop_menu_date_picker_event_tow" :close-on-content-click="false" transition="scale-transition" offset-y min-width="290px")
                          template(v-slot:activator="{ on }")
                            v-combobox(outlined dense v-model="dates_homework" multiple chips small-chips label="Даты этапов выполнения работы" prepend-icon="event" readonly v-on="on")
                          v-date-picker(:allowed-dates="val => new Date(val).getDay() != 0" :min='new Date().toISOString().substr(0, 10)' multiple v-model="dates_homework" no-title :first-day-of-week="1" locale="ru-Ru")
                            v-btn(text color="primary" @click="drop_menu_date_picker_event_tow = !drop_menu_date_picker_event_tow") Отмена
                            v-btn(text color="orange darken-1" @click="changeDateForTypeTwo(dates_homework)") Применить
                        div(v-for="(item, date) in homework.info.date" :key="date")
                          v-card.pa-2.ma-3(outlined :elevation="0")
                            span {{date}}
                            v-text-field(outlined dense v-model="item.title" :rules="InsideTileRules" label="Название этапа")
                            v-textarea(outlined v-model="item.text" :rules="InsideTextRules" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Описание этапа" :row-height="24" :rows="3")
                    v-item(v-if="homework.type == 3")
                      div
                        v-date-picker.mb-3(:allowed-dates="val => new Date(val).getDay() != 0" :min='new Date().toISOString().substr(0, 10)' full-width v-model="homework.info.date" no-title :first-day-of-week="1" locale="ru-Ru")
                        v-autocomplete(outlined dense v-model="homework.info.place_id" label="Место проведения" :rules="PlacesRules" :items="places" no-data-text="Нет данных" item-value='id' item-text='place_name')
                        v-text-field(outlined dense v-model="homework.info.classroom" label="Кабинет")
            v-card-actions
                v-spacer
                v-btn(small text dark color="orange darken-1" @click="cancel()") отмена
                v-btn(small text dark color="success" @click="saveHomeWork" :loading="loading" :disabled="loading") сохранить
                
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";
import withSnackbar from "@/js/components/mixins/withSnackbar";
import LoadFileDialogHomework_С from "@/js/components/home-work-f/LoadFileDialogHomework";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           api
//?----------------------------------------------
import api_homework from "@/js/api/homework";

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withOverlayLoading, withSnackbar],

  components: {
    "c-load-file-dialog-homework": LoadFileDialogHomework_С
  },

  computed: {
    ...mapGetters([
      "specialities",
      "groups_combo",
      "user",
      "teachers_combo",
      "places"
    ]),
    getTeacher() {
      if (!this.teachers_combo) return undefined;
      return this.teachers_combo.filter(res => {
        if (res.id == this.user.id) return false;
        return true;
      });
    }
  },
  data() {
    return {
      files: [],
      dialog: false,
      drop_menu_date_picker_event_tow: false,
      dates_homework: [],
      item: null,
      groups: null,
      selected_department_id: null,
      loading: false,
      types: [
        { id: 0, name: "Сообщение" },
        { id: 1, name: "Домашнее задание" },
        { id: 2, name: "Поэтапное задание " },
        { id: 3, name: "Экзамен" }
      ],
      homework: {
        user_id: null,
        groups_id: [],
        teachers: [],
        documents: null,
        info: {
          title: null,
          text: null,
          date: null,
          place_id: null,
          classroom: null
        },
        type: 0
      },
      DepartmentRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      TitleRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      TextRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      InsideTileRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      InsideTextRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      PlacesRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ],
      GroupRules: {
        required: value => {
          return !!value.length || "Данное поле не должно оставаться пустым";
        }
      }
    };
  },
  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async pop() {
      this.dialog = true;
      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    //Сохранение нового журнала
    async saveHomeWork() {
      if (this.$refs.form.validate()) {
        this.dialog = false;
        this.alert = false;
        this.homework.user_id = this.user.id;
        this.files = [];
        this.resolve(this.homework);
      } else this.showError("Валидация не пройдена");
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

    type_change() {
      let title = this.homework.info.title;
      let text = this.homework.info.text;
      this.homework.info = {
        title: title,
        text: text,
        date: null,
        place_id: null,
        classroom: null
      };
    },

    changeDateForTypeTwo(dates_homework) {
      this.$refs.multi_homework.save(dates_homework);
      this.homework.info.date = {};
      dates_homework = this.sortByDate(dates_homework);
      dates_homework.forEach(element => {
        this.homework.info.date[element] = { title: null, text: null };
      });
    },

    async loadFile() {
      this.files = [];
      this.homework.documents = null;
      await this.$refs.load_file_dialog.pop().then(result => {
        if (result) {
          result.files.forEach(element => {
            this.files.push(element.name);
          });
          this.homework.documents = result.main;
        } else {
          this.showInfo("Действие отменено пользователем!");
        }
      });
    },
    //?----------------------------------------------
    //!           Дополнительные методы
    //?----------------------------------------------
    //Сортировка по дате
    sortByDate(arr) {
      return arr.sort((a, b) => (a > b ? 1 : -1));
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
      else this.showError("Ошибка скачивания!");
    },
    deleteFileInQwee() {
      this.files = [];
      this.homework.documents = null;
    },
    cancel() {
      this.dialog = !this.dialog;
      this.$refs.form.reset();
      this.alert = false;
      this.files = [];
      this.homework = {
        user_id: null,
        groups_id: [],
        teachers: [],
        documents: null,
        info: {
          title: null,
          text: null,
          date: null,
          place_id: null,
          classroom: null
        }
      };
    }
  }
};
</script>