<template lang="pug">
    v-content.ma-0.pa-0
        v-layout.column.wrap
            v-flex(v-if="journal")
                p {{journal}}
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

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_journal from "@/js/api/journal";

export default {
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
    //*Подключение вспомогательных компонентов
    mixins: [withOverlayLoading],
    computed: {
        ...mapGetters(["user"]),
    },

    data(){
        return{
            journal: null,
        }
    },

    async beforeMount()
    {
        //this.journal = await api_journal.get();
    },
//?----------------------------------------------
//!           Методы страницы
//?----------------------------------------------
    methods:{

    }
}
</script>