<template>
  <v-container fluid>
    <v-data-iterator
      :items="academicPerformance[semester]"
      :items-per-page.sync="itemsPerPage"
      :page="page"
      :search="search"
      hide-default-footer
    >
      <template v-slot:header>
        <v-toolbar dark color="dark darken-3" class="ma-0 pa-0 mb-1">
          <v-row class="ma-0 pa-0">
            <v-col class="ma-0 pa-0">
              <v-text-field
                class="mt-4 ml-2"
                v-model="search"
                solo-inverted
                hide-details
                label="Поиск"
              ></v-text-field>
            </v-col>
            <v-col class="ma-0 pa-0">
              <v-autocomplete
                v-model="lesson"
                class="mt-7 ml-2"
                label="Дисциплина"
                :items="lessons"
              ></v-autocomplete>
            </v-col>
            <v-col class="ma-0 pa-0">
              <v-autocomplete
                v-model="semester"
                class="mt-7 ml-2"
                label="Семестр"
                :items="semesters"
              ></v-autocomplete>
            </v-col>
          </v-row>
        </v-toolbar>
      </template>

      <template v-slot:default="props">
        <v-row>
          <v-col v-for="item in props.items" :key="item.name" cols="12" sm="6" md="4" lg="3">
            <v-card dark v-if="(lesson == item.name) || (lesson == 'Все дисциплины')">
              <v-card-title class="subheading font-weight-bold">{{ item.name }}</v-card-title>

              <v-divider class="pa-0 ma-0"></v-divider>

              <v-list dense>
                <v-simple-table>
                  <tbody>
                    <tr v-for="scope in item.scopes" :key="scope">
                      <td width="50%" class="flex text-center">{{ scope.date }}</td>
                      <td width="50%" class="flex text-center">{{ scope.scope }}</td>
                    </tr>
                    <tr v-if="item.averageScore">
                      <td width="50%" class="flex text-center">Средний балл</td>
                      <td width="50%" class="flex text-center">{{item.averageScore}}</td>
                    </tr>
                    <tr v-if="item.endScore">
                      <td width="50%" class="flex text-center">Итоговая оценка</td>
                      <td width="50%" class="flex text-center">{{item.endScore}}</td>
                    </tr>
                  </tbody>
                </v-simple-table>
              </v-list>
            </v-card>
          </v-col>
        </v-row>
      </template>

      <template v-slot:footer>
        <v-row class="mt-2" align="center" justify="center">
          <span class="grey--text ml-2">Количество дисциплин</span>
          <v-menu offset-y>
            <template v-slot:activator="{ on }">
              <v-btn dark text color="black" class="ml-2" v-on="on">
                {{ itemsPerPage }}
                <v-icon>mdi-chevron-down</v-icon>
              </v-btn>
            </template>
            <v-list>
              <v-list-item
                v-for="(number, index) in itemsPerPageArray"
                :key="index"
                @click="updateItemsPerPage(number)"
              >
                <v-list-item-title>{{ number }}</v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>

          <v-spacer></v-spacer>

          <span class="mr-4 grey--text">Страница {{ page }} из {{ numberOfPages }}</span>
          <v-btn fab dark color="black darken-3" class="mr-1" @click="formerPage">
            <v-icon>mdi-chevron-left</v-icon>
          </v-btn>
          <v-btn fab dark color="black darken-3" class="ml-1" @click="nextPage">
            <v-icon>mdi-chevron-right</v-icon>
          </v-btn>
        </v-row>
      </template>
    </v-data-iterator>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      itemsPerPageArray: [4, 8, 12],
      page: 1,
      itemsPerPage: 4,
      lessons: ["Все дисциплины", "Операционные системы", "Иностранный язык"],
      lesson: "Все дисциплины",
      search: "",
      semester: "Семестр 3",
      semesters: [
        "Семестр 1",
        "Семестр 2",
        "Семестр 3",
        "Семестр 4",
        "Семестр 5",
        "Семестр 6",
        "Семестр 7",
        "Семестр 8"
      ],

      academicPerformance: {
        "Семестр 3": [
          {
            name: "Операционные системы",
            averageScore: 4,
            endScore: 4,
            scopes: [
              {
                date: "28.10.2019",
                scope: "5"
              },
              {
                date: "29.10.2019",
                scope: "4"
              }
            ]
          },
          {
            name: "Иностранный язык",
            averageScore: 4,
            endScore: 4,
            scopes: [
              {
                date: "28.10.2019",
                scope: "5"
              },
              {
                date: "29.10.2019",
                scope: "4"
              }
            ]
          },
          {
            name: "Технология разработки программного обеспечения",
            averageScore: 4,
            endScore: 4,
            scopes: [
              {
                date: "28.10.2019",
                scope: "5"
              },
              {
                date: "29.10.2019",
                scope: "4"
              }
            ]
          }
        ]
      },
    };
  },
  computed: {
    numberOfPages() {
      return Math.ceil(this.items.length / this.itemsPerPage);
    }
  },
  methods: {
    nextPage() {
      if (this.page + 1 <= this.numberOfPages) this.page += 1;
    },
    formerPage() {
      if (this.page - 1 >= 1) this.page -= 1;
    },
    updateItemsPerPage(number) {
      this.itemsPerPage = number;
    }
  }
};
</script>