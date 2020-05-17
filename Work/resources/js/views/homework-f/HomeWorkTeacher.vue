<template lang="pug">
  v-content.ma-0.pa-0
    c-create-homework-dialog(ref="create")
    v-layout.column.wrap
      v-flex
        v-card(flat)
          v-tabs(v-model="tabs" centered slider-color="orange darken-1")
            v-tab Лента
            v-tab Календарь
          v-tabs-items(v-model="tabs")
            v-tab-item
              div.pa-3(class="order-1 d-flex flex-wrap justify-center")
                div.ma-2(class="d-flex justify-end")
                  v-card(max-width="366" min-width="300")
                    v-card-title Инструменты
                    v-card-text Тут отображаются доступные вам инструменты для работы с данным ресурсом
                    v-card-actions
                      v-btn(small text block color="orange darken-1" @click="createHomeWork") Создать задание
                div.ma-2(class="order-0 d-flex justify-start")
                  v-card(max-width="640" min-width="300")
                    v-card-text Данный ресурс предоставляет вам возможности назначения групп на различные виды заданий, такие как курсовые, дипломные и домашние работы.
                    v-card-actions.px-4.pb-0.pt-7
                      v-text-field.single-line.hide-details(label="Поиск по заголовкам" v-model="search" dense outlined prepend-inner-icon="search" clearable :disabled="!homework_list ? true : false")
              v-layout.row.wrap(v-if="homework_list")
                v-flex
                  v-alert.mx-auto.my-2(v-if="!homework_list" type="warning" :elevation="2" max-width="1024px" min-width="300px") Внимание: некоторые функции не доступны, так как у вас нет ни одного задания.
                  v-card.mx-auto.pa-2(nav dense max-width="1024px" min-width="300px")
                    v-data-iterator(:items="homework_list" :search="search" hide-default-footer no-data-text='Данные по заданиям отсутствуют' no-results-text='Поиск не привёл к нахождению релевантного ответа')
                      template(v-slot:default="props")
                        v-list
                          v-list-item-group(v-model="selected_item" color="orange darken-1")
                            v-list-item(v-for="(item, index) in props.items" :key="item.id")
                              v-list-item-icon
                                v-icon mdi-bookshelf
                              v-list-item-content
                                v-list-item-title(v-text="item.title")
                                v-list-item-subtitle Тип задания: {{types[item.type]}}
                                v-list-item-subtitle Группы: {{item.groups.length == 0 ? 'Ошибка' : item.groups.join(', ')}}
                                v-list-item-subtitle.my-2 Дата создания: {{item.date}}
                                v-list-item-subtitle Автор: {{item.teacher_admin}}
                              v-list-item-action
                                v-btn(icon @click="goToHomeworck(item.id)")
                                  v-icon mdi-chevron-right          
            v-tab-item
              v-row(class="fill-height")
                v-col
                  v-sheet(height="64")
                    v-toolbar( flat color="white")
                      v-btn(outlined small class="mr-4" color="orange darken-1" @click="setToday") СЕГОДНЯ
                      v-btn(fab text small color="orange darken-1" @click="prev")
                        v-icon(small) mdi-chevron-left
                      v-toolbar-title {{ title }}
                      v-btn(fab text small color="orange darken-1" @click="next")
                        v-icon(small) mdi-chevron-right
                      v-spacer
                      v-menu(bottom right)
                        template(v-slot:activator="{ on }")
                          v-btn(outlined small color="orange darken-1" v-on="on")
                            span {{typeToLabel[type]}}
                            v-icon(right) mdi-menu-down
                        v-list
                          v-list-item(@click="type = 'day'")
                            v-list-item-title День
                          v-list-item(@click="type = 'week'")
                            v-list-item-title Неделя
                          v-list-item(@click="type = 'month'")
                            v-list-item-title Месяц
                          v-list-item(@click="type = '4day'")
                            v-list-item-title 4 дня
                  v-sheet(height="600")
                    v-calendar(ref="calendar" locale="ru-Ru" :weekdays="[1, 2, 3, 4, 5, 6, 0]" v-model="focus" color="primary" :events="events" :event-color="getEventColor" :now="today" :type="type"  @click:event="showEvent" @click:more="viewDay" @click:date="viewDay" @change="updateRange")
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import CreateHomeWorkDialog_С from "@/js/components/home-work-f/CreateHomeWorkDialog";
//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_homework from "@/js/api/homework";
import api_student from "@/js/api/student";
import api_department from "@/js/api/department"; //Отделения
import api_teacher from "@/js/api/teacher"; //Отделения
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
  components: {
    "c-create-homework-dialog": CreateHomeWorkDialog_С
  },

  post_name: {
    name: "Домашнее задание",
    url: "homework_teacher",
    dop_com: [
      //!Прописать путь до вывода подробностей об задании
      {
        url: "journal/:group_id",
        path: "js/views/journal-f/JournalOfSubjects"
      }
    ]
  },

  data() {
    return {
      tabs: null,
      selected_item: null,
      search: null,
      homework: null,
      types: [
        "Новость",
        "Домашнее задание",
        "Повременное домашнее задание",
        "Курсовой проект",
        "Дипломная работы",
        "Экзамен"
      ],
      typeToLabel: {
        month: "Месяц",
        week: "Неделя",
        day: "День",
        "4day": "4 дня"
      },
      focus: null,
      type: "month",
      start: null,
      end: null,
      today: null,
      selectedEvent: {},
      selectedElement: null,
      selectedOpen: false,
      events: [],
      colors: [
        "blue",
        "indigo",
        "deep-purple",
        "cyan",
        "green",
        "orange",
        "grey darken-1"
      ],
      names: [
        "Meeting",
        "Holiday",
        "PTO",
        "Travel",
        "Event",
        "Birthday",
        "Conference",
        "Party"
      ]
    };
  },

  computed: {
    ...mapGetters([
      "specialities",
      "groups_combo",
      "user",
      "teachers_combo",
      "homework_list"
    ]),
    title() {
      const { start, end } = this;
      if (!start || !end) {
        return "";
      }
      const startMonth = this.monthFormatter(start);
      const endMonth = this.monthFormatter(end);
      const suffixMonth = startMonth === endMonth ? "" : endMonth;

      const startYear = start.year;
      const endYear = end.year;
      const suffixYear = startYear === endYear ? "" : endYear;

      const startDay = start.day + this.nth(start.day);
      const endDay = end.day + this.nth(end.day);

      switch (this.type) {
        case "month":
          return `${startMonth} ${startYear}`;
        case "week":
        case "4day":
          return `${startMonth} ${startDay} ${startYear} - ${suffixMonth} ${endDay} ${suffixYear}`;
        case "day":
          return `${startMonth} ${startDay} ${startYear}`;
      }
      return "";
    },
    monthFormatter() {
      return this.$refs.calendar.getFormatter({
        timeZone: "UTC",
        month: "long"
      });
    }
  },

  async beforeMount() {
    this.showLoading("Получение данных");
    //Получение отделений
    let items = await api_department.getDepartments();
    await this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);

    //Получение групп
    if (this.specialities) {
      if (this.specialities.length > 0) {
        await this.$store.dispatch(actions.ADD_CACHE_GROUP_DATA, {
          context: this,
          result: this.specialities[0].id
        });
      }
    }

    //Получение преподавателей
    if (this.teachers_combo == null) {
      let items = await api_teacher.getTeachers();
      this.$store.commit(mutations.SET_TEACHERS_COMBO, items);
    }

    //Получение данных
    await this.$store.dispatch(actions.ADD_CACHE_HOMEWORK, {
      context: this,
      id: this.user.id
    });
    this.closeLoading("Получение данных");
  },

  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async createHomeWork() {
      var res = await this.$refs.create.pop().then(result => {
        if (result) {
          return result;
          //await api_homework.saveHomeWork(result);
          //!this.$store.dispatch(actions.CREATE_JOURNAL, {data: result, result: this.$route.params.group_id}); Создание журнала
          this.showInfo("Домашнее задание сделано!");
        } else this.showInfo("Действие было отменено пользователем");
      });

      if (res) await api_homework.saveHomeWork(res);
      this.$refs.create.$refs.form.reset();
    },
    async goToHomeworck(homework_id) {
      console.log(homework_id);
    },
    viewDay({ date }) {
      this.focus = date;
      this.type = "day";
    },
    getEventColor(event) {
      return event.color;
    },
    setToday() {
      this.focus = this.today;
    },
    prev() {
      this.$refs.calendar.prev();
    },
    next() {
      this.$refs.calendar.next();
    },
    showEvent({ nativeEvent, event }) {
      const open = () => {
        this.selectedEvent = event;
        this.selectedElement = nativeEvent.target;
        setTimeout(() => (this.selectedOpen = true), 10);
      };

      if (this.selectedOpen) {
        this.selectedOpen = false;
        setTimeout(open, 10);
      } else {
        open();
      }

      nativeEvent.stopPropagation();
    },
    updateRange({ start, end }) {
      const events = [];

      const min = new Date(`${start.date}T00:00:00`);
      const max = new Date(`${end.date}T23:59:59`);
      const days = (max.getTime() - min.getTime()) / 86400000;
      const eventCount = this.rnd(days, days + 20);

      for (let i = 0; i < eventCount; i++) {
        const allDay = this.rnd(0, 3) === 0;
        const firstTimestamp = this.rnd(min.getTime(), max.getTime());
        const first = new Date(firstTimestamp - (firstTimestamp % 900000));
        const secondTimestamp = this.rnd(2, allDay ? 288 : 8) * 900000;
        const second = new Date(first.getTime() + secondTimestamp);

        events.push({
          name: this.homework_list[this.rnd(0, this.homework_list.length - 1)].title,
          start: this.formatDate(first, !allDay),
          end: this.formatDate(second, !allDay),
          color: this.colors[this.rnd(0, this.colors.length - 1)]
        });
      }

      this.start = start;
      this.end = end;
      this.events = events;
    },
    nth(d) {
      return d > 3 && d < 21
        ? "th"
        : ["th", "st", "nd", "rd", "th", "th", "th", "th", "th", "th"][d % 10];
    },
    rnd(a, b) {
      return Math.floor((b - a + 1) * Math.random()) + a;
    },
    formatDate(a, withTime) {
      return withTime
        ? `${a.getFullYear()}-${a.getMonth() +
            1}-${a.getDate()} ${a.getHours()}:${a.getMinutes()}`
        : `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`;
    }
  }
};
</script>