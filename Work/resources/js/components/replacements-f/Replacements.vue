<template lang="pug">
    v-layout.column.wrap
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
        v-switch.ml-2.mr-2(v-model="checkAllGroup" color="primary" @change="changeFilter" block inset label="Вывести замены для всех групп!")
        v-switch.ml-2.mr-2(v-model="checkAllDate" color="primary" @change="changeFilter" block inset label="Вывести замены для всех дат!")

        //-v-flex.ma-0.mb-2.row(v-for="(replacement_key, replacement_index) in replacements" :key="replacement_index" align="center" justify="center")
        v-flex.ma-0.mb-2.row(v-for="(groups_key, groups_index) in groups" :key="groups_index" align="center" justify="center" min-width="500px")
            v-flex(v-for="(date_key, date_index) in date[groups_index]" :key="date_index")
                v-hover(v-slot:default="{ hover }")
                    v-card.ma-0(:elevation="hover ? 12 : 6" width="100%")
                        v-card-title.subtitle-1(style="color: #FF3D00;") {{groups_key}} - {{date_key}}
                        v-divider
                        v-simple-table(min-width="500px")
                            thead
                                tr
                                    th.text-left №
                                    th.text-left Что заменяют
                                    th.text-left На что заменяют
                                    th.text-left Дата замены
                                    th.text-left
                            tbody
                                tr(v-for="(replacement_key, replacement_index) in parseReplacements[groups_index][date_index]" :key="replacement_index")
                                    td {{ replacement_key['swap']['caselesson'] }}
                                    td(v-if="replacement_key['swap']['oldteacher'] != null") {{ replacement_key['swap']['oldlesson'] }} ({{ replacement_key['swap']['oldteacher'] }})
                                    td(v-else-if="replacement_key['swap']['oldlesson'] != null") {{ replacement_key['swap']['oldlesson'] }}
                                    td(v-else) Дополнительное занятие
                                    td(v-if="replacement_key['swap']['teacher'] != null") {{ replacement_key['swap']['lesson'] }} ({{ replacement_key['swap']['teacher'] }})
                                    td(v-else-if="replacement_key['swap']['lesson'] != null") {{ replacement_key['swap']['lesson'] }}
                                    td(v-else) Занятие отменено
                                    td {{ replacement_key['created_at'] }}
                                    td 
                                        v-icon.small(@click="deleteItem(replacement_key['id'])") delete
</template>

<script>
import group_api from "./../../api/group";
import replacements_api from "./../../api/replacements";
export default {
    data: () => ({
        groups_info: null, //Группы
        departaments_info: null, //Отделения
        parseReplacements: null, //Замены
        replacements: null, //Замены
        checkAllGroup: false, //Все группы
        checkAllDate: false, //Все даты
        groups: [], 
        date: [], 
        dateDialog: {
            model: false,
            date: new Date().toISOString().substr(0, 10),
        } //Диалог даты
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
        _replacements: {
            type: String,
            default: null
        } //JSON замен
    },
    methods:{
        //Удаление замены
        deleteItem(id)
        {
            confirm("Вы действительно хотите удалить замену?") &&
                replacements_api
                    .deleteFile({id: id})
                    .then(res => {
                        alert("Удалена!");
                        this.changeFilter();
                    })
                    .catch(ex => {
                        console.log(ex);
                    });
        },
        //Получение групп для отделения
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
        //Получение замен с учётом фильтров
        changeFilter() 
        {
            if(this.checkAllGroup && this.checkAllDate) //Получить все замены для всех дат и групп
            {
                replacements_api
                .getAllReplacements()
                .then(res => {
                    this.replacements = res.data.replacements;
                    console.log(res.data);
                    this.parseReplacement();
                })
                .catch(ex => {
                    console.log(ex);
                });
            }
            else
            if (this.checkAllGroup)
            {
                replacements_api
                .getAllReplacementsByDate({date: this.dateDialog.date})
                .then(res => {
                    this.replacements = res.data.replacements;
                    this.parseReplacement();
                })
                .catch(ex => {
                    console.log(ex);
                });
            }
            else
            if (this.checkAllDate)
            {
                replacements_api
                .getAllReplacementsByGroup({group_id: this.groups_info.selected_group.id})
                .then(res => {
                    this.replacements = res.data.replacements;
                    this.parseReplacement();
                })
                .catch(ex => {
                    console.log(ex);
                });
            }
            else
            {
                replacements_api
                .getReplacements({group_id: this.groups_info.selected_group.id, date: this.dateDialog.date})
                .then(res => {
                    this.replacements = res.data.replacements;
                    this.parseReplacement();
                })
                .catch(ex => {
                    console.log(ex);
                });
            }
        },
        //Перевод json в массив
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
    beforeMount() {
        this.groups_info = this._groups_info;
        this.departaments_info = this._departaments_info;
        this.replacements = JSON.parse(this._replacements);
        this.parseReplacement();
    }
};
</script>