<template lang="pug">
    v-content.ma-0.pa-2
        v-flex
            v-card.pb-2(v-if="user != null && user.post_id != null")
                v-system-bar(dark color="info")
                    span(style="color: white;") Формирование экзамена
                v-content.pa-1
                    router-link(class='nounderline' :to="'timetable_exam'") 
                        v-btn(color="accent" text block dark) Расписание эказаменов   
                v-autocomplete.mx-3.mt-6(dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-text="dep_name_full" :items="specialities" v-model="selected_department" )
                v-form.mx-3.mt-2(ref="form")
                    v-autocomplete(dense label="Группа" :rules="groupRules" :items="combo_groups" no-data-text="Нет данных" item-text="group_name" item-value="id" v-model="exam.group_id")
                    v-dialog(ref="dateDialog" v-model="model" :return-value.sync="exam.date" persistent width="290px")
                        template(v-slot:activator="{ on }")
                            v-text-field(v-model="exam.date" :rules="dateRules" label="Дата" readonly v-on="on")
                        v-date-picker(v-model="exam.date" scrollable :first-day-of-week="1" locale="ru-Ru")
                            v-btn(text color="primary" @click="model = false") Отмены
                            v-spacer
                            v-btn(text color="primary" @click="$refs.dateDialog.save(exam.date);") Принять
                    v-text-field(hint="(ЧЧ:ММ-ЧЧ:ММ)"
                        v-model="exam.info.time"
                        v-mask="mask"
                        :rules="timeRules"
                        label="Начало/конец экзамена")
                    v-text-field(
                        v-model="exam.info.classroom"
                        :rules="classroomRules"
                        label="Кабинет")    
                    v-btn.mt-2.justify-center(color="accent" block dark @click="SaveExam") Принять        
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import { mask } from "vue-the-mask"; //Маска

import api_department from "@/js/api/department"; //Отделения
import api_schedule_exam from "@/js/api/scheduleExam"; //Отделения

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
    //*Подключение вспомогательных компонентов
    mixins: [withSnackbar, withOverlayLoading],

    directives:
    {
        mask  //Маска
    },

    //*Вычисляемые свойства
    post_name: {
        name: "Конструктор расписания экзаменов",
        url: "bild_timetable_exam"
    },
    computed: {
        ...mapGetters(["specialities", "groups_combo", "user"]),
        combo_groups: function() {
            if (!this.groups_combo) return undefined;
            this.exam.group_id = this.groups_combo[0].id;
            return this.groups_combo;
        },
    },

    data() {
        return {
            selected_department: null,
            schedule: null,
            mask: "##:##-##:##", //Маска расписания экзамена
            exam:{
                date:null,
                info:{
                    time: null,
                    lesson: null,
                    teacher: null,
                    classroom: null
                },
                group_id: null,
                place_id:null
            },
            model: false,
            groupRules: [v => !!v || "Группа не указана!"],
            dateRules: [v => !!v || "Дата не указана!"],
            timeRules: [v => /^([01]\d|2[0-3]):?([0-5]\d)-?([01]\d|2[0-3]):?([0-5]\d)$/.test(v) || "Не соответствует формату времени"],
            classroomRules: [
                v => !!v || "Поле не должно оставаться пустым",
                v =>
                /^[A-Z && А-Я && a-z && а-я && 0-9 && / && -]*$/.test(v) ||
                "Только буквы, целочисленные значения (0-9) или символы ( / -)"
            ],
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
                this.exam.group_id = this.combo_groups[0].id;
        },

        async SaveExam()
        {
            if(this.$refs.form.validate())
            {   
                //if(await api_schedule_exam.saveScheduleExam(this.exam, _this))
                if(true)
                    this.$refs.form.reset();
            }
            else
                this.showError("Укажите корректные данные!");
        }
    }
}
</script>