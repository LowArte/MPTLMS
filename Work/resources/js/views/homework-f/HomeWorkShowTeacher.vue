<template lang="pug">
  v-content(max-width="816px").ma-0.pa-0
    v-layout.column.wrap
      v-flex
        v-card(v-if="homework" flat)
          v-tabs(v-model="tabs" centered slider-color="orange darken-1")
            v-tab Задание
            v-tab Прогресс выполнения задания
            v-tab Доступ
            v-tab Доступные журналы
          v-tabs-items(v-model="tabs")
            v-tab-item
              div.pa-3(class="order-1 d-flex flex-wrap justify-center")
                div.ma-2(class="d-flex justify-end")
                  v-card(max-width="366" min-width="300")
                    v-card-title Инструменты
                    v-card-text Тут отображаются доступные вам инструменты для работы с данным ресурсом
                    v-card-actions
                      v-btn(small text color="orange darken-1") Удалить задание
                      v-spacer
                      v-btn(icon small :color="!editable ? 'red' : 'grey darken-1'" @click="editable = !editable")
                        v-icon edit
                div.ma-2(class="order-0 d-flex justify-start")
                  v-card(max-width="450" min-width="300")
                    v-card-title.pb-2 {{homework.info.title}}
                    v-card-text {{homework.info.text}}
                    v-card-text.pb-0 Создано: {{homework.date}}
              v-layout.row.wrap(v-if="homework && homework.type == 2")
                v-flex
                  v-card.mx-auto.pa-1(flat max-width="832px" min-width="300px")
                    v-stepper.pb-2.pt-2(v-model="steps_count" vertical)
                      span.pa-3.mt-2(v-if="!editable" style="color: red") Внимание: Активен режим редактирования
                      div(v-for="(item, index, i) in homework.info.date" :key="index")
                        v-stepper-step(color="orange darken-1"  :step="i + 1" :complete="new Date(index) < new Date().toISOString().substr(0, 10) ? true : false" @click="steps_count = i + 1") {{item.title}} | {{index}}
                        v-stepper-content(:step="i + 1") 
                          v-textarea.mt-3(:disabled="editable" outlined v-model="item.text" :rules="InsideTextRules" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Задание этапа" :row-height="24" :rows="3")
                      v-card-actions(v-if="!editable")
                        v-btn(small text color="success") Сохранить изменения
            v-tab-item
                p Тут будет прогресс выполнения задания и личные комментарии
            v-tab-item
                p Доступ
            v-tab-item
                p Доступные журналы
        v-card(v-else flat)
            v-alert.mx-auto(border="left" elevation="3" type="warning"  max-width="920px" min-width="300px")
                span Выбранное задание не доступно!
        v-card(flat)
            p {{homework}}
            p {{tabs}}
                        
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
    url: "homework/:homework_id"
  },

  watch: {
    "$route.params.homework_id": async function(homework_id) {
      this.update(homework_id);
    }
  },

  computed: {
    ...mapGetters(["user"])
  },

  async beforeMount() {
    this.showLoading("Получение данных");
    await this.update(this.$route.params.homework_id);
    this.closeLoading("Получение данных");
  },

  data() {
    return {
      tabs: null,
      homework: null,
      editable: true,
      types: ["Новость", "Домашнее задание", "Поэтапное задание", "Экзамен"],
      steps_count: 1,
      InsideTextRules: [
        value => !!value || "Данное поле не должно оставаться пустым"
      ]
    };
  },

  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async update(id) {
      if (id) this.homework = await api_homework.getHomeWorkById(id);
    }
  }
};
</script>