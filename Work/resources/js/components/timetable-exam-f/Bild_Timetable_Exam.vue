<template lang="pug">
    v-dialog(v-model="dialog" persistent max-width="500px" scrollable)
        v-card.ma-0.pa-0
            v-system-bar
                span Формирование экзамена
            v-card-text
                v-form(ref="form")
                    v-autocomplete.mt-2(outlined dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-value="id" item-text="dep_name_full" :items="specialities" v-model="selected_department_id" :rules="DepartmentRules")
                    v-autocomplete(:disabled="selected_department_id ? false : true" v-model="homework.groups_id" :label="'Группы (' + homework.groups_id.length + ')'" :items="groups" outlined dense no-data-text="Нет данных" item-value='id' small-chips chips multiple item-text='group_name' clearable :rules="[GroupRules.required]")
                    v-autocomplete(:disabled="loading" v-model="homework.user_id" label="Преподаватель" :rules="TeacherRules" outlined dense :items="teachers_combo" no-data-text="Нет данных" item-value='id' item-text='fullFio')
                    v-text-field(outlined dense v-model="homework.info.title" label="Название экзамена" :rules="TitleRules")
                    v-textarea(outlined v-model="homework.info.text" :rules="TextRules" :auto-grow="true" :counter="255 ? 255 : false" flat :hint="'Не более 255 символов'" label="Описание" :row-height="24" :rows="3")
                    v-date-picker.mb-3(:min='new Date().toISOString().substr(0, 10)' full-width v-model="homework.info.date" no-title :first-day-of-week="1" locale="ru-Ru")
                    v-autocomplete(outlined dense v-model="homework.info.place_id" label="Место проведения" :rules="PlacesRules" :items="places" no-data-text="Нет данных" item-value='id' item-text='place_name')
                    v-text-field(outlined dense v-model="homework.info.classroom" label="Кабинет")
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
    },

    data() {
        return {
            dialog: false,
            item: null,
            resolve: null,
            dialog: false,
            drop_menu_date_picker_event_tow: false,
            dates_homework: [],
            item: null,
            groups: null,
            selected_department_id: null,
            loading: false,
            homework: {
                user_id: null,
                groups_id: [],
                teachers: [],
                info: {
                    title: null,
                    text: null,
                    date: null,
                    place_id: null,
                    classroom: null
                },
                type: 3
            },
            model: false,
            DepartmentRules: [
                value => !!value || "Данное поле не должно оставаться пустым"
            ],
            TitleRules: [
                value => !!value || "Данное поле не должно оставаться пустым"
            ],
            TextRules: [
                value => !!value || "Данное поле не должно оставаться пустым"
            ],
            PlacesRules: [
                value => !!value || "Данное поле не должно оставаться пустым"
            ],
            GroupRules: {
                required: value => {
                return !!value.length || "Данное поле не должно оставаться пустым";
                }
            },
            TeacherRules: [
                value => !!value || "Данное поле не должно оставаться пустым"
            ],
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
        pop(item) 
        {
            if(item)
            {
                let items = item;
                this.homework = JSON.parse(JSON.stringify(items));
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
                let items = await api_department.getDepartments();
                this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);
                this.closeLoading("Получение отделений");
            }

            if (this.specialities) 
            {
                this.selected_department_id = this.specialities[0].id;
                this.department_change();
            }
        },

        //Получение всех преподавателей
        async getTeachers()
        {
            this.showLoading("Получение преподавателей");
            if(this.teachers_combo == null)
            {
                let items = await api_teacher.getTeachers();
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
                let items = await api_place.getPlaces();
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
                result: this.selected_department_id
            });
            this.groups = this.groups_combo;
            this.closeLoading("Получение групп");
        },

        async SaveExam()
        {
            if(this.$refs.form.validate())
            {   
                await this.resolve(JSON.parse(JSON.stringify(this.homework)));
                this.dialog = false;
                this.$refs.form.reset();
                this.homework.info = {
                    user_id: null,
                    groups_id: [],
                    teachers: [],
                    info: {
                        title: null,
                        text: null,
                        date: null,
                        place_id: null,
                        classroom: null
                    },
                    type: 3
                };
            }
            else
                this.showError("Укажите корректные данные!");
        },

        async cancelExam()
        {
            this.dialog = false;
            this.$refs.form.reset();
            this.homework.info = {
                user_id: null,
                groups_id: [],
                teachers: [],
                info: {
                    title: null,
                    text: null,
                    date: null,
                    place_id: null,
                    classroom: null
                },
                type: 3
            };
        }
    }
}
</script>