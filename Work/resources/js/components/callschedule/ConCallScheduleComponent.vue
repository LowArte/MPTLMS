<template>
  <v-container fluid>
    <v-row>
      <v-col>
        <v-hover v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto" height="auto" width="max">
            <v-card-text class="text-center title">
              Расписание звонков
              <v-autocomplete class="pa-0 mb-0 mt-2" v-model="mplace" label="Место проведения" solo :items="place"></v-autocomplete>
            </v-card-text>

            <v-container class="grey lighten-5 pt-0" fluid>
              <v-row no-gutters v-for="n in 7" :key="n" sm="6" md="4" lg="3">
                <v-col>
                  <v-card class="pa-2" outlined tile>
                    {{n}} пара
                    <v-text-field v-model="time1[n]" v-mask="mask" label="Начало/конец пары (00:00-00:00)"></v-text-field>
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
export default {
  directives: {
    mask
  },
  data: () => ({
    mask: "##:##-##:##",

    hidden: false,
    items: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    place: ["Нахимовский", "Неженская"],
    mplace: "",
    date: new Date().toISOString().substr(0, 10),
    modal: false,
    lesson: [
      "Технология разработки и защиты баз данных",
      "Операционные системы",
      ""
    ],
    teacher: ["Токарчук А.С.", "Горбунов А.Д.", ""],
    tab1: [null, null, null, null, null, null, null],

    tabs: ["1 пара", "2 пара"]
  }),
  methods: {
    sendQuery() {
      //Вписывай отправку
      alert("Расписание звонков принято!");
    }
  },
};
</script>