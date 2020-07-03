<template lang="pug">
    v-content.ma-0.pa-0
      v-layout.column.wrap
        v-flex
          v-card(flat)
            v-tabs(v-model="tabs" centered slider-color="orange darken-1")
              v-tab Лента
              v-tab Календарь
            v-tabs-items.mt-2(v-model="tabs")
              v-tab-item
                v-layout.column.wrap
                  v-flex(v-if="homework_list && loading == false")
                    v-card.mx-auto.pa-1(max-width="1024px" min-width="300px")
                      v-card-text Данный ресурс позволяет вам следить за назначенными вам заданими или оповещениями о каких-либо работах, которые назанчил преподаватель, и своевременно их отправлять на проверку.
                      v-card-actions.px-4.pb-0.pt-7
                        v-text-field.single-line.hide-details(label="Поиск" v-model="search" dense outlined prepend-inner-icon="search" clearable :disabled="!homework_list.length > 0 ? true : false")
                  v-flex(v-if="homework_list && loading == false")
                    v-alert.mx-auto.my-2(v-if="!homework_list.length > 0" type="warning" :elevation="2" max-width="1024px" min-width="300px") У вас нет доступных заданий, преподаватели еще не создали их для вас.
                  v-flex(v-if="homework_list && loading == false")
                    v-card.mx-auto.pa-1(flat max-width="1024px" min-width="300px")
                      v-data-iterator(:items="homework_list" :search="search" :items-per-page.sync="homework_list.length" hide-default-footer no-data-text='' no-results-text='Поиск не привёл к нахождению релевантного ответа')
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
                        v-card(min-width="300px" max-width="420px" flat)
                          v-system-bar(:color="new Date(selectedEvent.end) <= new Date() ? 'red' : selectedEvent.color" dark)
                            small {{new Date(selectedEvent.end) <= new Date() ? 'Период сдачи стёкает' : new Date(selectedEvent.end) < new Date() ? 'Сдать с опозданием' : 'Задание в процессе'}}
                          v-card-title.pb-0(v-if="selectedEvent.details") {{selectedEvent.name}}
                          v-card-text.pt-1(v-if="selectedEvent.details")
                            v-card-text.pa-0(v-if="selectedEvent.details.full_text") {{selectedEvent.details.full_text}}
                            v-divider.my-2(v-if="selectedEvent.details.title && selectedEvent.details.text")
                            v-card-title.pa-0(v-if="selectedEvent.details.title") {{selectedEvent.details.title}}
                            v-card-text.pa-0(v-if="selectedEvent.details.text") {{selectedEvent.details.text}}
                          v-card-text(v-else)
                            v-card-text.pa-0(v-html="selectedEvent.name")
                            v-card-text.pa-0(v-if="selectedEvent.details" v-html="selectedEvent.details.full_text")
                          v-card-actions
                            v-btn(text small block color="secondary" @click="goToHomeworck(selectedEvent.id)") к заданию
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
  post_name: {
    name: "Домашнее задание",
    url: "homework_student",
    dop_com: [
      {
        url: "homework/:home_work_id",
        path: "js/views/homework-f/HomeWorkShowStudent"
      }
    ]
  },

  computed: {
    ...mapGetters(["user", "homework_list"]),
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
    this.loading = true;
    this.showLoading("Получение данных");
    //Получение данных
    await this.$store.dispatch(actions.ADD_CACHE_HOMEWORK_STUDENT, {
      context: this,
      id: this.user.student.group_id
    });
    this.closeLoading("Получение данных");
    this.loading = false;
  },

  data() {
    return {
      tabs: null,
      loading: false,
      search: null,
      selected_item: null,
      focus: null,
      events: [],
      type: "month",
      start: null,
      end: null,
      today: null,
      selectedEvent: {},
      selectedElement: null,
      selectedOpen: false,
      colors: [
        "indigo",
        "deep-purple",
        "cyan",
        "teal",
        "green",
        "deep-orange",
        "blue-grey"
      ],
      homework: null,
      types: ["Новость", "Домашнее задание", "Поэтапное задание", "Экзамен"]
    };
  },

  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    goToHomeworck(home_work_id) {
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
              id: element.home_work_id,
              name: element.title,
              start: this.formatDate(new Date(element_date), false),
              end: this.formatDate(new Date(element_date), false),
              color: new Date(element_date) <= new Date() ? "red" : this.colors[this.rnd(0, this.colors.length - 1)],
              details: {
                full_text: element.text,
                title: element.dates_homework[element_date].title,
                text: element.dates_homework[element_date].text
              }
            });
          });
        } else {
          events.push({
            id: element.home_work_id,
            name: element.title,
            start: this.formatDate(new Date(element.dates_homework), false),
            end: this.formatDate(new Date(element.dates_homework), false),
            color: new Date(element.dates_homework) <= new Date() ? "red" : this.colors[this.rnd(0, this.colors.length - 1)],
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
    }
  }
};
</script>