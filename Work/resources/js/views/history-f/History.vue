<template lang="pug">
  v-content.ma-0.pa-2
    v-layout.row.wrap
      v-card.mx-auto(height='auto' width='100%')
        v-system-bar(color="info" dark)
          span История системы
        v-data-table.elevation-0.pa-0.ma-0(:headers="headers"  show-expand :expanded.sync="expanded" single-expand v-if="history" :items="history"  :search="search" item-key="id" no-results-text='Данные отсутствуют' no-data-text='Данные отсутствуют' :page.sync="page" hide-default-footer @page-count="pageCount = $event" :items-per-page="itemsPerPage")
          template(v-slot:top)
            v-tooltip(bottom)
              template(v-slot:activator="{ on }")
                v-btn.ma-2.ml-1(text v-on="on" @click="update(false)")
                  v-icon replay
                  span.ma-2 Обновить
            v-text-field.ma-0.pa-3.single-line.hide-details(v-model="search" label="Поиск" dense outlined prepend-inner-icon="search" clearable)
          template(v-slot:expanded-item="{ headers, item }")
            td(:colspan="headers.length") 
              div(v-if="item.meta")
                div(v-for="(met,i) in item.meta" :key="i")
                  span 
                    strong Ключ 
                    | {{met.key}}
                  br
                  span 
                    strong Было: 
                    | {{met.old}}
                  br
                  span 
                    strong Стало: 
                    | {{met.new}}
              div(v-else)
                span Нет дополнительной информации
        v-layout.row.text-center.pa-2.ma-2
          v-pagination(v-model="page" :length="pageCount")
</template>

<script>
//?----------------------------------------------
//!           Подключение системных комопнентов
//?----------------------------------------------
import * as actions from "@/js/store/action-types";
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

//?----------------------------------------------
//!           Подключение Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";

export default {
  post_name: {
    name: "История системы",
    url: "history"
  },
  mixins: [withOverlayLoading],
  data: () => ({
    expanded: [],
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 30, //Количество отображаемых строк
    pageCount: 0, //Количество страниц
    headers: [
      { text: "#", value: "id" },
      { text: "Действие", value: "message" },
      { text: "Пользователь", value: "user.not_short_fio" },
      { text: "Время", value: "performed_at" },
      { text: "Информация", value: "data-table-expand" },
    ]
  }),
  computed: mapGetters(["history"]),
 beforeMount() {
    this.update()
  },
  methods:{
    async update(isNeedCheck = true){
      this.showLoading("Получение истории");
      if(!this.history || !isNeedCheck)
      {
        await this.$store.dispatch(actions.SET_HISTORY)
        console.log(this.history)
      }

      this.closeLoading("Получение истории");
    }
  }
};
</script>