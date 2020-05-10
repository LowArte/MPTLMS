<template lang="pug">
    v-content.ma-0.pa-0
        v-layout.column.wrap
          v-flex.pa-3
              v-card.mx-auto(raised max-width="920px" min-width="300px")
                v-card-title(v-if="groups_journal.length > 0 && getCursAndDepId") {{getCursAndDepId.group_name}}
                v-card-text В данном разделе вы можете создавать новые журналы для группы, а так же закрывать или открывать доступ к журналам для преподавателей.
                v-card-actions
                  v-btn(small text dark color="success" @click="createJournal()") новый журнал
                  v-btn(small text dark color="red" @click="createJournal()") закрыть все
                c-create-journal-dialog(ref='create')
                v-progress-linear(:active="loading" :indeterminate="loading" absolute bottom color="success")
          div(v-if="groups_subgects")
            div(v-if="groups_subgects.length > 0")
              v-flex.pa-3.pt-1(v-for="(item, index) in groups_subgects" :key="index")
                v-alert.mx-auto.py-0.pt-1.pr-1(border="left" elevation="3" colored-border :color="item.isClose == null ? 'red' : item.isClose == 0 ? 'success' : 'yellow accent-4'"  max-width="920px" min-width="300px")
                  v-system-bar.pl-0(color="white")
                    div(v-if="item.teachers.length == 0")
                      v-icon(color="red") mdi-alert
                      span отсутсвует преподаватель
                    v-tooltip(bottom)
                      template(v-slot:activator="{ on }")
                        v-icon(v-if="item.teachers.length != 0"  small v-on="on") {{item.isClose == null ?  'mdi-lock' : 'mdi-clock'}}
                      span {{item.isClose == null ?  'Журнал закрыт' : 'Журнал досрупен для преподавателей'}} 
                    v-spacer
                    v-menu(bottom origin="center center" transition="slide-y-transition")
                      template(v-slot:activator="{ on }")
                        v-btn(x-small icon color="success" v-on="on")
                          v-icon mdi-chevron-down
                      v-list(dense)
                        v-list-item(@click="")
                          v-list-item-icon
                            v-icon(small) mdi-lock
                          v-list-item-content
                            v-list-item-title Закрыть
                        v-list-item(@click="")
                          v-list-item-icon
                            v-icon(small) mdi-lead-pencil
                          v-list-item-content
                            v-list-item-title Редактировать
                  v-row(align="center")
                    v-col(class="grow")
                      span {{item.discipline}}
                      br
                      small {{item.teachers.join(" / ")}}
                    v-col(class="shrink")
                        v-btn(small text dark color="success" @click="getJournalForGroupOfSubject(item.journal_id)") открыть
            v-flex.pa-3.pt-1(v-else)
              v-alert.mx-auto(border="left" elevation="3" type="warning"  max-width="920px" min-width="300px")
                span Для группы нет ни одного журнала. Чтобы тут отобразились журналы, создайте их или загрузите соответствующие выписки из учебного плана.
</template>

<script>
//?----------------------------------------------
//!           Подключение компонентов
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";
import CreateJournalDialog_С from "@/js/components/journal-f/CreateJournalDialog";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as actions from "@/js/store/action-types";

export default {
  mixins: [withSnackbar, withOverlayLoading],

  components: {
    "c-create-journal-dialog": CreateJournalDialog_С
  },
  watch: {
    "$route.params.group_id": async function(group_id) {
      await this.$store.dispatch(actions.SET_GROUPS_SUBJECTS, {
        context: this,
        result: group_id
      });
    }
  },
  async beforeMount() {
    if(this.groups_journal.length == 0)
      await this.$store.dispatch(actions.SET_JOURNALS_GROUPS)
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.SET_GROUPS_SUBJECTS, {
      context: this,
      result: this.$route.params.group_id
    });
    this.closeLoading("Получение данных");
  },
  computed: {
    ...mapGetters(["user", "groups_subgects", "groups_journal"]),
    getCursAndDepId: function() {
      let group = null;
      this.groups_journal.forEach(element => {
        if(element.group_id == this.$route.params.group_id)
          group = element;            
      });
      return group;
    }
  },

  data() {
    return {
      loading: false
    };
  },

  methods: {
    async closeJournal(item) {},

    async createJournal() {
      await this.$refs.create.pop(this.getCursAndDepId).then(() => {});
      this.$refs.create.$refs.form.reset();
    },

    async getJournalForGroupOfSubject(id) {

    }
  }
};
</script>