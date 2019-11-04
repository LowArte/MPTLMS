<template>
  <v-container fluid>
    <v-data-iterator
      :items="items[group]"
      :items-per-page.sync="itemsPerPage"
      :page="page"
      :search="search"
      hide-default-footer
    >
      <template v-slot:header>
        <v-toolbar dark color="dark darken-3" class="ma-0 pa-0">
          <v-text-field class="ma-1" v-model="search" solo-inverted hide-details label="Поиск"></v-text-field>

          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on }">
              <v-btn color="primary" class="mt-3 ml-2" dark v-on="on">Новая дата</v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">Новая дата</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-dialog
                      ref="dialog"
                      v-model="modal"
                      :return-value.sync="editedItem.date"
                      persistent
                      width="290px"
                    >
                      <template v-slot:activator="{ on }">
                        <v-text-field
                          v-model="editedItem.date"
                          label="Крайний срок сдачи"
                          readonly
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker v-model="editedItem.date" scrollable>
                        <div class="flex-grow-1"></div>
                        <v-btn text color="primary" @click="modal = false">Отмена</v-btn>
                        <v-btn
                          text
                          color="primary"
                          @click="$refs.dialog.save(editedItem.date)"
                        >Принять</v-btn>
                      </v-date-picker>
                    </v-dialog>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeAdd">Отмена</v-btn>
                <v-btn color="blue darken-1" text @click="saveAdd">Сохранить</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
        <v-toolbar dark color="dark darken-3" class="ma-0 pa-0 mb-1">
          <v-autocomplete v-model="lesson" class="mt-7 ml-2" label="Дисциплина" :items="lessons"></v-autocomplete>

          <v-autocomplete v-model="semester" class="mt-7 ml-2" label="Семестр" :items="semesters"></v-autocomplete>
        </v-toolbar>
      </template>

      <template v-slot:default="props">
        <v-row>
          <v-col v-for="item in props.items" :key="item.name" cols="12" sm="6" md="4" lg="3">
            <v-card dark>
              <v-card-title class="subheading font-weight-bold">{{ item.name }}</v-card-title>
              <v-divider class="pa-0 ma-0"></v-divider>

              <v-list dense>
                <div v-for="ap in item.academicPerformance[semester]" :key="ap">
                  <v-simple-table v-if="ap.name == lesson">
                    <tbody>
                      <tr v-for="(scope, i) in ap.scopes" :key="i">
                        <td width="50%" class="flex text-center">
                          {{ scope.date }}
                          <v-icon small @click="deleteItem(i)">d</v-icon>
                        </td>
                        <td width="50%" class="flex text-center">
                          <v-edit-dialog
                            :return-value.sync="scope.scope"
                            large
                            persistent
                            @save="saveScope"
                            @close="saveScope"
                          >
                            <div>{{ scope.scope }}</div>

                            <template v-slot:input>
                              <v-autocomplete
                                v-model="scope.scope"
                                class="mt-7 ml-2"
                                label="Оценка"
                                single-line
                                autofocus
                                :items="vscope"
                              ></v-autocomplete>
                            </template>
                          </v-edit-dialog>
                        </td>
                      </tr>
                      <tr v-if="ap.averageScore">
                        <td width="50%" class="flex text-center">Средний балл</td>
                        <td width="50%" class="flex text-center">{{ap.averageScore}}</td>
                      </tr>
                      <tr v-if="ap.endScore">
                        <td width="50%" class="flex text-center">Итоговая оценка</td>
                        <td width="50%" class="flex text-center">
                          <v-edit-dialog :return-value.sync="ap.endScore" large persistent>
                            <div>{{ ap.endScore }}</div>

                            <template v-slot:input>
                              <v-autocomplete
                                v-model="ap.endScore"
                                class="mt-7 ml-2"
                                label="Оценка"
                                single-line
                                counter
                                autofocus
                                :items="svscope"
                              ></v-autocomplete>
                            </template>
                          </v-edit-dialog>
                        </td>
                      </tr>
                    </tbody>
                  </v-simple-table>
                </div>
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
          <v-btn fab dark color="black darken-3" class="mr-1" @click="formerPage">L
            <!-- <v-icon>mdi-chevron-left</v-icon> -->
          </v-btn>
          <v-btn fab dark color="black darken-3" class="ml-1" @click="nextPage">R
            <!-- <v-icon>mdi-chevron-right</v-icon> -->
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
      show: false,
      itemsPerPage: 4,
      lessons: ["Операционные системы", "Иностранный язык"],
      lesson: "Операционные системы",
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
      group: "П-2-16",
      groups: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
      vscope: ["нб", "1", "2", "3", "4", "5", ""],
      vscope: ["н/a", "1", "2", "3", "4", "5", ""],
      editedItem: { date: "", scope: "" },
      dialog: false,
      modal: false,
      items: {
        "П-2-16": [
          {
            name: "Борисов Артём Игоревич",
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
            }
          },
          {
            name: "Борисов Артём Игоревич",
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
            }
          },
          {
            name: "Борисов Артём Игоревич",
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
            }
          },
          {
            name: "Борисов Артём Игоревич",
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
            }
          },
          {
            name: "Борисов Артём Игоревич",
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
                    },
                    {
                      date: "29.10.2019",
                      scope: "4"
                    }
                  ]
                }
              ]
            }
          }
        ]
      }
    };
  },
  computed: {
    numberOfPages() {
      return Math.ceil(this.items[this.group].length / this.itemsPerPage);
    }
  },
  watch: {
    dialog(val) {
      val || this.closeAdd();
    }
  },
  methods: {
    deleteItem(item) {
      alert(item);
      for (var i = 0; i < this.items[this.group].length; i++) {
        var ap = this.items[this.group][i].academicPerformance[this.semester];
        for (
          var i1 = 0;
          i1 <
          this.items[this.group][i].academicPerformance[this.semester].length;
          i1++
        ) {
          this.items[this.group][i].academicPerformance[this.semester][
            i1
          ].scopes.splice(item, 1);
        }
      }
    },
    closeAdd() {
      this.dialog = false;
    },
    saveAdd() {
      for (var i = 0; i < this.items[this.group].length; i++) {
        var ap = this.items[this.group][i].academicPerformance[this.semester];
        for (
          var i1 = 0;
          i1 <
          this.items[this.group][i].academicPerformance[this.semester].length;
          i1++
        ) {
          this.items[this.group][i].academicPerformance[this.semester][
            i1
          ].scopes.push({
            date: this.editedItem.date,
            scope: this.editedItem.scope
          });
        }
      }
      this.closeAdd();
    },
    saveScope() {
      var sumscopes = 0;
      var sc = 0;
      for (var i = 0; i < this.items[this.group].length; i++) {
        var ap = this.items[this.group][i].academicPerformance[this.semester];
        for (
          var i1 = 0;
          i1 <
          this.items[this.group][i].academicPerformance[this.semester].length;
          i1++
        ) {
          if (
            this.items[this.group][i].academicPerformance[this.semester][i1]
              .name == this.lesson
          ) {
            sumscopes = 0;
            sc = 0;
            for (
              var i2 = 0;
              i2 <
              this.items[this.group][i].academicPerformance[this.semester][i1]
                .scopes.length;
              i2++
            ) {
              if (
                this.items[this.group][i].academicPerformance[this.semester][i1]
                  .scopes[i2].scope >= 1 &&
                this.items[this.group][i].academicPerformance[this.semester][i1]
                  .scopes[i2].scope <= 5
              ) {
                sc++;
                sumscopes =
                  sumscopes +
                  Number.parseInt(
                    this.items[this.group][i].academicPerformance[
                      this.semester
                    ][i1].scopes[i2].scope
                  );
              }
            }
            this.items[this.group][i].academicPerformance[this.semester][
              i1
            ].averageScore = parseFloat(sumscopes / sc).toFixed(2);
          }
        }
      }
    },
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