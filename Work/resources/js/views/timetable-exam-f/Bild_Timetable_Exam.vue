<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="500px" scrollable)
        v-card.ma-0.pa-0
            v-system-bar
                span Формирование экзамена
            v-card-text
                v-combobox.mx-3.mt-6(dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-text="dep_name_full" :items="specialities" v-model="selected_department" )
                v-form.mx-3.mt-2(ref="form")
                    v-autocomplete(dense label="Группа" :rules="groupRules" :items="combo_groups" no-data-text="Нет данных" item-text="group_name" item-value="id" v-model="exam.group_id")
                    v-text-field(
                        v-model="exam.info.exam"
                        :rules="nameExamRules"
                        label="Название экзамена")
                    v-dialog(ref="dateDialog" v-model="model" :return-value.sync="exam.date" persistent width="290px")
                        template(v-slot:activator="{ on }")
                            v-text-field(v-model="exam.date" :rules="dateRules" label="Дата" readonly v-on="on")
                        v-date-picker(v-model="exam.date" scrollable :first-day-of-week="1" locale="ru-Ru")
                            v-btn(text color="primary" @click="model = false") Отмены
                            v-spacer
                            v-btn(text color="primary" @click="$refs.dateDialog.save(exam.date);") Принять
                    v-autocomplete(v-model="exam.info.teacher" label="Преподаватели" :items="teachers_combo" :rules="[TeacherRules.required]" no-data-text="Нет данных" item-value='id' item-text='fullFio' small-chips chips multiple)
                    v-text-field(hint="(ЧЧ:ММ-ЧЧ:ММ)"
                        v-model="exam.info.time"
                        v-mask="mask"
                        :rules="timeRules"
                        label="Начало/конец экзамена")
                    v-autocomplete(v-model="exam.place_id" label="Места проведения" :items="places" :rules="PlaceRules" no-data-text="Нет данных" item-value='id' item-text='place_name')
                    v-text-field(
                        v-model="exam.info.classroom"
                        :rules="classroomRules"
                        label="Кабинет")
 
            v-card-actions
                v-btn(color="accent darken-1" text @click="cancelExam") Отмена
                v-spacer
                v-btn(v-if="item == null" color="info darken-1" text @click="SaveExam") Сохранить       
                v-btn(v-else color="info darken-1" text @click="SaveExam") Редактировать       
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import { mask } from "vue-the-mask"; //Маска

import api_department from "@/js/api/department"; //Отделения
import api_teacher from "@/js/api/teacher"; //Api преподавателей
import api_place from "@/js/api/place"; //Api преподавателей

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
        ...mapGetters(["specialities", "groups_combo", "user", "teachers_combo", "places"]),
        combo_groups: function() {
            if (!this.groups_combo) return undefined;
            this.exam.group_id = this.groups_combo[0].id;
            return this.groups_combo;
        },
    },

    data() {
        return {
            dialog: false,
            selected_department: null,
            schedule: null,
            item: null,
            mask: "##:##-##:##", //Маска расписания экзамена
            resolve: null,
            exam:{
                date:null,
                info:{
                    time: null,
                    exam: null,
                    teacher: [],
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
            nameExamRules: [
                v => !!v || "Поле не должно оставаться пустым",
                v =>
                /^[A-Z && А-Я && a-z && а-я && 0-9 && / && -]*$/.test(v) ||
                "Только буквы, целочисленные значения (0-9) или символы ( / -)"
            ],
            TeacherRules: {
                required: value => {
                    return !!value.length || "Преподаватель не указан!";
                },
            },
            PlaceRules: [v => !!v || "Место проведения не указано!"],
        }
    },

    beforeMount()
    {
        this.getDepartments();
        this.getTeachers();
        this.getPlaces();
    },

    methods: {
//?----------------------------------------------
//!           Методы страницы
//?----------------------------------------------
        pop(item) {
            if(item)
            {
                this.item = item;
                this.exam = JSON.parse(JSON.stringify(item));
            }
            this.dialog = true;
            return new Promise((resolve, reject) => {
                this.resolve = resolve;
            });
        },
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

        //Получение всех преподавателей
        async getTeachers()
        {
            this.showLoading("Получение преподавателей");
            if(this.teachers_combo == null)
            {
                let items = await api_teacher.getTeachers(this);
                this.$store.commit(mutations.SET_TEACHERS_COMBO, items)
            }
            this.closeLoading("Получение преподавателей");
        },

        //Получение мест проведений
        async getPlaces()
        {
            this.showLoading("Получение мест проведения");
            if(this.places == null)
            {
                let items = await api_place.getPlaces(this);
                this.$store.commit(mutations.SET_PLACES_FULL, items)
            }
            this.closeLoading("Получение мест проведения");
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
        },

        async SaveExam()
        {
            if(this.$refs.form.validate())
            {   
                await this.resolve(JSON.parse(JSON.stringify(this.exam)));
                this.dialog = false;
                this.$refs.form.reset();
                this.exam.info = {
                    time: null,
                    exam: null,
                    teacher: [],
                    classroom: null
                };
            }
            else
                this.showError("Укажите корректные данные!");
        },

        async cancelExam()
        {
            this.dialog = false;
            this.$refs.form.reset();
            this.exam.info = {
                time: null,
                exam: null,
                teacher: [],
                classroom: null
            };
        }
    }
}
</script>