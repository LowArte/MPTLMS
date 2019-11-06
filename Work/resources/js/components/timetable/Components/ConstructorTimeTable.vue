<template>
  <v-container fluid>
    <v-row align="center">
      <v-container>
        <v-autocomplete v-model="group" label="Группа" solo :items="groups"></v-autocomplete>
        <v-container class="pa-0 align-self-center" d-flex>
          <v-row sm="2" md="0" class="pa-0 justify-center">
            <v-col class="pa-0 d-flex justify-center" sm="2" md="0">
              <v-btn color="primary" dark>Применить</v-btn>
            </v-col>
            <v-col class="pa-0 d-flex justify-center" sm="2" md="0">
              <v-btn
                color="accent"
                dark
                @click="hidden = !hidden"
              >{{ hidden ? 'Числитель' : 'Знаменатель' }}</v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-container>
    </v-row>
    <v-divider class="ma-0"></v-divider>
    <v-data :items="items" :items-per-page.sync="itemsPerPage">
      <template v-slot:default="props">
        <v-row>
          <v-col v-for="item in props.items" :key="item.name" cols="12" sm="12" md="2" lg="4">
            <v-card>
              <v-container fluid>
                <v-card-title class="ma-2">{{ item.name }}</v-card-title>
                <v-list dense>
                  <v-list-item>
                    <v-row align="center" class="pa-2">
                      <v-select :items="place" label="Место проведения"></v-select>
                    </v-row>
                  </v-list-item>
                  <v-divider></v-divider>
                  <v-list-item>
                    <v-col class="pa-1">
                      1. {{timeitems.p1}}
                      <v-autocomplete label="Дисциплина" solo :items="lesson"></v-autocomplete>
                      <v-autocomplete label="Преподаватель" solo :items="teacher"></v-autocomplete>
                      <v-switch
                        color="primary"
                        value="primary"
                        v-model="tab1[item.name]"
                        flat
                        label="Дополнительная пара"
                      ></v-switch>
                      <v-autocomplete
                        v-if="tab1[item.name]"
                        label="Дисциплина"
                        solo
                        :items="lesson"
                      ></v-autocomplete>
                      <v-autocomplete
                        v-if="tab1[item.name]"
                        label="Преподаватель"
                        solo
                        :items="teacher"
                      ></v-autocomplete>
                    </v-col>
                  </v-list-item>
                  <v-divider></v-divider>
                  <v-list-item>
                    <v-col class="pa-1">
                      2 {{timeitems.p2}}
                      <v-autocomplete label="Дисциплина" solo :items="lesson"></v-autocomplete>
                      <v-autocomplete label="Преподаватель" solo :items="teacher"></v-autocomplete>
                      <v-switch
                        color="primary"
                        value="primary"
                        v-model="tab2[item.name]"
                        flat
                        label="Дополнительная пара"
                      ></v-switch>
                      <v-autocomplete
                        v-if="tab2[item.name]"
                        label="Дисциплина"
                        solo
                        :items="lesson"
                      ></v-autocomplete>
                      <v-autocomplete
                        v-if="tab2[item.name]"
                        label="Преподаватель"
                        solo
                        :items="teacher"
                      ></v-autocomplete>
                    </v-col>
                  </v-list-item>
                  <v-divider></v-divider>
                  <v-list-item>
                    <v-col class="pa-1">
                      3. {{timeitems.p3}}
                      <v-autocomplete label="Дисциплина" solo :items="lesson"></v-autocomplete>
                      <v-autocomplete label="Преподаватель" solo :items="teacher"></v-autocomplete>
                      <v-switch
                        color="primary"
                        value="primary"
                        v-model="tab3[item.name]"
                        flat
                        label="Дополнительная пара"
                      ></v-switch>
                      <v-autocomplete
                        v-if="tab3[item.name]"
                        label="Дисциплина"
                        solo
                        :items="lesson"
                      ></v-autocomplete>
                      <v-autocomplete
                        v-if="tab3[item.name]"
                        label="Преподаватель"
                        solo
                        :items="teacher"
                      ></v-autocomplete>
                    </v-col>
                  </v-list-item>
                  <v-divider></v-divider>
                  <v-list-item>
                    <v-col class="pa-1">
                      4. {{timeitems.p4}}
                      <v-autocomplete label="Дисциплина" solo :items="lesson"></v-autocomplete>
                      <v-autocomplete label="Преподаватель" solo :items="teacher"></v-autocomplete>
                      <v-switch
                        color="primary"
                        value="primary"
                        v-model="tab4[item.name]"
                        flat
                        label="Дополнительная пара"
                      ></v-switch>
                      <v-autocomplete
                        v-if="tab4[item.name]"
                        label="Дисциплина"
                        solo
                        :items="lesson"
                      ></v-autocomplete>
                      <v-autocomplete
                        v-if="tab4[item.name]"
                        label="Преподаватель"
                        solo
                        :items="teacher"
                      ></v-autocomplete>
                    </v-col>
                  </v-list-item>
                  <v-divider></v-divider>
                  <v-list-item>
                    <v-col class="pa-1">
                      5. {{timeitems.p5}}
                      <v-autocomplete label="Дисциплина" solo :items="lesson"></v-autocomplete>
                      <v-autocomplete label="Преподаватель" solo :items="teacher"></v-autocomplete>
                      <v-switch
                        color="primary"
                        value="primary"
                        v-model="tab5[item.name]"
                        flat
                        label="Дополнительная пара"
                      ></v-switch>
                      <v-autocomplete
                        v-if="tab5[item.name]"
                        label="Дисциплина"
                        solo
                        :items="lesson"
                      ></v-autocomplete>
                      <v-autocomplete
                        v-if="tab5[item.name]"
                        label="Преподаватель"
                        solo
                        :items="teacher"
                      ></v-autocomplete>
                    </v-col>
                  </v-list-item>
                  <v-divider></v-divider>
                  <v-list-item>
                    <v-col class="pa-1">
                      6. {{timeitems.p6}}
                      <v-autocomplete label="Дисциплина" solo :items="lesson"></v-autocomplete>
                      <v-autocomplete label="Преподаватель" solo :items="teacher"></v-autocomplete>
                      <v-switch
                        color="primary"
                        value="primary"
                        v-model="tab6[item.name]"
                        flat
                        label="Дополнительная пара"
                      ></v-switch>
                      <v-autocomplete
                        v-if="tab6[item.name]"
                        label="Дисциплина"
                        solo
                        :items="lesson"
                      ></v-autocomplete>
                      <v-autocomplete
                        v-if="tab6[item.name]"
                        label="Преподаватель"
                        solo
                        :items="teacher"
                      ></v-autocomplete>
                    </v-col>
                  </v-list-item>
                  <v-divider></v-divider>
                  <v-list-item>
                    <v-col class="pa-1">
                      7. {{timeitems.p7}}
                      <v-autocomplete label="Дисциплина" solo :items="lesson"></v-autocomplete>
                      <v-autocomplete label="Преподаватель" solo :items="teacher"></v-autocomplete>
                      <v-switch
                        v-model="tab7[item.name]"
                        color="primary"
                        value="primary"
                        flat
                        label="Дополнительная пара"
                      ></v-switch>
                      <v-autocomplete
                        v-if="tab7[item.name]"
                        label="Дисциплина"
                        solo
                        :items="lesson"
                      ></v-autocomplete>
                      <v-autocomplete
                        v-if="tab7[item.name]"
                        label="Преподаватель"
                        solo
                        :items="teacher"
                      ></v-autocomplete>
                    </v-col>
                  </v-list-item>
                </v-list>
              </v-container>
            </v-card>
          </v-col>
        </v-row>
      </template>
    </v-data>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    groups: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    group: "П-1-16",
    model: null,
    hidden: false,
    tab1: [
      {
        Понедельник: null,
        Вторник: null,
        Среда: null,
        Четверг: null,
        Пятница: null,
        Суббота: null
      }
    ],
    tab2: [
      {
        Понедельник: null,
        Вторник: null,
        Среда: null,
        Четверг: null,
        Пятница: null,
        Суббота: null
      }
    ],
    tab3: [
      {
        Понедельник: null,
        Вторник: null,
        Среда: null,
        Четверг: null,
        Пятница: null,
        Суббота: null
      }
    ],
    tab4: [
      {
        Понедельник: null,
        Вторник: null,
        Среда: null,
        Четверг: null,
        Пятница: null,
        Суббота: null
      }
    ],
    tab5: [
      {
        Понедельник: null,
        Вторник: null,
        Среда: null,
        Четверг: null,
        Пятница: null,
        Суббота: null
      }
    ],
    tab6: [
      {
        Понедельник: null,
        Вторник: null,
        Среда: null,
        Четверг: null,
        Пятница: null,
        Суббота: null
      }
    ],
    tab7: [
      {
        Понедельник: null,
        Вторник: null,
        Среда: null,
        Четверг: null,
        Пятница: null,
        Суббота: null
      }
    ],
    tabs: ["1 пара", "2 пара"],

    itemsPerPageOptions: [6],
    itemsPerPage: 6,
    Tab: ["1x1", "2x1"],
    place: ["Нахимовский", "Неженская"],
    timeitems: {
      p1: "8:30 - 10:00",
      p2: "10:10 - 11:40",
      p3: "12:00 - 13:30",
      p4: "14:00 - 15:30",
      p5: "15:40 - 17:10",
      p6: "17:20 - 18:50",
      p7: "19:00 - 19:30"
    },
    lesson: [
      "Технология разработки и защиты баз данных",
      "Операционные системы"
    ],
    teacher: ["Токарчук А.С.", "Горбунов А.Д."],
    items: [
      {
        name: "Понедельник"
      },
      {
        name: "Вторник"
      },
      {
        name: "Среда"
      },
      {
        name: "Четверг"
      },
      {
        name: "Пятница"
      },
      {
        name: "Суббота"
      }
    ]
  })
};
</script>