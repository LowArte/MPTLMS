<template>
  <v-container fluid>
    <v-row sm="2" md="0" class="d-flex">
      <v-col>
        <v-autocomplete
          v-model="departament"
          label="Отделения"
          solo
          :items="arrdepartaments"
          item-text="dep_name_full"
          return-object
          @change="changeGroups(departament.id)"
        ></v-autocomplete>
        <v-autocomplete
          v-model="casegroup"
          label="Группа"
          solo
          :items="arrgroups"
          item-text="group_name"
          return-object
        ></v-autocomplete>
        <v-dialog ref="dialog" v-model="modal" :return-value.sync="date" persistent width="290px">
          <template v-slot:activator="{ on }">
            <v-text-field v-model="date" label="Дата" readonly v-on="on"></v-text-field>
          </template>
          <v-date-picker v-model="date" scrollable>
            <div class="flex-grow-1"></div>
            <v-btn text color="primary" @click="modal = false">Отмена</v-btn>
            <v-btn text color="primary" @click="$refs.dialog.save(date)">Принять</v-btn>
          </v-date-picker>
        </v-dialog>
        <v-row sm="2" md="0" class="pa-0 align-self-center justify-center">
          <v-btn color="primary" dark @click="sendNewReplacements">Применить</v-btn>
        </v-row>
      </v-col>
    </v-row>
    <v-divider class="my-1"></v-divider>
    <v-row>
      <v-col>
        <v-hover v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto" height="auto" width="auto">
            <v-card-text class="text-center title">
              Понедельник
              <br />Место проведения: Неженская
            </v-card-text>
            <v-container class="grey lighten-5">
              <v-row no-gutters v-for="n in 7" :key="n" sm="6" md="4" lg="3">
                <v-col>
                  <v-card
                    class="pa-2"
                    outlined
                    tile
                  >{{n}}. Технология разработки и защиты баз данных (Дубовик А.С.)</v-card>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-hover>
      </v-col>
      <v-col>
        <v-hover v-slot:default="{ hover }">
          <v-card :elevation="hover ? 10 : 5" class="mx-auto" height="auto" width="auto">
            <v-container>
              <v-card-text class="my-2 text-center title">
                Замена
                <v-divider></v-divider>
              </v-card-text>

              <div v-for="n in 7" :key="n">
                <div class="ma-2 mb-0 pa-2">
                  <v-row>{{n}} пара</v-row>
                  <v-row>
                    <v-autocomplete
                      width="100%"
                      label="Дисциплина"
                      solo
                      small-chips
                      chips
                      multiple
                      :items="lesson"
                      grow
                    ></v-autocomplete>
                  </v-row>
                  <v-row>
                    <v-autocomplete
                      width="100%"
                      label="Преподаватель"
                      solo
                      small-chips
                      chips
                      multiple
                      :items="teacher"
                      grow
                    ></v-autocomplete>
                  </v-row>
                  <v-row>
                    <v-switch v-model="tab[n]" color="primary" inset label="Знаменатель"></v-switch>
                  </v-row>
                  <v-row v-if="tab[n]">
                    <v-autocomplete
                      label="Дисциплина"
                      solo
                      small-chips
                      chips
                      multiple
                      :items="lesson"
                      grow
                    ></v-autocomplete>
                  </v-row>
                  <v-row v-if="tab[n]">
                    <v-autocomplete
                      label="Преподаватель"
                      solo
                      small-chips
                      chips
                      multiple
                      :items="teacher"
                      grow
                    ></v-autocomplete>
                  </v-row>
                </div>
                <v-divider class="ma-0 pa-0"></v-divider>
              </div>
            </v-container>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    items: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    date: new Date().toISOString().substr(0, 10),
    modal: false,
    lesson: [
      "Технология разработки и защиты баз данных",
      "Операционные системы"
    ],
    teacher: ["Токарчук А.С.", "Горбунов А.Д."],
    tab: [null, null, null, null, null, null, null],
    arrday: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]
  }),
  props: {
    place: {
      type: String,
      default: null
    },
    schedule: {
      type: String,
      default: null
    },
    callSchedule: {
      type: String,
      default: null
    },
    groups: {
      type: String,
      default: null
    },
    departaments: {
      type: String,
      default: null
    }
  },
  methods: {
    sendNewReplacements() {
      alert("Замена принята!");
    }
  }
};
</script>