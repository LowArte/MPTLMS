<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="600px")
        v-card
            v-system-bar(color="white")
              span Новое задание для групп
            v-progress-linear(:active="loading" :indeterminate="loading" absolute top  color="orange darken-1") 
            v-card-text.pt-2
                v-form(ref="form")
                  v-autocomplete(dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-value="id" item-text="dep_name_full" :items="specialities" v-model="selected_department_id")
                  v-autocomplete(v-if="selected_department_id" v-model="homework.groups_id" label="Группы" :items="groups" outlined dense no-data-text="Нет данных" item-value='id' small-chips chips multiple item-text='group_name' clearable)
                  v-autocomplete(:disabled="loading" v-model="homework.teachers" label="Соавторы" outlined dense :items="teachers_combo" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple clearable)
                  v-autocomplete(@change="type_change" item-value="id" item-text="name" :items="types" v-model="homework.type" dense label="Тип задания" no-data-text="Нет данных" )
                  v-text-field(v-model="homework.info.title" label="Название задания")
                  v-textarea( v-model="homework.info.text" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Описание" :row-height="24" :rows="3")
                  div(v-if="homework.type == 5")
                    
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
    ...mapGetters(["specialities", "groups_combo", "user", "teachers_combo"]),
  },
  data() {
    return {
      dialog: false,
      item: null,
      groups: null,
      selected_department_id: null,
      loading: false,
      types: [
        {id: 0, name: "Сообщение"},
        {id: 1, name: "Домашнее задание"},
        {id: 2, name: "Повременное домашнее задание"},
        {id: 3, name: "Курсовой проект"},
        {id: 4, name: "Дипломная работа"},
        {id: 5, name: "Экзамен"},
      ],
      homework: {
        user_id: null,
        groups_id: [],
        teachers: [],
        info: {
          title: null,
          text: null,
        },
        type: 0,
      },
    };
  },
  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async pop() 
    {
      this.dialog = true;

      return new Promise((resolve, reject) => {
        this.resolve = resolve;
      });
    },

    //Сохранение нового журнала
    async saveHomeWork() 
    {      
      if (this.$refs.form.validate()) 
      {
          this.dialog = false;
          this.alert = false;
          this.homework.user_id = this.user.id;
          this.resolve(this.homework);
      } else this.showError("Валидация не пройдена");
    },
  //?----------------------------------------------
  //!           Работа с дополнительными данными
  //?----------------------------------------------
    async department_change()
    {
      this.loading = true;
      this.showLoading("Получение групп");
      await this.$store.dispatch(actions.ADD_CACHE_GROUP_DATA, 
      {
        context: this,
        result: this.selected_department_id
      });
      this.closeLoading("Получение групп");

      this.groups = this.groups_combo;
      this.loading = false;
    },
   
    type_change()
    {
      let title = this.homework.info.title;
      let text = this.homework.info.text;

      switch (this.homework.type) {
        case 0:
          this.homework.info = {
            title: title,
            text: text,
          }
          break;
        case 1:
          this.homework.info = {
            title: title,
            text: text,
          }
          break;
        case 2:
          this.homework.info = {
            title: title,
            text: text,
          }
          break;
        case 3:
          this.homework.info = {
            title: title,
            text: text,
          }
          break;
        case 4:
          this.homework.info = {
            title: title,
            text: text,
          }
          break;
        case 5:
          this.homework.info = {
            title: title,
            text: text,
          }
          break;
        default:
          this.homework.info = {
            title: title,
            text: text,
          }
          break;
      }
    }
  },
};
</script>