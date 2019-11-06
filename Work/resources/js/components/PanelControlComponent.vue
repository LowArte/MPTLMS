<template>
  <v-row>
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-0" height="auto" width="max">
          <v-container class="pa-0 ma-0">
            <v-row class="pa-2 ma-0">
              <v-card-text class="my-2 ma-0 pa-0 text-center title">Панель управления</v-card-text>
            </v-row>
            <v-divider></v-divider>
            <v-row class="pa-2 ma-0">
              <v-autocomplete v-model="oMode" label="Режим работы" solo :items="operatingMode"></v-autocomplete>
              <v-btn class="ma-2" color="accent" dark @click="sendQuery">Применить</v-btn>
            </v-row>
            <v-divider></v-divider>
            <v-row class="pa-2 ma-0">
              <v-expansion-panels>
                <v-expansion-panel>
                  <v-expansion-panel-header>Расписание дисциплин</v-expansion-panel-header>
                  <v-expansion-panel-content><Timetable/></v-expansion-panel-content>
                </v-expansion-panel>
                <v-expansion-panel>
                  <v-expansion-panel-header>Замены</v-expansion-panel-header>
                  <v-expansion-panel-content><Replacements/></v-expansion-panel-content>
                </v-expansion-panel>
                <v-expansion-panel>
                  <v-expansion-panel-header>Расписание звонков</v-expansion-panel-header>
                  <v-expansion-panel-content> <Concallschedule/></v-expansion-panel-content>
                </v-expansion-panel>
              </v-expansion-panels>
            </v-row>
          </v-container>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

<script>
import Timetable from "./timetable/ContimetableComponent";
import Replacements from "./timetable/ConreplacementsComponent";
import Concallschedule from "./callschedule/ConCallScheduleComponent";
export default {
  data: () => ({
    operatingMode: ["Полный функционал", "Профилактика"],
    oMode: "Профилактика"
  }),
  components: {
    Timetable,
    Replacements,
    Concallschedule
  },
  methods: {
    sendQuery() {
      //Вписывай отправку
      alert("Отправлен запрос изменения режима работы сайта!");
    }
  }
};
</script>