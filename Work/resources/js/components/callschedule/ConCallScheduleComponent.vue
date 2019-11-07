<template>
  <v-container fluid>
    <v-row>
      <v-col>
        <v-hover v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto" height="auto" width="max">
            <v-card-text class="text-center title">
              Расписание звонков
              <v-select class="pa-0 mb-0 mt-2" v-model="mplace" label="Место проведения" solo :items="place"></v-select>
            </v-card-text>

            <v-container class="grey lighten-5 pt-0" fluid>
              <v-row no-gutters v-for="n in 7" :key="n" sm="6" md="4" lg="3">
                <v-col>
                  <v-card class="pa-2" outlined tile>
                    {{n}} пара
                    <v-text-field hint="(ЧЧ:ММ-ЧЧ:ММ)" v-model="time[n]" v-mask="mask" label="Начало/конец пары "></v-text-field>
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
    place: ["Нахимовский", "Неженская"],
    mplace: "",
    time: [null, null, null, null, null, null, null],
  }),
  methods: {
    sendQuery() {
      //Вписывай отправку
      alert("Расписание звонков принято!");
    }
  },
};
</script>