<template lang="pug">
    v-layout.column.wrap
        v-flex.ma-2.mb-0.pa-0.row
            v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
            v-combobox.ma-1(label="Группа" item-text="group_name" :items="groups_info.groups" @change="caseDate()" v-model="groups_info.selected_group")
        v-flex.ma-2.mt-0.pa-0.row
            v-dialog(ref="dateDialog" v-model="dateDialog.model" :return-value.sync="dateDialog.date" persistent width="290px")
                template(v-slot:activator="{ on }")
                    v-text-field(v-model="dateDialog.date" label="Дата" readonly v-on="on")
                v-date-picker(v-model="dateDialog.date" scrollable :first-day-of-week="1" locale="ru-Ru")
                    v-btn(text color="primary" @click="dateDialog.model = false") Отмены
                    v-btn(text color="primary" @click="$refs.dateDialog.save(dateDialog.date); caseDate()") Принять
        v-layout.row.wrap
            v-flex.my-2.ma-2.col
                v-hover(v-slot:default='{ hover }')
                    v-card.mx-auto.pa-4.pb-0(:elevation='hover ? 12 : 6' min-width="265px")
                        v-card-title.primary-title.pt-0.px-0 Расписание на {{dateDialog.date}}
                        v-card-actions.pa-0(v-for="(lesson,lesson_index) in schedule" :key="'l'+lesson_index" v-if="lesson_index < 8")
                            v-card-text.pa-0.pt-1.ml-1.text-black(@click="caseLesson(lesson_index)" v-if="((isToday == 0) && (lesson.LessonChisl != null)) || ((lesson.chisl == false) && (lesson.LessonChisl != null))") 
                                strong.accent--text.font-weight-light.mr-2 {{lesson.time}}
                                | {{lesson.LessonChisl}} ({{ lesson.TeacherChisl }})
                            v-card-text.pa-0.pt-1.ml-1.text-black(@click="caseLesson(lesson_index)" v-else-if="(isToday == 1) && (lesson.LessonZnam != null)") 
                                strong.accent--text.font-weight-light.mr-2 {{lesson.time}}
                                | {{lesson.LessonZnam}} ({{ lesson.TeacherZnam }})
                            v-card-text.pa-0.pt-1.ml-1.text-black(@click="caseLesson(lesson_index)" v-else) 
                                strong.accent--text.font-weight-light {{lesson.time}}
            v-flex.my-2.ma-2.col
                v-hover(v-slot:default='{ hover }')
                    v-card.mx-auto.pa-4.pb-0(:elevation='hover ? 12 : 6' min-width="265px")
                        v-card-title.primary-title.pt-0.px-0 Формирование замены
                        v-form(ref="BildReplacement")
                            v-select.pa-0.mb-0.mt-2(v-model="replacement.caselesson" :rules="rules" label="Пара" :items="lessons" @change="caseLesson(replacement.caselesson)")
                            v-autocomplete(v-model="replacement.lesson" label="Дисциплины" :items="discip" item-text='discipline_name' small-chips chips multiple)
                            v-autocomplete(v-model="replacement.teacher" label="Преподаватели" :items="teachers" item-text='name' small-chips chips multiple)
                        v-card-text.pa-0.wrap.text-black {{ replacement.oldlesson }} 
                        v-card-text.pa-0.pt-2.font-weight-light.wrap.caption {{ replacement.oldteacher }}
                        v-btn.mb-2.justify-center(color="accent" block dark @click="sendQuery") Принять
                        v-divider
</template>

<script>
import group_api from "./../../api/group";
import schedule_api from "./../../api/schedule";
import replacements_api from "./../../api/replacements";
import withSnackbar from "../mixins/withSnackbar"; //Alert
export default {
    mixins: [withSnackbar],
    data: () => ({
        rules: [
            v => !!v || "Пара не указана!",
        ],
        lessons: ["1","2","3","4","5","6","7"],
        replacement:{caselesson: null, lesson: null, teacher: null, oldlesson: null, oldteacher: null},  //Замена которая потом будет сохранена 
        discip: null, //Дисциплины
        teachers: null, //Преподаватели
        groups_info: null, //Группы
        departaments_info: null, //Отделения
        schedule: null, //Расписание выбранного дня
        week: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'], //Неделя
        isToday: null, //Текущая четность недели
        dateDialog: {
            model: false,
            date: new Date().toISOString().substr(0, 10),
        }, //Диалог даты
    }),
    props: {
        _departaments_info: {
            type: Object,
            default: null
        }, //JSON отделений
        _groups_info: {
            type: Object,
            default: null
        }, //JSON групп
        _teachers: {
            type: String,
            default: null
        }, //JSON учителей
        _discip: {
            type: String,
            default: null
        }, //JSON дисциплин
        _schedule: {
            type: Object,
            default: null
        }, //JSON дисциплин
    },
    methods:{
        //Получение групп при изменении отдела
        departament_change() 
        {
            group_api
                .getGroup(this.departaments_info.selected_departament.id)
                .then(res => {
                    this.groups_info.groups = res.data.groups;
                    this.groups_info.selected_group = this.groups_info.groups[0];
                    this.group_change();
                })
                .catch(ex => {
                    console.log(ex);
                });
        },
        //При выборе даты получать расписание выбранного дня
        caseDate() 
        {
            var date = new Date(this.dateDialog.date);
            if(date.getDay() == 0)
            {
                this.dateDialog.date = new Date().toISOString().substr(0, 10);
                this.showError("На воскресенье нет расписания!");
            }
            else
            {
                schedule_api
                    .getScheduleByDay({group_id: this.groups_info.selected_group.id, day: this.week[date.getDay()]})
                    .then(res => {
                        this.schedule = res.data.schedule;
                        this.isToday = this.isChisl();
                        this.parseSchedule();
                    })
                    .catch(ex => {
                        console.log(ex);
                    });
            }
        },
        //Определения числителя/знаменателя недели
        isChisl() 
        {
            const today = new Date(this.dateDialog.date);
            return today.getWeek() % 2;
        },
        //Сохранение замены
        sendQuery() 
        {
            if (this.$refs.BildReplacement.validate())
            replacements_api
            .saveReplacements({group_id: this.groups_info.selected_group.id, replacement: this.replacement, date: this.dateDialog.date})
            .then(res => {
                this.showMessage('Замена сохранена!');
            })
            .catch(ex => {
                this.showError("Замена не принята!" + ex);
            });
        },
        //Выбор пары
        caseLesson(number)
        {
            this.replacement.caselesson = number;
            if(this.isToday == 0)
            {
                this.replacement.oldlesson = this.schedule[number].LessonChisl;
                this.replacement.oldteacher = this.schedule[number].TeacherChisl;    
            }
            else
            {
                this.replacement.oldlesson = this.schedule[number].LessonZnam;
                this.replacement.oldteacher = this.schedule[number].TeacherZnam;
            }
        },
        parseSchedule()
        {
            for(var j = 1; j <= 7; j++)
            {
                if(Array.isArray(this.schedule[j]['LessonChisl'])) 
                    this.schedule[j]['LessonChisl'] = this.schedule[j]['LessonChisl'].join(' / ');
                if(Array.isArray(this.schedule[j]['LessonZnam'])) 
                    this.schedule[j]['LessonZnam'] = this.schedule[j]['LessonZnam'].join(' / ');
                if(Array.isArray(this.schedule[j]['TeacherChisl'])) 
                    this.schedule[j]['TeacherChisl'] = this.schedule[j]['TeacherChisl'].join(' / ');
                if(Array.isArray(this.schedule[j]['TeacherZnam'])) 
                    this.schedule[j]['TeacherZnam'] = this.schedule[j]['TeacherZnam'].join(' / ');
            }
        }
    },
    beforeMount() //Получение данных для работы на странице
    {
        this.groups_info = this._groups_info;
        this.departaments_info = this._departaments_info;
        this.replacements = this._replacements;
        this.discip = JSON.parse(this._discip);
        this.teachers = JSON.parse(this._teachers);
        this.isToday = this.isChisl();
        //caseDate();
        this.schedule = this._schedule[this.week[new Date(this.dateDialog.date).getDay()]];
        this.parseSchedule();
    }
}
</script>