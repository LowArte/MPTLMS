<template lang="pug">
    v-content.ma-0.pa-0
        v-layout.column.wrap
            v-flex(v-if="groups_subgects")
                v-card.mx-auto.pa-2(raised dark min-width="300px")
                    v-combobox(:items="[1,2]" v-model="selected_semester" label="Семестр" outlined dense)
        v-layout.row.wrap(v-if="selected_semester")
            v-flex.mt-2(v-for="(journal, i) in groups_subgects" :key="i" v-if="journal.journal[selected_semester]")
                v-card
                    v-system-bar.pl-0(color="info")
                        span(style="color: white;") {{journal.discipline}}
                    v-simple-table(dark fixed-header)
                        template( v-slot:default)
                            thead(v-if="groups_subgects")
                                th(class="text-center" v-for="(item, j) in journal.journal[selected_semester]" :key="item.key") {{item.date}}
                            tbody(v-if="groups_subgects")
                                tr
                                    td(class="text-center" v-for="ozenka in journal.journal[selected_semester]" :key="journal.key")
                                        v-card-text(small text outlined :color="ozenka.students[user.student.id] == '2' ? 'red' : ozenka.students[user.student.id] == '3' ? 'orange' : ozenka.students[user.student.id] == '4' ? 'light-green' : ozenka.students[user.student.id] == '5' ? 'green' : 'white'") {{ozenka.students[user.student.id]}}
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
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
    //*Подключение вспомогательных компонентов
    mixins: [withOverlayLoading, withSnackbar],
    computed: {
    ...mapGetters(["user", "groups_subgects"]),
  },

    data(){
        return{
            journal: null,
            selected_semester: null
        }
    },

    async beforeMount()
    {
        this.showLoading("Получение данных");
        await this.$store.dispatch(actions.SET_GROUPS_SUBJECTS, {
            context: this,
            result: this.user.student.group_id
        });
        this.closeLoading("Получение данных");
    },
//?----------------------------------------------
//!           Методы страницы
//?----------------------------------------------
    methods:{

    }
}
</script>