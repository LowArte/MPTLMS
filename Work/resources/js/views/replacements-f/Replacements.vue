<template lang="pug">
v-content.ma-0.pa-2
  v-layout.column.wrap
    c-comfirm-dialog(ref='qwestion')              
    v-flex
      v-card.mx-auto(min-width="300" v-if="user")
        v-system-bar(dark color="info")
          span(style="color: white;") Фильтры
        v-combobox.mx-3.mt-6(dense label="Специальность" no-data-text="Нет данных" @change="department_change" item-text="dep_name_full" :items="specialities" v-model="selected_department" )
        v-combobox.mx-3.my-2(dense label="Группа" no-data-text="Нет данных" @change="changeFilter" item-text="group_name" :items="combo_groups" v-model="selected_group")
        router-link(v-if="user.post_id == 1 || user.post_id == 4" class='nounderline' :to="'bild_replacements'") 
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
//?----------------------------------------------
//!           Подключение дополнительных библиотек
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Всплывающее сообщение
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка
import ConfirmDialog_C from "@/js/components/expention-f/ConfirmDialog"; //Диалог Да/Нет

import api_department from "@/js/api/department"; //Расписания звонков
import api_replacement from "@/js/api/replacement"; //api замен

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
    "c-comfirm-dialog": ConfirmDialog_C
  },

  //*Вычисляемые свойства
  post_name: {
    name: "Замены расписания",
    url: "replacements"
  },

  computed: {
    ...mapGetters(["specialities", "groups_combo", "user"]),
    
    combo_groups: function() {
      if (!this.groups_combo) return undefined;
      this.selected_group = this.groups_combo[0];
      return this.groups_combo;
    },

    //*Получение четности недели
    isChisl: function() {
      var year = new Date().getFullYear();
      var month = new Date().getMonth();
      var today = new Date(year, month, 0).getTime();
      var now = new Date().getTime();
      var week = Math.round((now - today) / (1000 * 60 * 60 * 24 * 7));
      return week % 2;
    }
  },

  data() {
    return {
      selected_department: null,
      selected_group: null,
      checkAllGroup: false, //Все группы
      checkAllDate: false, //Все даты
      parseReplacements: null, //Замены
      replacements: null, //Замены
      arrgroups: [],
      date: [],
      dateDialog: {
        model: false,
        date: new Date().toISOString().substr(0, 10)
      } //Диалог даты
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

    //Перевод массив для вывода
    parseReplacement() 
    {
      this.arrgroups = [];
      this.date = [];
      this.parseReplacements = [];
      var j = -1; //Индекс группы
      var l = -1; //Индекс даты
      for (var i = 0; i < this.replacements.length; i++) 
      {
        this.replacements[i]["swap"] = JSON.parse(this.replacements[i]["swap"]);
        this.replacements[i]["swap"]["lesson"] = this.replacements[i]["swap"]["lesson"].join(" / ");
        this.replacements[i]["swap"]["oldlesson"] = this.replacements[i]["swap"]["oldlesson"].join(" / ");
        this.replacements[i]["swap"]["teacher"] = this.replacements[i]["swap"]["teacher"].join(" / ");
        this.replacements[i]["swap"]["oldteacher"] = this.replacements[i]["swap"]["oldteacher"].join(" / ");
        
        j = this.arrgroups.indexOf(this.replacements[i]["group_name"]);
        if (j == -1) 
        {
          this.arrgroups.push(this.replacements[i]["group_name"]);
          this.date.push([this.replacements[i]["swap_date"]]);
          this.parseReplacements.push([[this.replacements[i]]]);
        } 
        else 
        {
          l = this.date[j].indexOf(this.replacements[i]["swap_date"]);
          if (l == -1) 
          {
            this.date[j].push(this.replacements[i]["swap_date"]);
            this.parseReplacements[j].push([this.replacements[i]]);
          } 
          else 
          this.parseReplacements[j][l].push(this.replacements[i]);
        }
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
      {
        this.selected_group = this.combo_groups[0];
        this.group_change();
      }
    },

    //*Получение расписания при изменении выбранной группы
    async group_change() 
    {
      this.changeFilter();
    },

    //Удаление замены
    deleteItem(id) 
    {
      this.$refs.qwestion.pop().then(confirmResult => {
        if (confirmResult) 
        {
          if(api_replacement.deleteReplacement(id, this))
            this.changeFilter();
        } 
        else 
        {
          this.showInfo("Действие было отменено");
        }
      });
    },

    //Получение замен с учётом фильтров
    async changeFilter() 
    {
      this.showLoading("Получение замен");
      if (this.checkAllGroup && this.checkAllDate) 
        //Получить все замены для всех дат и групп
        this.replacements = await api_replacement.getReplacements(this)
      else 
      if (this.checkAllGroup) 
        //Получить замены для всех групп
        this.replacements = await api_replacement.getReplacementsByDate(this.dateDialog.date, this)
      else 
      if (this.checkAllDate) 
        //Получить все замены для всех дат
        this.replacements = await api_replacement.getReplacementsByGroup(this.selected_group.id, this);
      else 
      {
        this.replacements = await api_replacement.getReplacementsByGroupByDate(
        {
          group_id: this.selected_group.id,
          date: this.dateDialog.date
        }, this);
      }

      if (this.replacements != null)
          this.parseReplacement();
      this.closeLoading("Получение замен");
    },
 }
};
</script>