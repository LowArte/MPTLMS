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
            {{indexplace}}
            <v-container class="grey lighten-5 pt-0">
              <v-row no-gutters v-for="n in time[indexplace].call_schedule" :key="n" sm="6" md="4" lg="3">
                <v-col>
                  <v-card class="pa-2" outlined tile>
                    {{n}} пара
                    {{indexplace}}
                    <v-text-field
                      hint="(ЧЧ:ММ-ЧЧ:ММ)"
                      v-model="time[indexplace].call_schedule[n]"
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
    {{indexplace}}
  </v-container>
</template>

<script>
import { mask } from "vue-the-mask";
export default {
  directives: {
    mask
  },
  data: () => ({
    places: [],
    mask: "##:##-##:##",
    mplace: null,
    time: null,
    indexplace: 0
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
    console.log(JSON.parse(JSON.parse(this.time)[0].call_schedule));

    var arr = JSON.parse(this.place);
    this.places = [];
    for (var i = 0; i < arr.length; i++) this.places.push(arr[i].place_name);

    this.time = JSON.parse(this.time);
    for (var i = 0; i < this.time.length; i++)
      this.time[i].call_schedule = JSON.parse(this.time[i].call_schedule);
    this.mplace = this.places[0];

    this.time[1].call_schedule[1] = "00:00-00:00";
  },
  methods: {
    sendQuery() {
      //Вписывай отправку
      alert("Расписание звонков принято!");
    },
    getIndex() {
      for (var i = 0; i < this.places.length; i++)
        if (this.places[i] == this.mplace) this.indexplace = i;
    }
  }
};
</script>