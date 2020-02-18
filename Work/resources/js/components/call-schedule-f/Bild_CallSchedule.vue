<template lang="pug">
  v-layout.row
    v-card.mx-auto.pa-2(width='100%' height='auto')
      v-form(ref="BildCallSchedule" v-model="valid")
        v-card-text(text-center title) Расписание звонков
          v-select.pa-0.mb-0.mt-2(v-model="mplace" label="Место проведения" solo :items="_places" item-value='id' item-text='place_name')
          v-card.pa-2(width='100%' outlined tile v-for="(value) in Object.keys(timeTable[mplace-1].schedule)" :key="value") {{value}} пара
            v-text-field(hint="(ЧЧ:ММ-ЧЧ:ММ)"
              v-model="timeTable[mplace-1].schedule[value]"
              v-mask="mask"
              :rules="inputRules"
              label="Начало/конец пары")
          v-btn.mt-2.justify-center(color="accent" block dark @click="sendQuery") Принять
</template>

<script>
import { mask } from "vue-the-mask"; //Маска
import callScedule from "../../api/callSchedule"; //api для расписания звонков
import withSnackbar from "../mixins/withSnackbar"; //Alert

export default {
  mixins: [withSnackbar],

  directives:
  {
    mask  //Маска
  },
  
  data: () => ({
    valid: false, //Валидация формы
    mask: "##:##-##:##", //Маска расписания звонка
    inputRules: [
      v =>
        /^([01]\d|2[0-3]):?([0-5]\d)-?([01]\d|2[0-3]):?([0-5]\d)$/.test(v) ||
        "Не соответствует формату времени"
    ], //Правила для прохождения валидации
    mplace: null, //Выбранное место проведения
    timeTable: null, //Расписание звонков
  }),

  props: 
  {
    _time_table: {
      type: Array,
      default: null
    }, //Массив с расписанием
    _places: {
      type: Array,
      default: null
    } //Массив с местами проведения
  },

  created: function() 
  {
    this.timeTable = this._time_table; 
    this.mplace = this._places[0].id;
  },

  methods: 
  {
    sendQuery() 
    {
      //Проверка на валидацию полей, после чего происходит отправка на сохранение
      if (this.$refs.BildCallSchedule.validate()) 
      {
        callScedule
          .edit(this.timeTable)
          .then(res => {
           this.showMessage("Расписание звонков принято!");
          })
          .catch(ex => {
            this.showError("Расписание не было добавлено! " + ex);
          });
      }
    }
  }
};
</script>