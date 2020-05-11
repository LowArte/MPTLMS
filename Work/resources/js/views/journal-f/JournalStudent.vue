<template lang="pug">
    v-content.ma-0.pa-0.mt-2
        v-layout.column.wrap
          div(v-if="groups_subgects")
            div(v-if="groups_subgects.length > 0")
              v-flex.pa-3.pt-1(v-if="item.teachers.length > 0" v-for="(item, index) in groups_subgects" :key="index")
                v-alert.mx-auto.py-0.pt-1.pr-1(border="left" elevation="3" colored-border :color="item.isClose == null ? 'red' : item.isClose == 0 ? 'success' : 'yellow accent-4'"  max-width="920px" min-width="300px")
                  v-system-bar.pl-0(color="white" v-if="item.isClose == null")
                    v-tooltip(bottom)
                      template(v-slot:activator="{ on }")
                        v-icon(small v-on="on") mdi-lock
                      span Журнал закрыт 
                  v-row(align="center")
                    v-col(class="grow")
                      span {{item.discipline}}
                      br
                      small {{item.teachers.join(" / ")}}
                    v-col(class="shrink")
                        v-btn(small text color="success" @click="getJournalForGroupOfSubject(item.id)" :disabled="item.isClose == null") открыть
            v-flex.pa-3.pt-1(v-else)
              v-alert.mx-auto(border="left" elevation="3" type="warning"  max-width="920px" min-width="300px")
                span Для группы нет ни одного журнала.
</template>

<script>
//?----------------------------------------------
//!           Подключение компонентов
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as actions from "@/js/store/action-types";

export default {
  mixins: [withSnackbar, withOverlayLoading],

  watch: {
    "$route.params.group_id": async function(group_id) {
      await this.$store.dispatch(actions.SET_GROUPS_SUBJECTS, {
        context: this,
        result: group_id
      });
    }
  },
  async beforeMount() {
    this.showLoading("Получение данных");
    await this.$store.dispatch(actions.SET_GROUPS_SUBJECTS, {
      context: this,
      result: this.user.student.group_id
    });
    this.closeLoading("Получение данных");
  },
  computed: {
    ...mapGetters(["user", "groups_subgects"]),
  },

  data() {
    return {
      loading: false
    };
  },

  methods: {
    async getJournalForGroupOfSubject(id) {
      this.$router.push("/" + this.user.post.slug + "/group_journal/" + id);
    }
  }
};
</script>