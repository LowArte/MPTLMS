<template lang="pug">
  v-content.ma-0.pa-0
        v-layout.column.wrap
          div(v-if="teacher_journals")
            v-flex.pa-3.mt-2
              v-card.mx-auto(raised  max-width="920px" min-width="300px")
                v-card-text Тут реализуются ваши журналы, к которым у вас есть или был доступ в течении учебного года.
            v-flex.pa-3.pt-1(v-for="(item, index) in teacher_journals" :key="index")
              v-alert.mx-auto.py-0.pt-1.pr-1(border="left" elevation="3" colored-border :color="item.isClose == null ? 'red' : item.isClose == 0 ? 'success' : 'yellow accent-4'"  max-width="920px" min-width="300px")
                v-system-bar.pl-0(color="white")
                  v-tooltip(bottom)
                    template(v-slot:activator="{ on }")
                      v-icon(small v-on="on") {{item.isClose == null ?  'mdi-lock' : 'mdi-clock'}}
                    span {{item.isClose == null ?  'Журнал закрыт' : 'Журнал доступен'}} 
                v-row(align="center")
                  v-col(class="grow")
                    span {{item.discipline}}
                    br
                    small {{item.group_name}}
                  v-col(class="shrink")
                      v-btn(small text color="success" @click="getJournalForGroupOfSubject(item.id)" :disabled="item.isClose == null") открыть
          v-flex.pa-3.pt-1(v-else)
            v-alert.mx-auto(border="left" elevation="3" type="warning"  max-width="920px" min-width="300px")
              span Для вас нет ни одного журнала. Возможно УМО не создал их для вас.
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as actions from "@/js/store/action-types";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_journal from "@/js/api/journal";

export default {
  post_name: {
    name: "Журнал преподавателя",
    url: "journal_teacher",
    dop_com: [
      {
        url: "group_journal/:journal_id",
        path: "js/views/journal-f/Journal"
      }
    ]
  },
  //?----------------------------------------------
  //!           Преднастройка
  //?----------------------------------------------
  //*Подключение вспомогательных компонентов
  mixins: [withOverlayLoading],
  computed: {
    ...mapGetters(["user", "teacher_journals"])
  },

  post_name: {
    name: "Журнал учителей",
    url: "journal_teacher"
  },

  data() {
    return {};
  },

  async beforeMount() {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.SET_JOURNAL_TEACHER, this.user.id);
    this.closeLoading("Получение данных");
  },
  //?----------------------------------------------
  //!           Методы страницы
  //?----------------------------------------------
  methods: {
    async getJournalForGroupOfSubject(id) {
      this.$router.push("group_journal/" + id);
    }
  }
};
</script>