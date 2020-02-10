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
                        v-card-title.primary-title.pt-0.px-0 Расписание на {{dateDialog.date}} {{ isToday ==0 ? "Числитель" :"Знаменатель" }}
                        v-card-actions.pa-0(v-for="(lesson,lesson_index) in schedule" :key="'l'+lesson_index" v-if="lesson_index < 8 && lesson != null")
                            v-card-text.pa-0.pt-1.ml-1.text-black(@click="caseLesson(lesson_index)" v-if="lesson.chisl == false") 
                                strong.accent--text.font-weight-light.mr-2 {{lesson.time}}
                                | {{lesson.LessonChisl}} {{ lesson.TeacherChisl }}
                            v-card-text.pa-0.pt-1.ml-1.text-black(@click="caseLesson(lesson_index)" v-else-if="isToday == 1") 
                                strong.accent--text.font-weight-light.mr-2 {{lesson.time}}
                                | {{lesson.LessonZnam}} {{ lesson.TeacherZnam }}
                            v-card-text.pa-0.pt-1.ml-1.text-black(@click="caseLesson(lesson_index)" v-else-if="isToday == 0") 
                                strong.accent--text.font-weight-light.mr-2 {{lesson.time}}
                                | {{lesson.LessonChisl}} {{ lesson.TeacherChisl }}
            v-flex.my-2.ma-2.col
                v-hover(v-slot:default='{ hover }')
                    v-card.mx-auto.pa-4.pb-0(:elevation='hover ? 12 : 6' min-width="265px")
                        v-card-title.primary-title.pt-0.px-0 Формирование замены
                        v-form(ref="BildReplacement")
                            v-select.pa-0.mb-0.mt-2(v-model="replacement.caselesson" :rules="rules" label="Пара" :items="lessons" @change="caseLesson(replacement.caselesson)")
                            v-autocomplete(v-model="replacement.lesson" label="Дисциплины" :items="_disciplines" item-text='discipline_name' small-chips chips multiple)
                            v-autocomplete(v-model="replacement.teacher" label="Преподаватели" :items="_teachers" item-text='fullFio' small-chips chips multiple)
                        v-card-text.pa-2.wrap.text-black {{ replacement.oldlesson }} {{ replacement.oldteacher }}
                        v-btn.mb-2.mt-1.justify-center(color="accent" block dark @click="sendQuery") Принять
                        v-divider
</template>

<script>
import group_api from "./../../api/group"; //Api групп
import schedule_api from "./../../api/schedule"; //Api расписания
import replacements_api from "./../../api/replacements"; //Api замен
import withSnackbar from "../mixins/withSnackbar"; //Alert
Date.prototype.getWeek = function() {
  const onejan = new Date(this.getFullYear(), 0, 1);
  return Math.ceil((((this - onejan) / 86400000) + 1) / 7);
};

export default {
    mixins: [withSnackbar],

    data: () => ({
        typeReplacement: 1,
        rules: [
            v => !!v || "Пара не указана!",
        ],
        lessons: ["1","2","3","4","5","6","7"],
        replacement:{
            caselesson: "", 
            lesson: [], 
            teacher: [], 
            oldlesson: "", 
            oldteacher: ""
        },  //Замена которая потом будет сохранена 
        groups_info: null, //Группы
        departaments_info: null, //Отделения
        schedule: null, //Расписание выбранного дня
        week: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'], //Неделя
        isToday: null, //Текущая четность недели
        date_week: 0,
        dateDialog: {
            model: false,
            date: new Date().toISOString().substr(0, 10),
        }, //Диалог даты
    }),

    props: 
    {
        _departaments_info: {
            type: Object,
            default: null
        }, //JSON отделений
        _groups_info: {
            type: Object,
            default: null
        }, //JSON групп
        _teachers: {
            type: Array,
            default: null
        }, //JSON учителей
        _disciplines: {
            type: Array,
            default: null
        }, //JSON дисциплин
        _schedule: {
            type: Object,
            default: null
        }, //JSON дисциплин
        _slug: {
            data: String,
            default: ""
        }, //Модуль
        _controller: {
            data: String,
            default: "replacements"
        } //Контроллер
    },

    methods:
    {
        //Определение числителя
        isChisl() 
        {
            var today = new Date(new Date(this.dateDialog.date).getTime() + 8 * (24*60*60*1000));
            return today.getWeek() % 2;
        },
        
        //Получение групп при изменении отдела
        departament_change() 
        {
            group_api
                .getGroup({department_id: this.departaments_info.selected_departament.id, slug: this._slug, controller: this._controller})
                .then(res => {
                    this.groups_info.groups = res.data.groups;
                    this.groups_info.selected_group = this.groups_info.groups[0];
                    this.caseDate();
                })
                .catch(ex => {
                    this.showError(ex);
                });
        },

        //При выборе даты получать расписание выбранного дня, если воскресенье то за день
        caseDate() 
        {
            this.date_week = (new Date(this.dateDialog.date)).getDay();
            if(this.date_week == 0)
            {
                this.dateDialog.date = new Date((new Date(this.dateDialog.date)).getTime() - (24*60*60*1000)).toISOString().substr(0, 10);
                this.$refs.dateDialog.save(this.dateDialog.date);
                this.showInfo("На воскресенье нет расписания!");
                this.caseDate();
            }
            else
            {
                schedule_api
                    .getSchedule({group_id: this.groups_info.selected_group.id, slug: this._slug, controller: this._controller})
                    .then(res => {
                        this.schedule = res.data.schedule[this.week[this.date_week]];
                        this.parseSchedule();
                    })
                    .catch(ex => {
                        this.showError(ex);
                    });
            }
        },

        //Сохранение замены
        sendQuery() 
        {
            if (this.$refs.BildReplacement.validate())
            replacements_api
                .saveReplacements({group_id: this.groups_info.selected_group.id, replacement: this.replacement, date: this.dateDialog.date, slug: this._slug, controller: this._controller})
                .then(res => {
                    this.showMessage('Замена сохранена!');
                })
                .catch(ex => {
                    this.showError("Замена не принята! " + ex);
                });
        },

        //Выбор пары 
        caseLesson(number)
        {
            this.replacement.caselesson = number;
            if (this.schedule != null)
            if (!this.schedule[number].chisl)
            {
                this.replacement.oldlesson = this.schedule[number].LessonChisl;
                this.replacement.oldteacher = this.schedule[number].TeacherChisl;
            }
            else
            {
                if(this.isChisl() == 0)
                {
                    this.replacement.oldlesson = this.schedule[number].LessonChisl;
                    this.replacement.oldteacher = this.schedule[number].TeacherChisl;    
                }
                else
                {
                    this.replacement.oldlesson = this.schedule[number].LessonZnam;
                    this.replacement.oldteacher = this.schedule[number].TeacherZnam;
                }
            }
        },

        //Формирование расписания для вывода
        parseSchedule()
        {
            this.isToday = this.isChisl();
            if (this.schedule != null)
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

                if (this.schedule[j]['TeacherChisl'] != "")
                    this.schedule[j]['TeacherChisl'] = "(" + this.schedule[j]['TeacherChisl'] + ")";
                if (this.schedule[j]['TeacherZnam'] != "")
                    this.schedule[j]['TeacherZnam'] = "(" + this.schedule[j]['TeacherZnam'] + ")";
            }

            if (this.replacement.caselesson != "")
                this.caseLesson(this.replacement.caselesson);
        }
    },
    
    //Получение данных для работы на странице
    beforeMount() 
    {
        this.date_week = (new Date(this.dateDialog.date)).getDay();
        this.schedule = this._schedule[this.week[this.date_week]];
        this.groups_info = this._groups_info;
        this.departaments_info = this._departaments_info;
        this.replacements = this._replacements;
        this.parseSchedule();
    }
}
</script>