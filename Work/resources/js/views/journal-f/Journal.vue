<template lang="pug">
    v-content.ma-0.pa-0
        v-layout.column.wrap
            c-load-file-dialog(ref="load")
            v-flex(v-if="journal")
                v-card.mx-auto.pa-2(raised dark min-width="300px")
                    v-card-actions.px-0
                        v-dialog(v-model="dialog" persistent max-width="600px")
                            template(v-slot:activator="{ on }")
                                v-btn.mr-1(small dark color="success" v-on="on") добавить
                            v-card.mx-auto(raised dark)
                                v-system-bar(dark color="primary")
                                    span Новый семестр
                                v-form.pa-2   
                                    v-combobox(:items="[1,2,3,4,5,6,7,8]" v-model="selected_new_semecter"  label="Добавить семестр №" outlined dense)
                                    v-card-actions
                                        v-btn(small dark color="red" @click="dialog = !dialog") отмена
                                        v-btn(small dark color="success" @click="newSemester(selected_new_semecter)") сохранить
                        v-btn.mx-1(v-if="selected_semester" small dark color="red" @click="deleteSemestr(selected_semester)") удалить семестр
                    v-combobox(:items="Object.keys(journal.journal)" v-model="selected_semester" label="Семестр" outlined dense)
                    v-btn(small dark color="red" @click="saveJournal") сохранить журнал
            v-flex(v-if="selected_semester")
                v-card.mx-auto(v-if="journal.titles[selected_semester].length > 0" raised dark min-width="300px")
                    v-card-text В данном разделе вы можете выставлять оценки студентам, а также отмечать посещаемость студентов.
                    v-form.px-2.py-0
                        v-dialog(ref="dialog" v-model="label" :return-value.sync="date" persistent width="290px")
                            template( v-slot:activator="{ on }")
                                v-text-field(dense outlined v-model="date" label="Дата" prepend-icon="event" readonly v-on="on")
                            v-date-picker( v-model="date" scrollable :first-day-of-week="1" locale="ru-Ru")
                                v-spacer
                                v-btn(text color="primary" @click="label = !label") отмена
                                v-btn(text color="primary" @click="$refs.dialog.save(date)") выбрать
                    v-form.px-2.py-0(ref="form")
                        v-text-field(dense v-model="titleOfSelected" :rules="titleRules" clearable outlined label="Тема занятия")  
                    v-card-actions
                        v-btn(small text dark color="success" @click="addDate") добавить
                        v-btn(small text dark color="red" @click="$refs.form.reset(); date = new Date().toISOString().substr(0, 10);") очистить           
        v-layout.row.wrap(v-if="selected_semester")
            v-flex(v-if="journal.titles[selected_semester].length > 0")
                v-simple-table(dark fixed-header)
                    template( v-slot:default)
                        thead(v-if="journal")
                            th(min-width="250px" class="text-left") ФИО
                            th(class="text-center" v-for="(item, j) in journal.journal[selected_semester]" :key="item.key") 
                                v-menu(bottom origin="center center" transition="scale-transition")
                                    template(v-slot:activator="{ on }")
                                        v-btn(x-small text v-on="on" outlined) {{item.date}}
                                    v-list
                                        v-list-item(v-for="(action, i) in actions" :key="i" @click="deleteDate(j)")
                                            v-list-item-title {{ action }}
                        tbody(v-if="journal")
                            tr(v-for="(item, i) in journal.students" :key="item.name")
                                td(min-width="250px" class="text-left" fixed) 
                                    div(min-width="250px") {{item.fullFio}}
                                td(class="text-center" v-for="ozenka in journal.journal[selected_semester]" :key="journal.key")
                                    v-menu(bottom origin="center center" transition="scale-transition")
                                        template(v-slot:activator="{ on }")
                                            v-btn(small text v-on="on" outlined :color="ozenka.students[item.student_id] == '2' ? 'red' : ozenka.students[item.student_id] == '3' ? 'orange' : ozenka.students[item.student_id] == '4' ? 'light-green' : ozenka.students[item.student_id] == '5' ? 'green' : 'white'") {{ozenka.students[item.student_id]}}
                                        v-list
                                            v-list-item(v-for="(itemp, i) in items" :key="i" @click="ozenka.students[item.student_id] = itemp")
                                                v-list-item-title {{ itemp }}                                  
            v-flex
                v-card.mx-auto(raised dark min-width="300px")
                    v-system-bar(color="primary")
                        span Календарно-тематический план
                    div.pa-2
                        v-card.mb-1(dark outlined flat scrollable max-height="480px" )
                            v-list(v-if="journal.titles[selected_semester].length > 0" color="primary")
                                v-list-item(v-for="(title, i) in journal.titles[selected_semester]" :key="i" @click="titleOfSelected = title.title")
                                    v-list-item-content
                                        v-list-item-subtitle {{ title.title }}
                                    v-list-item-action
                                        v-btn(icon small dark @click="deleteTitle(i)")
                                            v-icon close
                            v-list-item-group(v-else color="primary")
                                v-list-item
                                    v-list-item-content
                                        v-list-item-subtitle Нет данных по семестру
                        v-form(ref="form_title")
                            v-card(dark flat)
                                v-text-field(v-model="title.title" :rules="titlesRules" dense clearable outlined label="Тема")
                                v-text-field(v-model="title.amountHours" :rules="amountHoursRules" dense clearable outlined label="Кол-во часов")
                                v-card-actions
                                    v-btn(small text dark color="success" @click="addTitle(title)") добавить
                                    v-spacer
                                    v-btn(small text dark color="blue" @click="loadTitle") загрузить     
        v-layout.column.wrap(v-if="selected_semester")
            v-flex(v-if="journal.journal[selected_semester].length > 0")
                v-card.mx-auto(raised dark min-width="300px")
                    v-system-bar(color="primary")
                        span Прогресс выполнения плана
                    v-simple-table(dark fixed-header)
                        template( v-slot:default)
                            thead(v-if="journal")
                                th(class="text-left") Дата
                                th(class="text-left") Тема
                                th(class="text-left") Часы
                            tbody(v-if="journal")
                                tr(v-for="(item, j) in journal.journal[selected_semester]" :key="item.key")
                                    td {{item.date}}
                                    td {{item.title}}
                                    td 2
                                tr
                                    td Дат: {{journal.journal[selected_semester].length}}
                                    td 
                                    td Итого: {{journal.journal[selected_semester].length * 2}} ч.        
</template> 

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import LoadFitleDialog from "@/js/components/load-file-f/LoadFileDialog";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_journal from "@/js/api/journal";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withSnackbar, withOverlayLoading],
  components: {
    "c-load-file-dialog": LoadFitleDialog
  },
  data() {
    return {
      headers: [],
      title: {
        id: null,
        title: null,
        amountHours: null
      },
      titleOfSelected: null,
      date: new Date().toISOString().substr(0, 10),
      selected_new_semecter: 1,
      label: false,
      journal: null,
      dialog: false,
      selected_semester: null,
      items: ["2", "3", "4", "5", "НБ", "НБУ", "ОП", "Б"],
      actions: ["Удалить"],
      titleRules: [v => !!v || "Поле не должно быть пустое!"],
      titlesRules: [v => !!v || "Поле не должно быть пустое!"],
      amountHoursRules: [v => !!v || "Поле не должно быть пустое!"]
    };
  },

  computed: {
    ...mapGetters(["user", "id_journal"])
  },

  async beforeMount() {
    if (!this.id_journal) {
      location.href = "/" + this.user.post.slug + "/journals";
    } else {
      this.journal = await api_journal.getJournalById(this.id_journal); //Id журнала
      if (this.selected_semester != null) this.headers = this.getHeaders();
    }
  },
  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    //!-----------------------------
    //! Работа с семестрами
    //!-----------------------------
    //Формирование семестра
    newSemester(selected_new_semecter) {
      if (
        Object.keys(this.journal.journal).indexOf(selected_new_semecter) == -1
      ) {
        this.journal.journal[selected_new_semecter] = [];
        this.journal.titles[selected_new_semecter] = [];
        this.$forceUpdate();
        this.selected_semester = this.selected_new_semecter;
        this.dialog = !this.dialog;
      }
    },
    //Удаление семестра
    deleteSemestr(selected_semester) {
      delete this.journal.journal[selected_semester];
      delete this.journal.titles[selected_semester];
      this.selected_semester = null;
      this.$forceUpdate();
    },
    //!-----------------------------
    //! Работа с темами журнала
    //!-----------------------------
    //Добавление темы
    addTitle(item) {
      if (this.$refs.form_title.validate()) {
        this.journal.titles[this.selected_semester].push({
          id: Math.random()
            .toString(36)
            .substr(2, 9),
          title: item.title,
          amountHours: item.amountHours
        });
        this.$refs.form_title.reset();
        this.$forceUpdate();
      }
    },
    //Удаление темы
    deleteTitle(id) {
      this.journal.titles[this.selected_semester].splice(id, 1);
      this.$forceUpdate();
      this.titleOfSelected = null;
    },
    //Загрузка тем из файла
    async loadTitle() {
      await this.$refs.load.pop().then(result => {
        if (result) {
          this.showInfo("Файл загружен успешно");
        }
      });
    },
    //!-----------------------------
    //! Работа с датами журнала
    //!-----------------------------
    addDate() {
      if (this.$refs.form.validate()) {
        var arrStudents = {};
        this.journal.students.forEach(element => {
          arrStudents[element.student_id] = "Б";
        });

        this.journal.journal[this.selected_semester].push({
          students: arrStudents,
          title: this.titleOfSelected,
          date: this.date
        });
        this.journal.journal[this.selected_semester] = this.sortByDate(
          this.journal.journal[this.selected_semester]
        );

        this.headers = this.getHeaders();
      }
    },
    //Удаление элемента массива
    deleteDate(id) {
      this.journal.journal[this.selected_semester].splice(id, 1);
    },
    //!-----------------------------
    //! Дополнительные функции
    //!-----------------------------
    getHeaders() {
      var headers = [];
      headers.push({
        text: "ФИО",
        align: "start",
        sortable: false,
        value: "students"
      });
      this.journal.journal[this.selected_semester].forEach(element => {
        headers.push({ text: element.date, value: element });
      });

      return headers;
    },
    //Сортировка по дате
    sortByDate(arr) {
      return arr.sort((a, b) => (a.date > b.date ? 1 : -1));
    },
    //Редактирование журнала отправляем обратно те же данные что и получили
    async saveJournal() {
      await api_journal.editJournal(this.journal); //Редактирование журнала
    }
  }
};
</script>