<template lang="pug">
    v-content.ma-0.pa-0
        v-layout.column.wrap(v-if="groups_subjects")
            v-flex.pa-3
                v-card.mx-auto(raised max-width="920px" min-width="300px")
                    v-card-title {{groups_subjects.group_name}}
                    v-card-text В данном разделе вы можете создавать новые журналы для группы, а так же закрывать или открывать доступ к журналам для преподавателей.
                    v-card-actions
                        v-btn(small text dark color="success" @click="createJournal(groups_subjects)") новый журнал
                    c-create-journal-dialog(ref='create')
                    v-progress-linear(:active="loading" :indeterminate="loading" absolute bottom color="success")
            v-flex.pa-3.pt-1(v-if="groups_subjects.association" v-for="(item, index) in groups_subjects.association" :key="index")
                v-alert.mx-auto(border="left" elevation="3" color="primary" dark max-width="920px" min-width="300px")
                    v-system-bar(dark color="primary")
                        v-spacer
                        v-btn(x-small icon dark color="success" @click="closeJournal(item)")
                            v-icon {{!item.isClose ?  'mdi-lock-open-variant' : 'mdi-lock'}}
                    v-row(align="center")
                        v-col(class="grow")
                            span {{item.discip}}
                            br
                            small {{item.teacher}}
                        v-col(class="shrink")
                            router-link(class='nounderline' :to="'/' + user.post.slug + '/journal/subject'")
                                v-btn(small text dark color="success" @click="getJournalForGroupOfSubject(item.journal_id)") открыть
</template>

<script>
//?----------------------------------------------
//!           Подключение компонентов
//?----------------------------------------------
import CreateJournalDialog_С from "@/js/components/journal-f/CreateJournalDialog";

//?----------------------------------------------
//!           Vuex
//?----------------------------------------------
import { mapGetters } from "vuex";
import * as actions from "@/js/store/action-types";

import api_journal from "@/js/api/journal";

export default {
  components: {
    "c-create-journal-dialog": CreateJournalDialog_С
  },

  async beforeMount() {
    if (!this.groups_subjects)
      location.href = "/" + this.user.post.slug + "/journals";
  },

  computed: {
    ...mapGetters(["user", "groups_subjects"])
  },

  data() {
    return {
      loading: false
    };
  },

  methods: {
    async closeJournal(item) {
      await this.$store.dispatch(actions.CLOSE_JOURNAL, item);
    },

    async createJournal(item) {
      await this.$refs.create.pop(item).then(result => {
        if (result) {
          this.$store.dispatch(actions.CREATE_JOURNAL, result);
        }
      });
      this.$refs.create.$refs.form.reset();
      this.loading = !this.loading
      await this.$store.dispatch(actions.SET_GROUPS_FOR_UMO);
      await this.$store.dispatch(actions.UPDATE_JOURNAL, item.group_id);
      this.loading = !this.loading
    },

    async getJournalForGroupOfSubject(id) {
      await this.$store.dispatch(actions.SET_GROUP_JOURNAL, id);
    }
  }
};
</script>