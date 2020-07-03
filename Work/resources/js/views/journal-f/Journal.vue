<template lang="pug">
    v-content.ma-0.pa-0
        v-layout.column.wrap
            v-flex(v-if="journal")
                v-card.mx-auto.pa-2(flat :elevation="0"  min-width="300px")
                    v-combobox(:items="Object.keys(journal.journal)" v-model="selected_semester" label="Семестр" outlined dense)
                    v-btn(small text color="red" @click="editJournal") сохранить журнал
            v-flex(v-if="selected_semester")
                v-card.mx-auto(:elevation="4" min-width="300px")
                    v-card-text В данном разделе вы можете выставлять оценки студентам, а также отмечать посещаемость студентов.
                    v-form.px-2.py-0
                        v-dialog(ref="dialog" v-model="label" :return-value.sync="date" persistent width="290px")
                            template( v-slot:activator="{ on }")
                                v-text-field(dense outlined v-model="date" label="Дата" prepend-icon="event" readonly v-on="on")
                            v-date-picker(:allowed-dates="val => new Date(val).getDay() != 0" v-model="date" scrollable :first-day-of-week="1" locale="ru-Ru")
                                v-spacer
                                v-btn(text color="primary" @click="label = !label") отмена
                                v-btn(text color="primary" @click="$refs.dialog.save(date)") выбрать
                    v-form.px-2.py-0(ref="form")
                        v-text-field(dense v-model="titleOfSelected" :rules="titleRules" clearable outlined label="Тема занятия")  
                    v-card-actions
                        v-btn(small text color="success" @click="addDate") добавить
                        v-btn(small text color="red" @click="$refs.form.reset(); date = new Date().toISOString().substr(0, 10);") очистить           
        v-layout.row.wrap(v-if="selected_semester")
            v-flex
                v-simple-table(:elevation="4" fixed-header)
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
                                    div(min-width="250px") {{item.user.not_short_fio}}
                                td(class="text-center" v-for="ozenka in journal.journal[selected_semester]" :key="journal.key")
                                    v-menu(bottom origin="center center" transition="scale-transition")
                                        template(v-slot:activator="{ on }")
                                            v-btn(small text v-on="on" outlined :color="ozenka.students[item.id] == '2' ? 'red' : ozenka.students[item.id] == '3' ? 'orange' : ozenka.students[item.id] == '4' ? 'light-green' : ozenka.students[item.id] == '5' ? 'green' : 'primary'") {{ozenka.students[item.id]}}
                                        v-list
                                            v-list-item(v-for="(itemp, i) in items" :key="i" @click="ozenka.students[item.id] = itemp") {{itemp}}
        v-layout.column.wrap(v-if="selected_semester")
            v-flex(v-if="journal.journal[selected_semester].length > 0")
                v-card.mx-auto(:elevation="4" min-width="300px")
                    v-system-bar(color="white")
                        span Прогресс выполнения плана
                    v-simple-table(fixed-header)
                        template( v-slot:default)
                            thead(v-if="journal")
                                th(class="text-left") Дата
                                th(class="text-left") Тема
                                th(class="text-left") Часы
                            tbody(v-if="journal")
                                tr(v-for="(item, j) in journal.journal[selected_semester]" :key="item.key")
                                    td {{item.date}}
                                    td
                                       v-text-field.mt-5(v-model="item.title" :rules="titlesRules" clearable label="Тема" outlined dense)
                                    td 2
                                tr
                                    td Дат: {{journal.journal[selected_semester].length}}
                                    td 
                                    td(v-if="selected_semester == 1") Итого: {{journal.journal[selected_semester].length * 2}} ч. / {{journal.discipline_info.discip_hours_first}} ч.       
                                    td(v-if="selected_semester == 2") Итого: {{journal.journal[selected_semester].length * 2}} ч. / {{journal.discipline_info.discip_hours_second}} ч.        
</template> 

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_journal from "@/js/api/journal";
import api_student from "@/js/api/student";
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
  watch: {
    "$route.params.journal_id": async function(journal_id) {
      this.selected_semester = null;
      if(journal_id)
      {
        let journal = await api_journal.getJournalById(journal_id);
        if(journal)
        {
          this.journal = journal;
          this.journal = this.journal[0];
          if(this.journal)
          {
            let students = await api_student.getStudentsByGroupId(this.journal.group_id);
            this.journal.students = students;
            if(Object.keys(this.journal.journal).length > 0)
              this.selected_semester = Object.keys(this.journal.journal)[0];
          }
        }
      }
    }
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
      amountHoursRules: [v => !!v || "Поле не должно быть пустое!"],
    };
  },

  computed: {
    ...mapGetters(["user"])
  },

  async beforeMount() 
  {
    let journal = await api_journal.getJournalById(this.$route.params.journal_id);
    this.journal = journal;
    if(journal)
    {
      this.journal = this.journal[0];
      if(this.journal)
      {
        let students = await api_student.getStudentsByGroupId(this.journal.group_id);
        this.journal.students = students;
        if(Object.keys(this.journal.journal).length > 0)
          this.selected_semester = Object.keys(this.journal.journal)[0];
      }
    }
    
    if (this.selected_semester != null) 
      this.headers = this.getHeaders();
  },
  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    //!-----------------------------
    //! Работа с датами журнала
    //!-----------------------------
    addDate() {
      if (this.$refs.form.validate()) {
        var arrStudents = {};
        this.journal.students.forEach(element => {
          arrStudents[element.id] = "Б";
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
    async editJournal() {
      if(await api_journal.editJournal(this.journal)) //Редактирование журнала
        this.showMessage("Выполнено!");
      else
        this.showError("Ошибка сохранения!");
    }
  }
};
</script>