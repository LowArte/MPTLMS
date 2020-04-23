<template lang="pug">
v-content.ma-0.pa-2
  v-layout.row
    v-card.mx-auto(width='100%' height='auto')
      v-system-bar
        span Расписание звонков
      v-form.pa-2(ref="BildCallSchedule" v-model="valid" v-if="timeTable != null && timeTable[mplace-1] != null && timeTable[mplace-1].schedule != null")
        v-select.pa-0.mb-0.mt-2(v-model="mplace" label="Место проведения" outlined :items="places" item-value='id' item-text='place_name')
        v-card.pa-2.py-0(width='100%' v-for="(value) in Object.keys(timeTable[mplace-1].schedule)" :key="value" :elevation='0' flat) {{value}} пара
          v-text-field(hint="(ЧЧ:ММ-ЧЧ:ММ)"
            v-model="timeTable[mplace-1].schedule[value]"
            v-mask="mask"
            :rules="inputRules"
            label="Начало/конец пары")
        v-btn.mt-2.justify-center(color="accent" block dark @click="sendQuery") Принять
</template>

<script>
import { mask } from "vue-the-mask"; //Маска
import api_call_schedule from "@/js/api/callSchedule"; //api для расписания звонков
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Оповещения
import api_place from "@/js/api/place"; //Api мест проведений
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Loading
import { mapGetters } from "vuex";
import * as mutations from "@/js/store/mutation-types";
import * as actions from "@/js/store/action-types";

export default {
  computed:{
    ...mapGetters(["call_schedule", "places"]),
  },
  
  post_name: {
    name: "Конструктор звонков",
    url: "bild_call_schedule"
  },
  mixins: [withSnackbar, withOverlayLoading],

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

  //Преднастройка
  beforeMount(){
    this.getPlaces();
    this.getCallSchedule();
  },

  methods: 
  {
    //Получение мест проведений
    async getPlaces()
    {
      this.showLoading("Получение мест проведения");
      if(this.places == null)
      {
        let items = await api_place.getPlaces(this);
        this.$store.commit(mutations.SET_PLACES_FULL, items)
      }

      if (this.places)
        this.mplace = this.places[0].id;
      this.closeLoading("Получение мест проведения");
    },

    async getCallSchedule()
    {
      this.showLoading("Получение расписания");
      if(this.call_schedule == null)
      {
        this.timeTable = await api_call_schedule.getCallSchedule(this);
        await this.$store.commit(mutations.SET_CALL_SCHEDULE, JSON.parse(JSON.stringify(this.timeTable)));
      }
      else
        this.timeTable = JSON.parse(JSON.stringify(this.call_schedule));
      this.closeLoading("Получение расписания");
    },

    async sendQuery() 
    {
      //Проверка на валидацию полей, после чего происходит отправка на сохранение
      if (this.$refs.BildCallSchedule.validate()) 
      {
        this.$store.dispatch(actions.EDIT_CALL_SCHEDULE,{ context: this, result: JSON.parse(JSON.stringify(this.timeTable)) });
      }
      else
        this.showError("Заполните корректно поля!");
    }
  }
};
</script>