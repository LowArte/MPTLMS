<template lang="pug">
    v-content.ma-0.pa-2
        v-flex
            v-card(v-if="user != null && user.post_id != null")
                v-system-bar(dark color="info")
                    span(style="color: white;") Фильтры
                v-combobox.mx-3.mt-6(dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-text="dep_name_full" :items="specialities" v-model="selected_department" )
                v-combobox.mx-3.mt-2(dense label="Группа" no-data-text="Нет данных" @change="group_change" item-text="group_name" :items="combo_groups" v-model="selected_group")
                v-content.pa-1
                    router-link(v-if="user.post_id == 1 || user.post_id == 4" class='nounderline' :to="'bild_timetable_exam'") 
                        v-btn(color="accent" text block dark) Конструктор расписания экзаменов    
    
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка

import api_department from "@/js/api/department"; //Отделения

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
    //*Подключение вспомогательных компонентов
    mixins: [withSnackbar, withOverlayLoading],

    //*Вычисляемые свойства
    post_name: {
        name: "Расписание экзаменов",
        url: "timetable_exam"
    },
    computed: {
        ...mapGetters(["specialities", "groups_combo", "user"]),
        combo_groups: function() {
            if (!this.groups_combo) return undefined;
            this.selected_group = this.groups_combo[0];
            return this.groups_combo;
        },
    },

    data() {
        return {
            selected_department: null,
            selected_group: null,
            schedule: null,
            dateDialog: {
                model: false,
                date: new Date().toISOString().substr(0, 10)
            } //Диалог даты
        }
    },

    beforeMount()
    {
        this.getDepartments();
    },
    methods: {
//?----------------------------------------------
//!           Методы страницы
//?----------------------------------------------
        //*Получение отделений для выпадающего списка
        async getDepartments()
        {
            if (!this.specialities) {
                this.showLoading("Получение отделений");
                let items = await api_department.getDepartments(this);
                this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);
                this.closeLoading("Получение отделений");
            }

            if (this.specialities) 
            {
                this.selected_department = this.specialities[0];
                this.department_change();
            }
        },
//?----------------------------------------------
//!           Методы компонентов
//?----------------------------------------------
        //Получение группы при изменении отделения
        async department_change() 
        {
            this.showLoading("Получение групп");
            await this.$store.dispatch(actions.ADD_CACHE_GROUP_DATA, 
            {
                context: this,
                result: this.selected_department.id
            });
            this.closeLoading("Получение групп");

            if (this.combo_groups) 
            {
                this.selected_group = this.combo_groups[0];
                if(this.selected_group)
                    this.group_change();
            }
        },

        //*Получение расписания при изменении выбранной группы
        async group_change() 
        {
        
        },

        async caseDate()
        {
            
        }
    }
}
</script>