<template lang="pug">
    v-content.ma-0.pa-2
        v-layout.column.wrap
            v-flex
                v-card(min-width="300px" v-if="user != null && user.post_id != null")
                  v-autocomplete.pa-3.pt-4(outlined dense v-model="teacher_id" label="Преподаватели" :items="teachers" @change="teacher_change()" no-data-text="Нет данных" item-value='id' item-text='fio')
            v-chip.ma-1(min-width="300px" label :color="isChisl ? 'info' : 'accent'") {{!isChisl ? "Числитель" : "Знаменатель"}}
        v-layout.row.wrap
            v-flex(v-if="filterSchedule")
                v-card.mx-auto(min-width="300px")
                    v-system-bar(:color="isChisl ? 'info' : 'accent'" dark)
                        span {{days[(new Date()).getDay() + 1]}}
                        v-spacer
                        v-btn(x-small text dark) очистить
                    v-alert.ma-2(type="warning" border="left" dense colored-border elevation="2") Если необходимо указать несколько аудиторий для группы, используйте символ <kbd> / </kbd> чтобы визуально разделить новера аудиторий.
                    v-expansion-panels(v-if="isChisl" flat popout)
                        v-expansion-panel.pa-1(v-for="(groups, i) in filterSchedule" :key="i")
                            v-expansion-panel-header {{groups.group_name}}
                            v-expansion-panel-content
                                div.pa-0.ma-0.mb-3(color="blue lighten-5")
                                    v-form  
                                        div.overline.mb-0 {{groups.show.Place.place_name}}
                                        div.ma-0.pa-0(v-for="(item, index) in groups.show" :key="index")
                                            v-card.pa-0.ma-0.mb-3(flat v-if="index != 'Place' && !access(filterSchedule[i].bild[index])") 
                                                v-card-title.pl-1.py-1 {{item.time}} • {{item.classroom ? item.classroom : "НУ"}}
                                                v-card-text.pl-1.pb-1 {{item.LessonZnam.join(" / ")}}
                                                v-card-text.pl-1.pb-1 {{item.TeacherZnam.join(" / ")}}
                                                v-text-field.mt-3(solo clearable dense label="Номер аудитории" :disabled="access(filterSchedule[i].bild[index])" v-model="filterSchedule[i].bild[index].classroom" @change="item.classroom = filterSchedule[i].bild[index].classroom")
                    v-expansion-panels(v-else flat popout)
                        v-expansion-panel.pa-1(v-for="(groups, i) in filterSchedule" :key="i")
                            v-expansion-panel-header {{groups.group_name}}
                            v-expansion-panel-content
                                div.pa-0.ma-0.mb-3(color="blue lighten-5")
                                    v-form  
                                        div.overline.mb-0 {{groups.show.Place.place_name}}
                                        div.ma-0.pa-0(v-for="(item, index) in groups.show" :key="index")
                                            v-card.pa-0.ma-0.mb-3(flat v-if="index != 'Place' && !access(filterSchedule[i].bild[index])") 
                                                v-card-title.pl-1.py-1 {{item.time}} • {{item.classroom ? item.classroom : "НУ"}}
                                                v-card-text.pl-1.pb-1 {{item.LessonChisl.join(" / ")}}
                                                v-card-text.pl-1.pb-1 {{item.TeacherChisl.join(" / ")}}
                                                v-text-field.mt-3(solo clearable dense label="Номер аудитории" :disabled="access(filterSchedule[i].bild[index])" v-model="filterSchedule[i].bild[index].classroom" @change="item.classroom = filterSchedule[i].bild[index].classroom")
                    v-card-actions
                        v-btn(block text color="success" @click="sendQuery()" :loading="loading") сохранить          
</template>

<script>
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка

import api_schedule from "@/js/api/schedule"; //Api расписания
import api_teacher from "@/js/api/teacher";

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
    //?----------------------------------------------
    //!           Преднастройка
    //?----------------------------------------------
    //*Подключение вспомогательных компонентов
    mixins: [withSnackbar, withOverlayLoading],
    computed: {
        ...mapGetters(["user"]),

        //*Получение четности недели
        isChisl: function() {
            var year = new Date().getFullYear();
            var month = new Date().getMonth();
            var today = new Date(year, month, 0).getTime();
            var now = new Date().getTime();
            var week = Math.round((now - today) / (1000 * 60 * 60 * 24 * 7));
            return week % 2;
        },

        filterSchedule: function() {
            if (!this.schedule) return undefined;
            return this.schedule;
        }
    },

    data() {
        return {
            teacher_id: null,
            loading: false,
            teachers: null,
            day: "Понедельник",
            days: [
                "Воскресенье",
                "Понедельник",
                "Вторник",
                "Среда",
                "Четверг",
                "Пятница",
                "Суббота",
                "Понедельник",
            ],
            teachers_day: null,
            schedule: null,
            classroom: null
        };
    },

    async beforeMount() {
        await this.getTeachers();
    },

    methods: {
        //?----------------------------------------------
        //!           Методы страницы
        //?----------------------------------------------
        async teacher_change() {
            this.showLoading("Получение расписания");
            this.schedule = await api_schedule.getScheduleBildShowDayByTeacherId({
                teacher_id: this.teacher_id,
                day: this.day
            });
            console.log(this.schedule);
            this.closeLoading("Получение расписания");
        },

        async listChange(id) {
            if (this.teacher_id != id) {
                this.showLoading("Получение расписания");
                this.teacher_id = id;
                this.schedule = await api_schedule.getScheduleBildShowDayByTeacherId({
                    teacher_id: this.teacher_id,
                    day: this.day
                });
                this.closeLoading("Получение расписания");
            }
        },

        //Отправка учебного расписания на сохранение
        async sendQuery() {
            this.loading = true;
            if (await api_schedule.editScheduleClassroom({
                    schedule: this.schedule,
                    day: this.day
                }))
                this.showMessage("Выполнено!");
            else
                this.showError("Ошибка выполнения!");

            this.loading = false;
        },

        //Получение всех преподавателей
        async getTeachers() {
            this.showLoading("Получение преподавателей");
            this.teachers = await api_schedule.getTeachersForScheduleDay({
                chisl: this.isChisl,
                day: this.day
            });
            if (this.teachers)
                if (this.teachers.length > 0)
                    this.teacher_id = this.teachers[0].id;
            this.teacher_change();
            this.closeLoading("Получение преподавателей");
        },
        //Проверка доступа
        access(item) {
            let check = false;
            if (this.isChisl) {
                item.TeacherZnam.forEach(el => {
                    if (el == this.teacher_id)
                        check = true;
                });
            } else {
                item.TeacherChisl.forEach(el => {
                    if (el == this.teacher_id)
                        check = true;
                });
            }
            return !check;
        }
    }
};
</script>