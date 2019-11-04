<template>
  <v-container fluid>
    <v-row sm="2" md="0" class="d-flex">
      <v-col>
        <v-select :items="items" label="Группа" solo></v-select>
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
        <v-btn color="accent" dark class="align-self-end">Принять</v-btn>
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
              <v-row no-gutters v-for="n in 7" :key="n">
                <v-tabs v-model="tab1[n]" grow>
                  <v-tab v-for="item in tabs" :key="item">{{ item }}</v-tab>
                  <v-tab-item v-for="item in tabs" :key="item" grow>
                    <v-card class="pa-2" outlined tile grow>
                      {{n}} пара
                      <v-select :items="lesson" label="Дисциплина" grow></v-select>
                      <v-select :items="teacher" label="Преподаватель" grow></v-select>
                    </v-card>
                  </v-tab-item>
                </v-tabs>
              </v-row>
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
    hidden: false,
    items: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
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
  })
};
</script>