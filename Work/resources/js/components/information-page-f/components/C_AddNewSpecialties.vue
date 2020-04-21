<template lang="pug">
    v-flex.my-2
      v-card.mx-auto(width='420px' color="info" lighten-2 style='display: flex; flex-direction: column;' height='100%')
        v-dialog(v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition")
          template(v-slot:activator="{ on }")
            v-btn.mx-auto.my-auto(fab text dark large v-on="on")
              v-icon mdi-plus
          v-card
            v-toolbar(color="white")
              v-btn(icon dark @click="dialog = false")
                v-icon(color="primary") mdi-close
              v-toolbar-title(text--primary) Новая специальность
              v-spacer
              v-btn(color="success" @click="add") Сохранить
            v-content.pa-0
              v-card.ma-2.pt-3
                v-form(ref="spec")
                  v-text-field.ma-2(v-model="item.image" :rules="allRules" label="Ссылка на картинку")
                  v-text-field.ma-2(v-model="item.dep_name_full" :rules="allRules" label="Название специальности")
                  v-text-field.ma-2(v-model="item.qualification" :rules="allRules" label="Квалификация")
                  v-text-field.ma-2(outlined v-model="item.info.text" :rules="allRules" label="Описание")
                  v-autocomplete.ma-2(v-model="item.studysperiod" :items="studysperiods" :rules="allRules" label="Период обучения")
                  v-alert.mx-2(text dense type="warning")
                    span Перечислите все необходимые подразделы, которые хотите отображать в подробной информации о специальностях
                  v-card.pa-3.pt-1.mt-1(v-for="(info,i) in Object.keys(item.info)" :key="i" v-if="info != 'text'")
                    v-card-text.title {{info}}
                      v-btn(icon x-small @click="deleteInfo(info)")
                        v-icon.pa-0.ma-0 close     
                    v-row.pa-0(v-for="(itemInfo, j) in item.info[info]" :key="j")
                      v-col.pa-0(lg="2")
                          v-text-field.ma-2(v-model="item.info[info][j]" :rules="allRules" outlined multi-line label="Введите текст" v-on:keyup.enter="addElementInfo(info)")
                      v-col.pa-0(sm ="1")
                          v-card-actions
                              v-btn(color="primary" dark @click="deleteElementInfo(info)" icon x-small)
                                  v-icon.pa-0.ma-0 close
                    v-btn(outlined color="primary" block dark @click="addElementInfo(info)")
                      v-icon.pa-0.ma-0 add
                  v-form.mt-3(ref="add")
                    v-dialog(v-model="dialogAdd" persistent max-width="500px")
                      template(v-slot:activator="{ on }")
                        v-card-actions              
                          v-spacer
                          v-btn.ma-1.white--text(depressed color="accent" v-on="on") Добавить новый подраздел
                      v-card
                        v-card-title.headline.grey.lighten-2.primary-title Подзаголовок
                        v-text-field.ma-2(v-model="title" :rules="titleRules" v-on:keyup.enter="addInfo()" outlined multi-line label="Название подзаголовка")
                        v-divider
                        v-card-actions
                          v-btn(color="primary" text @click="dialogAdd = false; title = ''") Отмена
                          v-spacer
                          v-btn(color="primary" text @click="addInfo()") Добавить                                      
</template>

<script>
import withSnackbar from "@/js/components/mixins/withSnackbar";
import * as mutations from "@/js/store/mutation-types";

export default {
  mixins: [withSnackbar],
  data() {
    return {
      dialog: false,
      dialogAdd: false,
      studysperiods:[
        "3 года 10 месяцев",
        "2 года 10 месяцев",
        "1 год 10 месяцев",
      ],
      title: null,
      item: {
        dep_name_full: null,
        image: null,
        qualification: null,
        studysperiod:"3 года 10 месяцев",
        info: {
          text: null
        }
      }, 
      allRules: [v => !!v || "Поле не должно оставаться пустым"],
      titleRules: [
        v => !!v || "Поле не должно оставаться пустым",
        v =>
          /^[A-Z && А-Я && a-z && а-я && 0-9]*$/.test(v) ||
          "Только буквы или целочисленные значения (0-9)"
      ],
    };
  },

  methods:
  {
    add() 
    {
      if(this.$refs.spec.validate())
      {
        let data = this.item;
        this.$store.dispatch(mutations.ADD_SPECIALITIE,{context:this, result:data});
        this.item = {
          dep_name_full: null,
          image: null,
          qualification: null,
          info: {
            text: null         
          }
        };
        this.dialog = false;
      }
      else
        this.showError("Заполните корректно поля!");
      
    }, 

    addInfo()
    {
      if(this.$refs.add.validate())
      {
        let keys = Object.keys(this.item.info); 
        if(keys.indexOf(this.title) > -1)
        { 
          this.title = "";
          this.showError("Имя уже зарезервировано!");
        }
        else
        {
          this.item.info[this.title] = [""];
          this.title = "";
          this.dialogAdd = false;
        }
      }
      else
        this.showError("Заполните корректно название подзаголовка!");
    },

    deleteInfo(name)
    {
      delete this.item.info[name];
      var item = this.item;
      this.$forceUpdate();
      this.item = item;
    }, 

    addElementInfo(name)
    {
      this.item.info[name].push("");
      var item = this.item;
      this.$forceUpdate();
      this.item = item;
    },

    deleteElementInfo(name,  id)
    {
      let keys = Object.keys(this.item.info); 
      this.item.info[name].splice(id, 1);
      var item = this.item;
      this.$forceUpdate();
      this.item = item;
    }
  }
};
</script>