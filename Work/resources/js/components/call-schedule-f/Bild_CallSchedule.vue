<template lang="pug">
  v-layout.row
    v-layout.col(cols="12")
      v-hover(v-slot:default='{ hover }')
        v-card.mx-auto.pa-4.max(width='100%' height='auto' :elevation='hover ? 12 : 2')
          v-form(ref="BildCallSchedule" v-model="valid")
            v-card-text(text-center title) Расписание звонков
              v-select.pa-0.mb-0.mt-2(v-model="mplace" label="Место проведения" solo :items="timeTable" item-text="place" return-object)
            v-container.pt-0(grey lighten-5)
              v-layout.row(no-gutters v-for="(value) in Object.keys(timeTable[mplace.i].schedule)" :key="value" sm="6" md="4" lg="3")
                v-layout.v-col
                  v-card.pa-2(width='100%' outlined tile) {{value}} пара
                    v-text-field(hint="(ЧЧ:ММ-ЧЧ:ММ)"
                      v-model="timeTable[mplace.i].schedule[value]"
                      v-mask="mask"
                      :rules="inputRules"
                      label="Начало/конец пары")
              v-layout.row.pa-0.align-self-center.justify-center(sm="2" md="0")
                v-btn.justify-center(color="accent" dark @click="sendQuery") Принять
</template>

<script>
import { mask } from "vue-the-mask"; //Маска
import callScedule from "../../api/callSchedule"; //api для расписания звонков
export default {
  directives: {
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
  props: {
    _time_table: {
      type: String,
      default: null
    }
  }, //JSON расписания звонков
  created: function() {
    let arr = JSON.parse(this._time_table); //Получение массива
    for (let i = 0; i < arr.length; i++) {
      arr[i].schedule = JSON.parse(arr[i].schedule);
      arr[i].i = i;
      this.mplace = arr[0];
    } //Распарсирование массива
    this.timeTable = arr; //Массив с расписанием
    console.log(this.timeTable);
  },
  methods: {
    sendQuery() {
      //Проверка на валидацию полей, после чего происходит отправка на сохранение
      if (this.$refs.BildCallSchedule.validate()) {
        callScedule
          .save({ data: this.timeTable })
          .then(res => {
            alert("Расписание звонков принято!");
          })
          .catch(ex => {
            alert("Расписание не было добавлено!");
            console.log(ex);
          });
      }
    }
  }
};
</script>