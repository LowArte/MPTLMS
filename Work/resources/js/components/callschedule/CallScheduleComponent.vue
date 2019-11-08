<template>
  <v-container fluid>
    <v-row>
      <v-col>
        <v-hover v-slot:default="{ hover }">
          <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-4" height="auto" width="max">
            <v-row>
              <v-col class="grey lighten-5 pt-0" v-for="(p, j) in places" :key="j">
                <v-card-text class="text-center title">{{p}}</v-card-text>
                <v-row
                  no-gutters
                  v-for="(value) in Object.keys(timeTable[j].call_schedule)"
                  :key="value"
                >
                  <v-col
                    v-if="timeTable[j].call_schedule[value]!=null && timeTable[j].call_schedule[value]!=''"
                  >
                    <v-card
                      class="pa-2"
                      outlined
                      tile
                    >{{value}} пара {{timeTable[j].call_schedule[value]}}</v-card>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mask } from "vue-the-mask";
import callScedule from "../../api/callSchedule";
import callSchedule from "../../api/callSchedule";
export default {
  directives: {
    mask
  },
  data: () => ({
    places: [],
    mplace: null,
    timeTable: null,
    date: null
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
    for (var i = 0; i < arr.length; i++) this.places.push(arr[i].place_name);

    this.timeTable = JSON.parse(this.time);
    for (var i = 0; i < this.timeTable.length; i++)
      this.timeTable[i].call_schedule = JSON.parse(
        this.timeTable[i].call_schedule
      );
    this.mplace = this.places[0];
  }
};
</script>