<template lang="pug">
  v-content.ma-0.pa-0
    v-layout.column.wrap
      v-data-iterator.px-2(v-if="groups_journal" :items="groups_journal" :search="search" :items-per-page.sync="itemsPerPage" :page="page" hide-default-footer no-results-text="Не найдены данные, удовлетворяющие Вашему запросу. Попробуйте изменить запрос" no-data-text="")
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
                v-system-bar(color="white")
                  span Учебные журналы по группе
                v-list-item(three-line)
                  v-list-item-content
                    v-list-item-title(class="headline mb-1") {{item.group_name}}
                    v-list-item-subtitle {{item.dep_name_full}}
                    v-list-item-subtitle Курс: {{item.curs}}
                v-card-actions.pt-0
                    v-btn(block x-small text color="success" @click="goingOpenJournalsGroups(item)") перейти к журналам
      v-alert.mx-auto(v-else border="left" elevation="3" type="error"  max-width="920px" min-width="300px")
        span Данные журналов не могут быть загружены. Возможно отсутствуют запрашиваемые данные.
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";

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
  post_name: {
    name: "Журнал учебной части",
    url: "journal_unit",
    dop_com: [
      {
        url: "journal/:group_id",
        path: "js/views/journal-f/JournalOfSubjects"
      },
      {
        url: "group_journal/:journal_id",
        path: "js/views/journal-f/Journal"
      }
    ]
  },
  computed: {
    ...mapGetters(["user", "groups_journal"]),
    numberOfPages() {
      return Math.ceil(this.groups_journal.length / this.itemsPerPage);
    }
  },

  data() {
    return {
      search: null,
      itemsPerPage: 16,
      itemsPerPageArray: [4, 8, 16, 32, 100],
      page: 1
    };
  },

  async beforeMount() {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.SET_JOURNALS_GROUPS);
    this.closeLoading("Получение данных");
  },

  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async goingOpenJournalsGroups(item) {
      this.$router.push("journal/" + item.group_id);
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