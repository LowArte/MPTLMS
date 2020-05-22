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
                      v-text-field.single-line.hide-details(label="Поиск" v-model="search" dense outlined prepend-inner-icon="search" clearable :disabled="!homework_list ? true : false")
              v-layout.column.wrap
                v-flex(v-if="!homework_list && loading == true")
                  v-alert.mx-auto.my-2(v-if="!homework_list.length > 0" type="warning" :elevation="2" max-width="1024px" min-width="300px") Внимание: некоторые функции не доступны, так как у вас нет ни одного задания.
                v-flex(v-if="homework_list  && loading == true")
                  v-card.mx-auto.pa-1(flat max-width="1024px" min-width="300px")
                    v-data-iterator(:items="homework_list" :search="search" hide-default-footer no-data-text='Данные по заданиям отсутствуют' no-results-text='Поиск не привёл к нахождению релевантного ответа')
                      template(v-slot:default="props")
                        v-list
                          v-list-item-group(v-model="selected_item" color="orange darken-1")
                            v-card.mx-auto
                              v-list-item(v-for="(item, index) in props.items" :key="item.id")
                                v-list-item-icon
                                  v-icon mdi-bookshelf
                                v-list-item-content
                                  v-list-item-title(v-text="item.title")
                                  v-list-item-subtitle Тип задания: {{types[item.type]}}
                                  v-list-item-subtitle Группы: {{item.groups.length == 0 ? 'Ошибка' : item.groups.join(', ')}}
                                  v-list-item-subtitle(v-if="item.teacher_admin") Автор: {{item.teacher_admin}}
                                v-list-item-action
                                  v-btn(icon @click="goToHomeworck(item.id)")
                                    v-icon mdi-chevron-right          
            v-tab-item
              v-row(class="fill-height")
                v-col
                  v-sheet(height="64")
                    v-toolbar( flat color="white")
                      v-btn(outlined small class="mr-4" color="orange darken-1" @click="setToday") ТЕКУЩИЙ МЕСЯЦ
                      v-btn(fab text small color="orange darken-1" @click="prev")
                        v-icon(small) mdi-chevron-left
                      v-toolbar-title {{ title }}
                      v-btn(fab text small color="orange darken-1" @click="next")
                        v-icon(small) mdi-chevron-right
                  v-sheet(height="920")
                    v-calendar(ref="calendar" locale="ru-Ru" :weekdays="[1, 2, 3, 4, 5, 6]" v-model="focus" color="primary" :events="events" :event-color="getEventColor" :now="today" :type="type"  @click:event="showEvent" @change="updateRange")
                    v-menu(v-model="selectedOpen" :close-on-content-click="false" :activator="selectedElement" offset-x)
                      v-card(min-width="300px" max-width="320px" flat)
                        v-system-bar(:color="selectedEvent.color" dark)
                          small {{new Date(selectedEvent.end) <= new Date() ? 'Период сдачи стёк' : 'Задание в процессе'}}
                        span.title.px-4.mt-2(v-if="selectedEvent.details" :color="selectedEvent.color") {{selectedEvent.name}}
                        v-card-text.pt-1(v-if="selectedEvent.details")
                          span {{selectedEvent.details.full_text}}
                          v-divider.my-2
                          span.py-0(:color="selectedEvent.color") {{selectedEvent.details.title}}
                          br
                          small.py-0 {{selectedEvent.details.text}}
                        v-card-text(v-else)
                          small(v-html="selectedEvent.name")
                          br
                          span(v-if="selectedEvent.details" v-html="selectedEvent.details.full_text")
                        v-card-actions
                          v-btn(text small block color="secondary" @click="selectedOpen = false") закрыть
                          
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import CreateHomeWorkDialog_С from "@/js/components/home-work-f/CreateHomeWorkDialog";
import Notification from "@/js/plugins/NotificationsHelpers";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_homework from "@/js/api/homework";
import api_student from "@/js/api/student";
import api_department from "@/js/api/department"; //Отделения
import api_teacher from "@/js/api/teacher"; //Преподователи
import api_place from "@/js/api/place"; //Места проведения
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
  mixins: [withSnackbar, withOverlayLoading, Notification],
  components: {
    "c-create-homework-dialog": CreateHomeWorkDialog_С
  },

  post_name: {
    name: "Домашнее задание",
    url: "homework_teacher",
    dop_com: [
      {
        url: "homework/:home_work_id",
        path: "js/views/homework-f/HomeWorkShowTeacher"
      }
    ]
  },

  data() {
    return {
      tabs: null,
      loading: false,
      selected_item: null,
      search: null,
      homework: null,
      types: ["Новость", "Домашнее задание", "Поэтапное задание", "Экзамен"],
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
        "indigo",
        "deep-purple",
        "cyan",
        "teal",
        "green",
        "deep-orange",
        "blue-grey"
      ]
    };
  },

  computed: {
    ...mapGetters([
      "specialities",
      "groups_combo",
      "user",
      "teachers_combo",
      "homework_list",
      "places"
    ]),
    title() {
      const { start, end } = this;
      if (!start || !end) {
        return "";
      }
      const startMonth = this.monthFormatter(start);
      const startYear = start.year;
      switch (this.type) {
        case "month":
          return `${startMonth} ${startYear}`;
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
    this.loading = false;
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

    //Получение мест проведения
    if (this.places == null) {
      let items = await api_place.getPlaces();
      this.$store.commit(mutations.SET_PLACES_FULL, items);
    }

    //Получение данных
    await this.$store.dispatch(actions.ADD_CACHE_HOMEWORK, {
      context: this,
      id: this.user.id
    });
    this.closeLoading("Получение данных");
    this.loading = true;
  },

  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async createHomeWork() {
      var res = await this.$refs.create.pop().then(result => {
        if (result) {
          return result;
        } else this.showInfo("Действие было отменено пользователем");
      });
      if (res) {
        let api_result = await api_homework.saveHomeWork(res);
        if (api_result) 
        {
          if(res.documents)
          {
            if(await api_homework.loadDocuments({documents: res.documents, homework_id: api_result}))
              this.showMessage("Файл(ы) загружены успешно!");
            else
              this.showError("Файл(ы) не загружен(ы)!");
          }

          this.showMessage("Домашнее задание сделано");
          this.showMessage("Рассылаем уведомления");
          res.groups_id.forEach(element => {
            this.addMessageForUserGroup(element, {
              icon: "mdi-android-messages",
              title: "Новое задание",
              subtitle:
                "Вам назначено новое задание. Чтобы ознакомится с ним подробнее перейдите в соотвествующий раздел.",
              done: false
            });
          });
        } 
        else 
          this.showError("Произошла ошибка");
      }

      this.$refs.create.$refs.form.reset();
    },
    async goToHomeworck(home_work_id) {
      this.$router.push(
        "/" + this.user.post.slug + "/homework/" + home_work_id
      );
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
      let homework_list = JSON.parse(JSON.stringify(this.homework_list));
      homework_list.forEach(element => {
        if (element.type == 2) {
          element.dates_homework_keys = Object.keys(element.dates_homework);
          element.dates_homework_keys.forEach(element_date => {
            events.push({
              name: element.title,
              start: this.formatDate(new Date(element_date), false),
              end: this.formatDate(new Date(element_date), false),
              color:
                this.formatDate(new Date(element_date), false) <= new Date()
                  ? "red"
                  : this.colors[this.rnd(0, this.colors.length - 1)],
              details: {
                full_text: element.text,
                title: element.dates_homework[element_date].title,
                text: element.dates_homework[element_date].text
              }
            });
          });
        } else {
          events.push({
            name: element.title,
            start: this.formatDate(new Date(element.dates_homework), false),
            end: this.formatDate(new Date(element.dates_homework), false),
            color:
              this.formatDate(new Date(element.dates_homework), false) <=
              new Date()
                ? "red"
                : this.colors[this.rnd(0, this.colors.length - 1)],
            details: { full_text: element.text, title: null, text: null }
          });
        }
      });
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
            1} - ${a.getDate()} ${a.getHours()}:${a.getMinutes()}`
        : `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`;
    },
  }
};
</script>