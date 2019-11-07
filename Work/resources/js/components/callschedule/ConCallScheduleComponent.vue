<template>
  <v-container fluid>
    <v-row>
      <v-col>
        <v-hover v-slot:default="{ hover }">
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
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mask } from "vue-the-mask";
import callScedule from '../../api/callSchedule'
import callSchedule from '../../api/callSchedule';
export default {
  directives: {
    mask
  },
  data: () => ({
    places: [],
    rendererTime:null,
    mask: "##:##-##:##",
    mplace: null,
    timeTable: null
  }),
  props: {
    place: {
      type: String,
      default: null
    },
    time: {
      type: String,
      default: null
    }
  },
  created: function() {
    var arr = JSON.parse(this.place);
    this.places = [];
    for (var i = 0; i < arr.length; i++) 
      this.places.push(arr[i].place_name);

    this.timeTable = JSON.parse(this.time);
    for (var i = 0; i < this.timeTable.length; i++)
      this.timeTable[i].call_schedule = JSON.parse(this.timeTable[i].call_schedule);
    this.mplace = this.places[0];

    this.timeTable[1].call_schedule["1"] = "00:00-00:00";
    console.log(this.timeTable[0].call_schedule);
    this.rendererTime = this.timeTable[0].call_schedule;
  },
  methods: {
    sendQuery() {
      callSchedule.save({"data":this.timeTable}).then(res=>{
        alert("Расписание звонков принято!");
      }).catch(ex=>{
        console.log(ex);
      });
    },
    getIndex() {
      for (var i = 0; i < this.places.length; i++)
        if (this.places[i] == this.mplace) {
          this.rendererTime = this.timeTable[i].call_schedule
          console.log(this.timeTable[i])
        }
    }
  }
};
</script>