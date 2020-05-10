<template lang="pug">
  v-content.ma-0.pa-0
    v-layout.column.wrap(v-if="JournalOfSubject")
      v-card(:elevation="0" )
        v-card-actions
          v-btn(small text @click="JournalOfSubject = !JournalOfSubject") назад 
      c-journal-of-subjects
    v-layout.column.wrap(v-if="!JournalOfSubject")
      v-data-iterator.px-2(:items="groups_umo" :search="search" :items-per-page.sync="itemsPerPage" :page="page" hide-default-footer no-results-text="Не найдены данные, удовлетворяющие Вашему запросу. Попробуйте изменить запрос" no-data-text="")
        template(v-slot:header)
          v-flex
            v-card.mx-auto(raised min-width="300px" )
              v-card-actions
                v-col.py-1
                  v-row
                    v-text-field(hide-details dense v-model="search" prepend-icon="search" single-line label="Группа или специальность")
                  v-row(class="mt-2" align="center" justify="center")
                    span(class="grey--text") Кол-во 
                    v-menu(offset-y)
                      template(v-slot:activator="{ on }")
                        v-btn(text class="ml-1" v-on="on") {{ itemsPerPage }}
                          v-icon mdi-chevron-down
                      v-list
                        v-list-item(v-for="(number, index) in itemsPerPageArray" :key="index"  @click="updateItemsPerPage(number)")
                          v-list-item-title {{ number }}
                    v-spacer
                    span(class="mr-2 grey--text") {{ page }} из {{ numberOfPages }}
                    v-btn(icon x-small class="mr-1" @click="formerPage")
                      v-icon mdi-chevron-left
                    v-btn(icon x-small class="mr-1" @click="nextPage")
                      v-icon mdi-chevron-right
        template(v-slot:default="props")
          v-layout.row.wrap
            v-flex.pa-3(v-for="item in props.items" :key="item.name")
              v-card.mx-auto(raised max-width="320px")
                v-system-bar(dark color="primary")
                  span Учебные журналы по группе
                v-list-item(three-line)
                  v-list-item-content
                    v-list-item-title(class="headline mb-1") {{item.group_name}}
                    v-list-item-subtitle {{item.dep_name_full}}
                v-card-actions.pt-0
                  v-spacer
                  div
                    v-btn(block x-small text color="accent" @click="setGroupInformationToVuex(item); JournalOfSubject = true;") перейти к журналам
                  v-spacer  
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import JournalOfSubjects_С from "@/js/views/journal-f/JournalOfSubjects";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as actions from "@/js/store/action-types";

export default {
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withOverlayLoading],

  components:{
    "c-journal-of-subjects": JournalOfSubjects_С
  },

  computed: {
    ...mapGetters(["user", "groups_umo"]),
    numberOfPages() {
      return Math.ceil(this.groups_umo.length / this.itemsPerPage);
    }
  },

  data() {
    return {
      search: null,
      itemsPerPage: 16,
      itemsPerPageArray: [4, 8, 16, 32, 100],
      page: 1,
      JournalOfSubject: false
    };
  },

  async beforeMount()
  {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.SET_GROUPS_FOR_UMO);
    this.closeLoading("Получение данных");
  },

  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async setGroupInformationToVuex(item) {
      await this.$store.dispatch(actions.SET_GROUPS_SUBJECTS, item);
    },
    nextPage() {
      if (this.page + 1 <= this.numberOfPages) this.page += 1;
    },
    formerPage() {
      if (this.page - 1 >= 1) this.page -= 1;
    },
    updateItemsPerPage(number) {
      this.itemsPerPage = number;
    }
  }
};
</script>