<template lang='pug'>
  v-dialog(v-model="dialog" hide-overlay fullscreen  transition="dialog-bottom-transition" )
    template(v-slot:activator="{ on }")
      v-btn(@click="parse" text) Поиск замен
    v-card
      v-app-bar(app elevate-on-scroll color='white')
        v-btn(icon @click="dialog = false")
          v-icon mdi-close
        v-toolbar-title Изменения в рассписании
        v-spacer
        v-toolbar-items
          v-btn(color="info darken-1" @click="save" text) Применить
      v-content
        v-container(v-for="(swapKey,id) in Object.keys(swaps)" :key="id")    
          v-card-text.display-1 {{swapKey}}
          div(v-for="(swap,swap_id) in swaps[swapKey]" :key="swap_id")
            v-card-text.headline Группа: 
              b {{swap.group}}
              span(v-if="swaps_result")
                v-tooltip(top v-if="swaps_result[swap.group].added && swaps_result[swap.group].discipline  && swaps_result[swap.group].teacher && swaps_result[swap.group].group" )
                  template(v-slot:activator="{ on }")
                    v-icon(v-on="on" large color="#008000") done
                  span Успешно добавлено
                v-tooltip(top v-if="!swaps_result[swap.group].group")
                  template(v-slot:activator="{ on }")
                    v-icon(v-on="on" large color="#FF0000") error_outline
                  span Отсутствует группа
                v-tooltip(top v-if="!swaps_result[swap.group].discipline" )
                  template(v-slot:activator="{ on }")
                    v-icon(v-on="on" large color="#FF0000") layers_clear
                  span Дисциплина не была найдена
                v-tooltip(top v-if="!swaps_result[swap.group].teacher")
                  template(v-slot:activator="{ on }")     
                    v-icon(v-on="on" large color="#FF0000") person_add_disabled
                  span Преподаватель не был найден
            v-simple-table
              template(v-slot:default)
                thead
                  tr(style="display:flex;")
                    th(width="65") Пара
                    th.lesson Что заменяют
                    th.lesson На что заменяют
                    th(width="180") Замена добавлена
                tbody     
                  tr(style="display:flex;" v-for="(oneswap,oneswap_id) in swap.swap" :key="oneswap_id")
                    td.text-left(width="65") {{oneswap.caselesson}}
                    td.text-left.lesson {{oneswap.what}}
                    td.text-left.text-left.lesson {{oneswap.lesson+" " + oneswap.teacher.join(",")}}
                    td.text-left(width="180") {{oneswap.created_at}}
</template>

<script>
import api_parser from "@/js/api/parser"
export default {
  data() {
    return {
      dialog:false,
      swaps:{},
      swaps_result:null,
      headers:[
        {
          text:"Пара",
          value:"caselesson"
        },        
        {
          text:"Что заменяют",
          value:"what"
        },     
        {
          text:"На что заменяют",
          value:"lesson+ ' ' + teacher.join(',')"
        },        
        {
          text:"Замена добавлена",
          value:"created_at"
        }
      ]
    };
  },
  
  methods: {
   async parse(){
      this.swaps = await api_parser.parse();
      console.log(this.swaps);
      this.dialog = true;
    },
    async save(){
      this.swaps_result = await api_parser.save(this.swaps);    
      console.log(this.swaps_result)
    }
  } 
};
</script>

<style lang="scss" scoped>
.lesson{
  flex:1 1;
  overflow:auto;
}
</style>

