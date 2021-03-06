<template lang="pug">
    v-content.ma-0.pa-2
        v-layout.column.wrap
            c-comfirm-dialog(ref='qwestion')
            c-bild-dialog(ref='bild')
            v-flex
                v-card(v-if="user")
                    v-system-bar
                        span Фильтры
                    v-combobox.mx-3.mt-6(dense outlined  label="Специальность" no-data-text="Нет данных" @change="department_change" item-text="dep_name_full" :items="specialities" v-model="selected_department" )
                    v-combobox.mx-3.mt-2(dense outlined  label="Группа" no-data-text="Нет данных" item-text="group_name" :items="groups" v-model="selected_group")
                    v-dialog(ref="dateDialog" v-model="dateDialog.model" :return-value.sync="dateDialog.date" persistent width="290px")
                        template(v-slot:activator="{ on }")
                            v-text-field.mx-3(dense outlined v-model="dateDialog.date" label="Дата" readonly v-on="on")
                        v-date-picker(:allowed-dates="val => new Date(val).getDay() != 0" :min='new Date().toISOString().substr(0, 10)' v-model="dateDialog.date" scrollable :first-day-of-week="1" locale="ru-Ru")
                            v-btn(text color="primary" @click="dateDialog.model = !dateDialog.model") Отмены
                            v-spacer
                            v-btn(text color="primary" @click="$refs.dateDialog.save(dateDialog.date);") Принять
                    v-switch.shrink.mx-3.my-2(dense v-model="checkAllGroup" color="primary" block label="Экзамены для всех групп")
                    v-switch.shrink.mx-3.my-2(dense v-model="checkAllDate" color="primary" block label="Экзамены на все даты")
                    v-card-actions(v-if="user != null && user.post_id != null")
                        v-btn(v-if="user.post_id == 1 || user.post_id == 4" color="accent" text block dark @click="addExam()") Добавить экзамен    
            v-flex
                v-layout.row.wrap(filterSchedule)
                    v-flex(v-for="(exam,exam_index) in filterSchedule" :key="exam_index")
                        v-card.mx-auto(min-width="300")
                            v-system-bar
                                span Группа: {{exam.group_name}} 
                                v-spacer
                                span Дата: {{exam.info.date}}
                            v-simple-table
                                thead
                                    tr
                                        th.text-left Экзамен
                                        th.text-left Время проведения
                                        th.text-left Преподаватель
                                        th.text-left Место проведения / кабинет
                                        th.text-left(v-if="user.post_id == 1 || user.post_id == 4") Действие
                                tbody
                                    tr
                                        td {{ exam.info.title }}
                                        td {{ exam.info.time }}
                                        td {{ exam.teacher_admin }}
                                        td {{ exam.place_name }} / {{exam.info.classroom}}
                                        td(v-if="user.post_id == 1 || user.post_id == 4")
                                            v-icon.small(@click="deleteExam(exam['id'])") delete
    
</template>

<script>
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import bildDialog_C from "@/js/components/timetable-exam-f/Bild_Timetable_Exam";
import ConfirmDialog_C from "@/js/components/expention-f/ConfirmDialog"; //Диалог Да/Нет

import api_department from "@/js/api/department"; //Отделения
import api_homework from "@/js/api/homework"; //Домашняя работа

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
//?----------------------------------------------
//!           Преднастройка
//?----------------------------------------------
    //*Подключение вспомогательных компонентов
    mixins: [withSnackbar, withOverlayLoading],

    components: {
        "c-bild-dialog": bildDialog_C,
        "c-comfirm-dialog": ConfirmDialog_C
    },

    //*Вычисляемые свойства
    post_name: {
        name: "Расписание экзаменов",
        url: "timetable_exam",
    },
            
    computed: {
        ...mapGetters(["specialities", "groups_combo", "user"]),
        combo_groups: function() {
            if (!this.groups_combo) return undefined;
            this.selected_group = this.groups_combo[0];
            return this.groups_combo;
        },
        filterSchedule: function(){
            if (!this.schedule) return undefined;
            let schedule = this.schedule.filter(res => {
                if(!this.selected_group)
                    return false;
                if(this.checkAllDate && this.checkAllGroup)
                    return true;
                if(this.checkAllDate && res.group_id == this.selected_group.id)
                    return true;
                if(res.info.date == this.dateDialog.date && this.checkAllGroup)
                    return true;
                if(res.info.date == this.dateDialog.date && res.group_id == this.selected_group.id)
                    return true;
                return false;
            });
            return schedule;
        }
    },

    data() {
        return {
            selected_department: null,
            selected_group: null,
            schedule: null,
            checkAllDate: false,
            checkAllGroup: false,
            start: true,
            groups: null,
            dateDialog: {
                model: false,
                date: new Date().toISOString().substr(0, 10)
            } //Диалог даты
        }
    },

    async beforeMount()
    {
        this.getDepartments();
        this.refresh();
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
                let items = await api_department.getDepartments();
                this.$store.commit(mutations.SET_SPECIALITIES_FULL, items);
                this.closeLoading("Получение отделений");
            }

            if (this.specialities) 
            {
                if(this.start && this.user.post_id == 2)
                    this.selected_department = this.user.student.group.department;
                else
                    this.selected_department = this.specialities[0];
                this.department_change();
            }
        },

        async refresh()
        {
            let item = await api_homework.getHomeWorkExams();
            this.schedule = item;
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
                this.groups = this.combo_groups;
                if(this.start && this.user.post_id == 2)
                {
                    for (let index = 0; index < this.combo_groups.length; index++) 
                    {
                        if(this.combo_groups[index].id == this.user.student.group.id || this.combo_groups[index].child_id == this.user.student.group.id)
                        {
                            this.selected_group = this.combo_groups[index];
                            index = this.combo_groups.length;
                        }
                    }
                }
                else
                    this.selected_group = this.combo_groups[0];
                this.start = false;
            }
        },

        async addExam()
        {  
            var res = await this.$refs.bild.pop().then(res => {return res;});
            if(res)
            {
                if(await api_homework.saveHomeWork(res))
                {
                    this.showMessage("Сохранено!");
                    this.refresh();
                }
            }
            else 
                this.showInfo("Действие было отменено пользователем!");
        },

        async deleteExam(id)
        {
            let res = await this.$refs.qwestion.pop().then(res => { return res; });
            if (res) 
            {
                if(await api_homework.deleteHomeWork(id))
                {
                    this.showMessage("Выполнено!");
                    this.refresh();
                }
                else
                this.showError("Произошла ошибка");
            }
            else
                this.showInfo("Действие было отменено пользователем");
        },
    }
}
</script>