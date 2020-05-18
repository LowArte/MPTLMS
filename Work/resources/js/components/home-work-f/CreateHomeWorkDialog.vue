<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="600px")
        v-card(scrollable)
            v-system-bar(color="white")
              span Новое задание для групп
            v-progress-linear(:active="loading" :indeterminate="loading" absolute top  color="orange darken-1") 
            v-card-text.pt-2
                v-form(ref="form")
                  v-autocomplete(outlined dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-value="id" item-text="dep_name_full" :items="specialities" v-model="selected_department_id")
                  v-autocomplete(:disabled="selected_department_id ? false : true" v-model="homework.groups_id" label="Группы" :items="groups" outlined dense no-data-text="Нет данных" item-value='id' small-chips chips multiple item-text='group_name' clearable)
                  v-autocomplete(:disabled="loading" v-model="homework.teachers" label="Соавторы" outlined dense :items="getTeacher" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple clearable)
                  v-autocomplete(outlined dense @change="type_change" item-value="id" item-text="name" :items="types" v-model="homework.type" label="Тип задания" no-data-text="Нет данных" )
                  v-text-field(outlined dense v-model="homework.info.title" label="Название задания")
                  v-textarea(outlined v-model="homework.info.text" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Описание" :row-height="24" :rows="3")
                  div(v-if="homework.type == 1")
                    v-menu(ref="menu1" v-model="menu_homework1" :close-on-content-click="false" transition="scale-transition" offset-y min-width="290px")
                      template(v-slot:activator="{ on }")
                        v-text-field(outlined dense v-model="homework.info.date" label="Период выполнения домашнего задания" prepend-icon="event" readonly v-on="on")
                      v-date-picker(v-model="homework.info.date" no-title scrollable :first-day-of-week="1" locale="ru-Ru")
                        v-btn(text color="primary" @click="menu_homework = false") Отмена
                        v-btn(text color="primary" @click="$refs.menu1.save(homework.info.date)") Применить
                  div(v-if="homework.type == 2")
                    v-menu(ref="menu2" v-model="menu_homework2" :close-on-content-click="false" transition="scale-transition" offset-y min-width="290px")
                      template(v-slot:activator="{ on }")
                        v-combobox(outlined dense v-model="dates_homework" multiple chips small-chips label="Период выполнения домашнего задания" prepend-icon="event" readonly v-on="on")
                      v-date-picker(multiple v-model="dates_homework" no-title scrollable :first-day-of-week="1" locale="ru-Ru")
                        v-btn(text color="primary" @click="changeDateForTypeTwo(dates_homework);") применить
                    div(v-for="(item, date) in homework.info.date" :key="date")
                      span {{date}}
                      v-text-field(outlined dense v-model="item.title" label="Название задания")
                      v-textarea(outlined v-model="item.text" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Описание" :row-height="24" :rows="3")
                  div(v-if="homework.type == 3")
                    v-menu(ref="menu3" v-model="menu_homework3" :close-on-content-click="false" transition="scale-transition" offset-y min-width="290px")
                      template(v-slot:activator="{ on }")
                        v-text-field(outlined dense v-model="homework.info.date" label="Период выполнения домашнего задания" prepend-icon="event" readonly v-on="on")
                      v-date-picker(v-model="homework.info.date" no-title scrollable :first-day-of-week="1" locale="ru-Ru")
                        v-btn(text color="primary" @click="menu_homework = false") Отмена
                        v-btn(text color="primary" @click="$refs.menu3.save(homework.info.date)") Применить
                    v-autocomplete(v-model="homework.info.place_id" label="Место проведения" :items="places" no-data-text="Нет данных" item-value='id' item-text='place_name')
                    v-text-field( v-model="homework.info.classroom" label="Кабинет")
            v-card-actions
                v-btn(small text dark color="red" @click="dialog = !dialog") отмена
                v-spacer
                v-btn(small text dark color="success" @click="saveHomeWork" :loading="loading" :disabled="loading") сохранить
                
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           api
//?----------------------------------------------

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withOverlayLoading, withSnackbar],

  computed: {
    ...mapGetters(["specialities", "groups_combo", "user", "teachers_combo", "places"]),
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
      dialog: false,
      menu_homework1: false,
      menu_homework2: false,
      menu_homework3: false,
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
        info: {
          title: null,
          text: null,
          date: null,
          place_id: null,
          classroom: null
        },
        type: 0
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
      this.$forceUpdate();
    },

    changeDateForTypeTwo(dates_homework) {
      this.$refs.menu2.save(dates_homework);
      this.homework.info.date = {};
      dates_homework = this.sortByDate(dates_homework);
      dates_homework.forEach(element => {
        this.homework.info.date[element] = { title: null, text: null };
      });
    },
    //Сортировка по дате
    sortByDate(arr) {
      return arr.sort((a, b) => (a > b ? 1 : -1));
    },
  }
};
</script>