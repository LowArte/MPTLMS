<template lang="pug">
v-content.ma-0.pa-2
  v-layout.column.wrap
    c-comfirm-dialog(ref='qwestion')              
    v-flex
      v-card.mx-auto(min-width="300" v-if="user")
        v-system-bar
          span Фильтры
        v-combobox.mx-3.mt-6(dense outlined label="Специальность" no-data-text="Нет данных" @change="department_change" item-text="dep_name_full" :items="specialities" v-model="selected_department" )
        v-combobox.mx-3.my-2(dense outlined label="Группа" no-data-text="Нет данных" @change="changeFilter()" item-text="group_name" :items="groups" v-model="selected_group")
        v-dialog(ref="dateDialog" v-model="dateDialog.model" :return-value.sync="dateDialog.date" persistent width="290px")
          template(v-slot:activator="{ on }")
            v-text-field.mx-3(dense outlined v-model="dateDialog.date" label="Дата" readonly v-on="on")
          v-date-picker(:allowed-dates="val => new Date(val).getDay() != 0" :min='new Date().toISOString().substr(0, 10)' v-model="dateDialog.date" scrollable :first-day-of-week="1" locale="ru-Ru")
              v-btn(text color="primary" @click="dateDialog.model = false") Отмены
              v-spacer
              v-btn(text color="primary" @click="$refs.dateDialog.save(dateDialog.date); changeFilter()") Принять
        v-content.pa-1(v-if="user != null && user.post_id != null")
          router-link(v-if="user.post_id == 1 || user.post_id == 4" class='nounderline' :to="'bild_replacements'") 
            v-btn(color="accent" text block dark) Конструктор замен
        v-switch.shrink.mx-3.my-2(v-if="user.post_id == 3" dense v-model="isTeacher" color="primary" @change="changeFilter" block label="Мои замены")
        v-switch.shrink.mx-3.my-2(dense v-model="checkAllGroup" color="primary" @change="changeFilter" block label="Изменения для всех групп")
        v-switch.shrink.mx-3.my-2(dense v-model="checkAllDate" color="primary" @change="changeFilter" block label="Изменения на имеющиеся даты")
  v-alert(border="left" dense type="warning")
      span.subtitle-1(primary--text) Обратите внимание, что изменения в расписании выкладываются каждый день с 17:00 и до 19:00 вечера
  v-layout.row.wrap(v-for="(groups_key, groups_index) in arrgroups" :key="groups_index")
      v-flex(v-for="(date_key, date_index) in date[groups_index]" :key="date_index")
        v-card.mx-auto(min-width="300")
          v-system-bar
            span Группа: {{groups_key}} 
            v-spacer
            span Дата: {{date_key}}
          v-simple-table(v-if="user != null && user.post_id != null")
              thead(v-if="user != null && user.post_id != null")
                  tr
                    th.text-left №
                    th.text-left Заменяемое
                    th.text-left Заменено на
                    th.text-left(v-if="user.post_id == 1 || user.post_id == 4") Действие
              tbody(v-if="user != null && user.post_id != null")
                  tr(v-for="(replacement_key, replacement_index) in parseReplacements[groups_index][date_index]" :key="replacement_index")
                      td {{ replacement_key['swap']['caselesson'] }}
                      td(v-if="replacement_key['swap']['oldteacher'].length > 0") {{ replacement_key['swap']['oldlesson'].join(" / ") }} ({{ replacement_key['swap']['oldteacher_name'].join(" / ") }})
                      td(v-else-if="replacement_key['swap']['oldlesson'].length > 0") {{ replacement_key['swap']['oldlesson'].join(" / ") }}
                      td(v-else) Дополнительное занятие
                      td(v-if="replacement_key['swap']['teacher'].length > 0") {{ replacement_key['swap']['lesson'].join(" / ") }} ({{ replacement_key['swap']['teacher_name'].join(" / ") }})
                      td(v-else-if="replacement_key['swap']['lesson'].length > 0") {{ replacement_key['swap']['lesson'].join(" / ") }}
                      td(v-else) Занятие отменено
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
    url: "replacements",
    dop_com: [
      {
        url:"bild_replacements",
        path:"js/views/replacements-f/Bild_Replacements"
      }   
    ]
  },

  computed: {
    ...mapGetters(["specialities", "groups_combo", "user"]),
    
    combo_groups: function() {
      if (!this.groups_combo) return undefined;
      this.selected_group = this.groups_combo[0];
      return this.groups_combo;
    },

    filterReplacements: function(){
        if (!this.replacements) return undefined;
        let replacements = this.replacements.filter(res => {
            if(!this.selected_group)
                return false;
            var checkTeacher = false;
            if(this.isTeacher)
            {
              res['swap']['oldteacher'].forEach(element => {
                if(element == this.user.id)
                  checkTeacher = true;
              });
              res['swap']['teacher'].forEach(element => {
                if(element == this.user.id)
                  checkTeacher = true;
              });

              if(this.checkAllDate && this.checkAllGroup && checkTeacher)
                return true;
              if(this.checkAllDate && res.group_id == this.selected_group.id  && checkTeacher)
                  return true;
              if(res.swap_date == this.dateDialog.date && this.checkAllGroup  && checkTeacher)
                  return true;
              if(res.swap_date == this.dateDialog.date && res.group_id == this.selected_group.id  && checkTeacher)
                  return true;
            }
            else
            {
              if(this.checkAllDate && this.checkAllGroup)
                  return true;
              if(this.checkAllDate && res.group_id == this.selected_group.id)
                  return true;
              if(res.swap_date == this.dateDialog.date && this.checkAllGroup)
                  return true;
              if(res.swap_date == this.dateDialog.date && res.group_id == this.selected_group.id)
                  return true;
            }
            return false;
        });
        return replacements;
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
      groups: null,
      start: true,
      date: [],
      isTeacher: false,
      dateDialog: {
        model: false,
        date: new Date().toISOString().substr(0, 10)
      } //Диалог даты
    }
  },

  async beforeMount()
  {
    if(this.user.post_id == 3)
      this.isTeacher = true;
    this.showLoading("Получение замен");
    await this.Update();
    this.closeLoading("Получение замен");
    this.getDepartments();
    
  }, 

 methods: {
//?----------------------------------------------
//!           Методы страницы
//?----------------------------------------------
    async Update()
    {
      let items = await api_replacement.getReplacements()
      for (var i = 0; i < items.length; i++) 
        items[i]["swap"] = JSON.parse(items[i]["swap"]);
      this.replacements = items;
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
        if(this.start && this.user.post_id == 2)
          this.selected_department = this.user.student.group.department;
        else
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
      let fReplacements = this.filterReplacements;
      if(fReplacements)
      for (var i = 0; i < fReplacements.length; i++) 
      {       
        j = this.arrgroups.indexOf(fReplacements[i]["group_name"]);
        if (j == -1) 
        {
          this.arrgroups.push(fReplacements[i]["group_name"]);
          this.date.push([fReplacements[i]["swap_date"]]);
          this.parseReplacements.push([[fReplacements[i]]]);
        } 
        else 
        {
          l = this.date[j].indexOf(fReplacements[i]["swap_date"]);
          if (l == -1) 
          {
            this.date[j].push(fReplacements[i]["swap_date"]);
            this.parseReplacements[j].push([fReplacements[i]]);
          } 
          else 
          this.parseReplacements[j][l].push(fReplacements[i]);
        }
      }
      this.$forceUpdate();
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
        this.group_change();
      }
    },

    //*Получение расписания при изменении выбранной группы
    async group_change() 
    {
      this.changeFilter();
    },

    //Удаление замены
    async deleteItem(id) 
    {
      if(await this.$refs.qwestion.pop().then(res => { return res;}))
      {
        if(api_replacement.deleteReplacement(id))
        {
          await this.Update();
          this.showMessage("Замена удалена!");
          this.changeFilter();
        }
      }
      else 
          this.showInfo("Действие было отменено");
    },

    //Получение замен с учётом фильтров
    changeFilter() 
    {
      this.parseReplacement();
    },
 }
};
</script>