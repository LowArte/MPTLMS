<template lang="pug">
    v-layout.column.wrap
        c-comfirm-dialog(ref='qwestion')              
        v-flex.ma-2.mb-0.pa-0.row
            v-combobox.ma-1(label="Специальность" @change="departament_change" item-text="dep_name_full" :items="departaments_info.departaments" v-model="departaments_info.selected_departament" )
            v-combobox.ma-1(label="Группа" @change="changeFilter" item-text="group_name" :items="groups_info.groups"  v-model="groups_info.selected_group")
        v-flex.ma-2.mt-0.pa-0.row
            v-dialog(ref="dateDialog" v-model="dateDialog.model" :return-value.sync="dateDialog.date" persistent width="290px")
                template(v-slot:activator="{ on }")
                    v-text-field(v-model="dateDialog.date" label="Дата" readonly v-on="on")
                v-date-picker(v-model="dateDialog.date" scrollable :first-day-of-week="1" locale="ru-Ru")
                    v-btn(text color="primary" @click="dateDialog.model = false") Отмены
                    v-btn(text color="primary" @click="$refs.dateDialog.save(dateDialog.date); changeFilter();") Принять
            v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition" v-if="_schedule != null")
                template(v-slot:activator="{ on }")
                    v-btn.ma-3(color="accent" text block dark v-on="on") {{titleDialog}}
                v-card
                    v-toolbar(dark color="primary")
                        v-btn(icon dark @click="dialog = false; changeFilter()")
                            v-icon mdi-close
                        v-toolbar-title {{titleDialog}}
                        v-spacer
                    c_bildReplacement.pa-2(:_departaments_info="_departaments_info" 
                                    :_groups_info="_groups_info" 
                                    :_schedule="_schedule"
                                    :_schedule_bild="_schedule_bild"
                                    :_disciplines="_disciplines"
                                    :_teachers="_teachers")
        v-switch.ma-0.pa-0.ml-2.mr-2(v-model="checkAllGroup" color="primary" @change="changeFilter" block inset label="Вывести замены для всех групп!")
        v-switch.ma-0.pa-0.ml-2.mr-2(v-model="checkAllDate" color="primary" @change="changeFilter" block inset label="Вывести замены для всех дат!")
        v-flex.ma-0.mb-2.row(v-for="(groups_key, groups_index) in groups" :key="groups_index" align="center" justify="center" min-width="500px")
            v-flex.ma-2(v-for="(date_key, date_index) in date[groups_index]" :key="date_index")
                v-hover(v-slot:default="{ hover }")
                    v-card.ma-0(:elevation="hover ? 12 : 6" width="100%")
                        v-card-title.subtitle-1(style="color: #FF3D00;") {{groups_key}} - {{date_key}}
                        v-divider
                        v-simple-table(min-width="500px")
                            thead
                                tr
                                    th.text-left № пары
                                    th.text-left Что заменяют
                                    th.text-left На что заменяют
                                    th.text-left Дата замены
                                    th.text-left(v-if="_schedule != null") Действие
                            tbody
                                tr(v-for="(replacement_key, replacement_index) in parseReplacements[groups_index][date_index]" :key="replacement_index")
                                    td {{ replacement_key['swap']['caselesson'] }}
                                    td(v-if="replacement_key['swap']['oldteacher'] != null && replacement_key['swap']['oldteacher'] != ''") {{ replacement_key['swap']['oldlesson'] }} ({{ replacement_key['swap']['oldteacher'] }})
                                    td(v-else-if="replacement_key['swap']['oldlesson'] != null && replacement_key['swap']['oldlesson'] != ''") {{ replacement_key['swap']['oldlesson'] }}
                                    td(v-else) Дополнительное занятие
                                    td(v-if="replacement_key['swap']['teacher'] != null && replacement_key['swap']['teacher'] != ''") {{ replacement_key['swap']['lesson'] }} ({{ replacement_key['swap']['teacher'] }})
                                    td(v-else-if="replacement_key['swap']['lesson'] != null && replacement_key['swap']['lesson'] != ''") {{ replacement_key['swap']['lesson'] }}
                                    td(v-else) Занятие отменено
                                    td {{ replacement_key['created_at'] }}
                                    td(v-if="_schedule != null")
                                        v-icon.small(@click="deleteItem(replacement_key['id'])") delete
</template>

<script>
import group_api from "./../../api/group"; //api групп
import replacements_api from "./../../api/replacements"; //api замен
import withSnackbar from "../mixins/withSnackbar"; //Alert
import ConfirmDialog_C from "./../expention-f/ConfirmDialog"; //Диалог confirm
import BildReplacement from "./Bild_Replacements"; //Конструктор замен

export default {
    mixins: [withSnackbar],

    components: 
    {
        "c-comfirm-dialog": ConfirmDialog_C,
        "c_bildReplacement": BildReplacement
    },

    data: () => ({
        groups_info: null, //Группы
        departaments_info: null, //Отделения
        parseReplacements: null, //Замены
        replacements: null, //Замены
        checkAllGroup: false, //Все группы
        checkAllDate: false, //Все даты
        groups: [], 
        date: [], 
        titleDialog: "Конструктор замен",
        dialog: false,
        dateDialog: {
            model: false,
            date: new Date().toISOString().substr(0, 10),
        } //Диалог даты
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
        _replacements: {
            type: Array,
            default: null
        }, //JSON замен
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
        _schedule_bild: {
            type: Object,
            default: null
        } //Расписание
    },

    methods:
    {
        //Удаление замены
        deleteItem(id)
        {
            this.$refs.qwestion.pop().then(confirmResult => {
                if (confirmResult) 
                {
                    replacements_api
                    .deleteReplacement(id)
                        .then(res => {
                            this.showMessage("Удалена!");
                            this.changeFilter();
                        })
                        .catch(ex => {
                            this.showError(ex);
                        });
                } 
                else 
                {
                    this.showInfo("Действие было отменено");
                }
            });
        },

        //Получение групп для отделения
        departament_change() 
        {
            group_api
                .getGroupsByDepartamentId(this.departaments_info.selected_departament.id)
                .then(res => {
                    this.groups_info.groups = res.data.groups_info.groups;
                    this.groups_info.selected_group = this.groups_info.groups[0];
                    this.changeFilter();
                })
                .catch(ex => {
                    this.showError(ex);
                });
        },

        //Получение замен с учётом фильтров
        changeFilter() 
        {
            if(this.checkAllGroup && this.checkAllDate) //Получить все замены для всех дат и групп
            {
                replacements_api
                    .getReplacements()
                    .then(res => {
                        this.replacements = res.data.replacements;
                        this.parseReplacement();
                    })
                    .catch(ex => {
                        this.showError(ex);
                    });
            }
            else
            if (this.checkAllGroup) //Получить замены для всех групп
            {
                replacements_api
                    .getReplacementsByDate(this.dateDialog.date)
                    .then(res => {
                        this.replacements = res.data.replacements;
                        this.parseReplacement();
                    })
                    .catch(ex => {
                        this.showError(ex);
                    });
            }
            else
            if (this.checkAllDate) //Получить все замены для всех дат
            {
                replacements_api
                    .getReplacementsByGroup(this.groups_info.selected_group.id)
                    .then(res => {
                        this.replacements = res.data.replacements;
                        this.parseReplacement();
                    })
                    .catch(ex => {
                        this.showError(ex);
                    });
            }
            else 
            {
                replacements_api
                    .getReplacementsByGroupByDate({group_id: this.groups_info.selected_group.id, date: this.dateDialog.date})
                    .then(res => {
                        this.replacements = res.data.replacements;
                        this.parseReplacement();
                    })
                    .catch(ex => {
                        this.showError(ex);
                    });
            }
        },

        //Перевод массив для вывода
        parseReplacement()
        {
            this.groups = [];
            this.date = [];
            this.parseReplacements = [];
            var j = -1; //Индекс группы
            var l = -1; //Индекс даты
            for(var i = 0; i < this.replacements.length; i++)
            {
                this.replacements[i]['swap'] = JSON.parse(this.replacements[i]['swap']);
                if(Array.isArray(this.replacements[i]['swap']['lesson'])) this.replacements[i]['swap']['lesson'] = this.replacements[i]['swap']['lesson'].join(' / ');
                if(Array.isArray(this.replacements[i]['swap']['oldlesson'])) this.replacements[i]['swap']['oldlesson'] = this.replacements[i]['swap']['oldlesson'].join(' / ');
                if(Array.isArray(this.replacements[i]['swap']['teacher'])) this.replacements[i]['swap']['teacher'] = this.replacements[i]['swap']['teacher'].join(' / ');
                if(Array.isArray(this.replacements[i]['swap']['oldteacher'])) this.replacements[i]['swap']['oldteacher'] = this.replacements[i]['swap']['oldteacher'].join(' / ');
                j = this.groups.indexOf(this.replacements[i]['group_name']);
                if(j == -1)
                {
                    this.groups.push(this.replacements[i]['group_name']);
                    this.date.push([this.replacements[i]['swap_date']]);
                    this.parseReplacements.push([[this.replacements[i]]]);
                }
                else
                {
                    l = this.date[j].indexOf(this.replacements[i]['swap_date']);
                    if(l == -1)
                    {
                        this.date[j].push(this.replacements[i]['swap_date']);
                        this.parseReplacements[j].push([this.replacements[i]]);
                    }
                    else
                        this.parseReplacements[j][l].push(this.replacements[i]);
                }
            }
        }
    },
    
    //Начальный метод
    beforeMount() 
    {
        this.groups_info = this._groups_info;
        this.departaments_info = this._departaments_info;
        this.replacements = this._replacements;
        this.parseReplacement();
    }
};
</script>