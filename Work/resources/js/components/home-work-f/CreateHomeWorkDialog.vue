<template lang="pug">
    v-dialog(v-model="dialog" persistent fullscreen hide-overlay)
        v-card(scrollable)
            v-system-bar(color="white")
              span Конструктор задания
              v-spacer
              v-btn(text dark x-small color="orange darken-1" @click="dialog = !dialog") отмена
            v-progress-linear(:active="loading" :indeterminate="loading" absolute top  color="orange darken-1") 
            v-card-text.pt-2
                v-form(ref="form")
                  v-autocomplete(outlined dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-value="id" item-text="dep_name_full" :items="specialities" v-model="selected_department_id" :rules="DepartmentRules")
                  v-autocomplete(:disabled="selected_department_id ? false : true" v-model="homework.groups_id" :label="'Группы (' + homework.groups_id.length + ')'" :items="groups" outlined dense no-data-text="Нет данных" item-value='id' small-chips chips multiple item-text='group_name' clearable :rules="[GroupRules.required]")
                  v-autocomplete(:disabled="loading" v-model="homework.teachers" label="Соавторы" outlined dense :items="getTeacher" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple clearable)
                  v-autocomplete(outlined dense @change="type_change" item-value="id" item-text="name" :items="types" v-model="homework.type" label="Тип задания")
                  v-text-field(outlined dense v-model="homework.info.title" label="Название (основное)" :rules="TitleRules")
                  v-textarea(outlined v-model="homework.info.text" :rules="TextRules" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Описание (основное)" :row-height="24" :rows="3")
                  v-item-group
                    v-item(v-if="homework.type == 1")
                        v-date-picker( :min='new Date().toISOString().substr(0, 10)' full-width v-model="homework.info.date" no-title :first-day-of-week="1" locale="ru-Ru")
                    v-item(v-if="homework.type == 2")
                      div
                        v-menu(ref="multi_homework" v-model="drop_menu_date_picker_event_tow" :close-on-content-click="false" transition="scale-transition" offset-y min-width="290px")
                          template(v-slot:activator="{ on }")
                            v-combobox(outlined dense v-model="dates_homework" multiple chips small-chips label="Даты этапов выполнения работы" prepend-icon="event" readonly v-on="on")
                          v-date-picker(:min='new Date().toISOString().substr(0, 10)' multiple v-model="dates_homework" no-title :first-day-of-week="1" locale="ru-Ru")
                            v-btn(text color="primary" @click="drop_menu_date_picker = !drop_menu_date_picker") Отмена
                            v-btn(text color="orange darken-1" @click="changeDateForTypeTwo(dates_homework)") Применить
                        div(v-for="(item, date) in homework.info.date" :key="date")
                          v-card.pa-2.ma-3(outlined :elevation="0")
                            span {{date}}
                            v-text-field(outlined dense v-model="item.title" :rules="InsideTileRules" label="Название этапа")
                            v-textarea(outlined v-model="item.text" :rules="InsideTextRules" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Описание этапа" :row-height="24" :rows="3")
                            v-card-actions
                              v-btn(text color="orange darken-1") Прикрепить документы
                    v-item(v-if="homework.type == 3")
                      div
                        v-date-picker.mb-3(:min='new Date().toISOString().substr(0, 10)' full-width v-model="homework.info.date" no-title :first-day-of-week="1" locale="ru-Ru")
                        v-autocomplete(outlined dense v-model="homework.info.place_id" label="Место проведения" :rules="PlacesRules" :items="places" no-data-text="Нет данных" item-value='id' item-text='place_name')
                        v-text-field(outlined dense v-model="homework.info.classroom" label="Кабинет")
            v-card-actions
                v-spacer
                v-btn(small text dark color="orange darken-1" @click="dialog = !dialog") отмена
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
    //?----------------------------------------------
    //!           Дополнительные методы
    //?----------------------------------------------
    //Сортировка по дате
    sortByDate(arr) {
      return arr.sort((a, b) => (a > b ? 1 : -1));
    },

    blockSundey()
    {
      let dateSundey = [];
      let thisDate = new Date();
      let i = 0;
      for (let index = 0; index < 360; index++) 
      {
        if(new Date(thisDate).getDay() == 0)
        {
          dateSundey.push(new Date(thisDate).toISOString().substr(0, 10));
          console.log(dateSundey);
        }

        if(dateSundey.length == 0)
          thisDate.setDate(new Date(thisDate).getDate()+1);
        else
          thisDate.setDate(new Date(thisDate).getDate()+7);
        
      }
      return dateSundey;
    }
  }
};
</script>