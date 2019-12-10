<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <v-hover v-slot:default="{ hover }">
          <v-form ref="CallSchedule" v-model="valid">
            <v-card :elevation="hover ? 10 : 5" class="mx-auto" height="auto" width="max">
              <v-card-text class="text-center title">
                Расписание звонков
                <v-select
                  class="pa-0 mb-0 mt-2"
                  v-model="mplace"
                  label="Место проведения"
                  solo
                  :items="places"
                  return-object
                  @change="getIndex"
                ></v-select>
              </v-card-text>
              <v-container class="grey lighten-5 pt-0">
                <v-row
                  no-gutters
                  v-for="(value) in Object.keys(rendererTime)"
                  :key="value"
                  sm="6"
                  md="4"
                  lg="3"
                >
                  <v-col>
                    <v-card class="pa-2" outlined tile>
                      {{value}} пара
                      <v-text-field
                        hint="(ЧЧ:ММ-ЧЧ:ММ)"
                        v-model="rendererTime[value]"
                        v-mask="mask"
                        :rules="inputRules"
                        label="Начало/конец пары"
                      ></v-text-field>
                    </v-card>
                  </v-col>
                </v-row>
                <v-card-text class="text-center title">
                  <v-btn color="accent" dark class="align-self-end" @click="sendQuery">Принять</v-btn>
                </v-card-text>
              </v-container>
            </v-card>
          </v-form>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mask } from "vue-the-mask";
import callScedule from "../../api/callSchedule";
export default {
  directives: {
    mask
  },
  data: () => ({
    places: [],
    valid: false,
    rendererTime: null,
    mask: "##:##-##:##",
    inputRules: [
        v =>/^([01]\d|2[0-3]):?([0-5]\d)-?([01]\d|2[0-3]):?([0-5]\d)$/.test(v) ||
          "Не соответствует формату времени"
      ],
    mplace: null,
    timeTable: null,
    date: null
  }),
  props: {
    _time_table: {
      type: String,
      default: null
    }
  },
  created: function() {
    let arr = JSON.parse(this._time_table);
    for (let i = 0; i < arr.length; i++) {
      arr[i].schedule = JSON.parse(arr[i].schedule);
    }
    this.table = arr;
    console.log(this.table);
  },
  methods: {
    sendQuery() {
      if (this.$refs.CallSchedule.validate()) {
        callScedule
          .save({ data: this.timeTable })
          .then(res => {
            alert("Расписание звонков принято!");
          })
          .catch(ex => {
            console.log(ex);
          });
      }
    },
    getIndex() {
      for (var i = 0; i < this.places.length; i++)
        if (this.places[i] == this.mplace) {
          this.rendererTime = this.timeTable[i].call_schedule;
          console.log(this.timeTable[i]);
        }
    }
  }
};
</script>