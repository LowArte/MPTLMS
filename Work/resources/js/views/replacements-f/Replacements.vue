<template lang="pug">
v-content.ma-0.pa-2
  v-layout.column.wrap
    c-comfirm-dialog(ref='qwestion')              
    v-flex
      v-card.mx-auto(min-width="300")
        v-system-bar(dark color="info")
          span(style="color: white;") Фильтры
        v-combobox.mx-3.mt-6(dense label="Специальность" @change="departament_change" item-text="dep_name_full" :items="specialities" v-model="selected_departament" )
        v-combobox.mx-3.my-2(dense label="Группа" @change="changeFilter" item-text="group_name" :items="combo_groups" v-model="selected_group")
        router-link(v-if="user.post_id == 1 || user.post_id == 4" class='nounderline' :to="'/' + user.post.slug + '/bild_replacements'") 
          v-btn.ma-3(color="accent" text block dark) Конструктор замен
        v-switch.shrink.mx-3.my-2(dense v-model="checkAllGroup" color="primary" @change="changeFilter" block label="Изменения для всех групп")
        v-switch.shrink.mx-3.my-2(dense v-model="checkAllDate" color="primary" @change="changeFilter" block label="Изменения на имеющиеся даты")
  v-alert(border="left" dense type="warning")
      span.subtitle-1(primary--text) Обратите внимание, что изменения в расписании выкладываются каждый день с 17:00 и до 19:00 вечера
  v-layout.row.wrap(v-for="(groups_key, groups_index) in arrgroups" :key="groups_index")
      v-flex(v-for="(date_key, date_index) in date[groups_index]" :key="date_index")
        v-card.mx-auto(min-width="300")
          v-system-bar(dark color="accent")
            span(style="color: white;") Группа: {{groups_key}} 
            v-spacer
            span(style="color: white;") Дата: {{date_key}}
          v-simple-table
              thead
                  tr
                    th.text-left №
                    th.text-left Заменяемое
                    th.text-left Заменено на
                    th.text-left Дата замены
                    th.text-left(v-if="user.post_id == 1 || user.post_id == 4") Действие
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
                      td(v-if="user.post_id == 1 || user.post_id == 4")
                        v-icon.small(@click="deleteItem(replacement_key['id'])") delete      
</template>

<script>
import group_api from "@/js/api/group"; //api групп
import replacements_api from "@/js/api/replacements"; //api замен
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import departament_api from "@/js/api/departments"; //Api отделения
import ConfirmDialog_C from "@/js/components/expention-f/ConfirmDialog"; //Диалог confirm
import BildReplacement from "@/js/views/replacements-f/Bild_Replacements"; //Конструктор замен
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading

import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";

export default {
  computed: {
    ...mapGetters(["specialities", "groups_combo", "user"]),
    combo_groups: function() 
    {
      if (!this.groups_combo) return undefined;
      let groups = this.groups_combo.filter(res => {
        if (res.departament_id == this.selected_departament.id) {
          return true;
        }
        return false;
      });
      if (groups != null)
        this.selected_group = groups[0];
      return groups;
    }
  },
  post_name: {
    name: "Замены расписания",
    url: "replacements"
  },
  mixins: [withSnackbar, withOverlayLoading],

  components: {
    "c-comfirm-dialog": ConfirmDialog_C,
    c_bildReplacement: BildReplacement
  },

  data: () => ({
    selected_group:null, //Группы
    selected_departament:null, //Отделения
    parseReplacements: null, //Замены
    replacements: null, //Замены
    checkAllGroup: false, //Все группы
    checkAllDate: false, //Все даты
    arrgroups: [],
    date: [],
    start: true,
    titleDialog: "Конструктор замен",
    dialog: false,
    dateDialog: {
      model: false,
      date: new Date().toISOString().substr(0, 10)
    } //Диалог даты
  }),

  methods: {
    //Запрос для получения всех необходимых данных
    async getAllData()
    {
      this.showLoading("Получение даннах");
      this.closeLoading("Получение даннах");
    },

    //Получение отделений
    async getDepartament()
    {
      this.showLoading("Получение отделений");
      if (this.specialities == null)
      {
        let items = await departament_api.getDepartments(this);
        this.$store.commit(mutations.SET_SPECIALITIES_FULL,items);
      }
      this.closeLoading("Получение отделений");
      
      if(this.specialities)
      {
        this.selected_departament = this.specialities[0];
        this.departament_change();
      }
    }, 

    //Удаление замены
    deleteItem(id) 
    {
      this.$refs.qwestion.pop().then(confirmResult => {
        if (confirmResult) 
        {
          if(replacements_api.deleteReplacement(id, this))
            this.changeFilter();
        } 
        else 
        {
          this.showInfo("Действие было отменено");
        }
      });
    },

    //Получение групп для отделения
    async departament_change() 
    {
      this.showLoading("Получение групп");
      if (this.groups_combo == null)
      {
        let items = await group_api.getGroupsForComboboxRecursive(this);
        this.$store.commit(mutations.SET_GROUPS_COMBO, items)
      }
      this.closeLoading("Получение групп");

      if(this.groups_combo)
      {
        //Отображение отделения и группы студента
        if(this.user.post_id == 2 && this.start) 
        {
          for(let i = 0; i < this.groups_combo.length; i++)
          {
            if(this.groups_combo[i].id == this.user.student.group_id)
            {
              this.selected_group = this.groups_combo[i];
              i = this.groups_combo.length;
            }
          }

          for(let i = 0; i < this.specialities.length; i++)
          {
            if (this.selected_group.departament_id == this.specialities[i].id) 
            {
              this.selected_departament = this.specialities[i];
              i = this.specialities.length;
            }
          }
          this.start = false;
        }
        else
          this.selected_group = this.combo_groups[0];
        this.changeFilter();
      }
    },

    //Получение замен с учётом фильтров
    async changeFilter() {
      this.showLoading("Получение замен");
      if (this.checkAllGroup && this.checkAllDate) 
        //Получить все замены для всех дат и групп
        this.replacements = await replacements_api.getReplacements(this)
      else 
      if (this.checkAllGroup) 
        //Получить замены для всех групп
        this.replacements = await replacements_api.getReplacementsByDate(this.dateDialog.date, this)
      else 
      if (this.checkAllDate) 
        //Получить все замены для всех дат
        this.replacements = await replacements_api.getReplacementsByGroup(this.selected_group.id, this);
      else 
      {
        this.replacements = await replacements_api.getReplacementsByGroupByDate(
        {
          group_id: this.selected_group.id,
          date: this.dateDialog.date
        }, this);
      }

      if (this.replacements != null)
          this.parseReplacement();
      this.closeLoading();
    },

    //Перевод массив для вывода
    parseReplacement() 
    {
      this.arrgroups = [];
      this.date = [];
      this.parseReplacements = [];
      var j = -1; //Индекс группы
      var l = -1; //Индекс даты
      for (var i = 0; i < this.replacements.length; i++) {
        this.replacements[i]["swap"] = JSON.parse(this.replacements[i]["swap"]);
        if (Array.isArray(this.replacements[i]["swap"]["lesson"]))
          this.replacements[i]["swap"]["lesson"] = this.replacements[i]["swap"][
            "lesson"
          ].join(" / ");
        if (Array.isArray(this.replacements[i]["swap"]["oldlesson"]))
          this.replacements[i]["swap"]["oldlesson"] = this.replacements[i][
            "swap"
          ]["oldlesson"].join(" / ");
        if (Array.isArray(this.replacements[i]["swap"]["teacher"]))
          this.replacements[i]["swap"]["teacher"] = this.replacements[i][
            "swap"
          ]["teacher"].join(" / ");
        if (Array.isArray(this.replacements[i]["swap"]["oldteacher"]))
          this.replacements[i]["swap"]["oldteacher"] = this.replacements[i][
            "swap"
          ]["oldteacher"].join(" / ");
        j = this.arrgroups.indexOf(this.replacements[i]["group_name"]);
        if (j == -1) {
          this.arrgroups.push(this.replacements[i]["group_name"]);
          this.date.push([this.replacements[i]["swap_date"]]);
          this.parseReplacements.push([[this.replacements[i]]]);
        } else {
          l = this.date[j].indexOf(this.replacements[i]["swap_date"]);
          if (l == -1) {
            this.date[j].push(this.replacements[i]["swap_date"]);
            this.parseReplacements[j].push([this.replacements[i]]);
          } else this.parseReplacements[j][l].push(this.replacements[i]);
        }
      }
    }
  },

  //Начальный метод
  beforeMount() {
    this.getAllData();
    this.getDepartament();
  }
};
</script>