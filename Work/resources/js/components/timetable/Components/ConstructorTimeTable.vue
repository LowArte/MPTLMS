<template v-cloak>
  <v-container fluid>
    <v-row align="center">
      <v-container>
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
        <v-row sm="2" md="0" class="pa-0 align-self-center justify-center">
          <v-btn color="primary" dark @click="sendNewSchedule">Применить</v-btn>
        </v-row>
      </v-container>
    </v-row>
    <v-divider class="ma-0"></v-divider>
    <v-data v-if="load==false" :items="arrday" :items-per-page.sync="itemsPerPage">
      <v-row>
        <v-col v-for="(day, d1) in arrday" :key="d1" cols="12" sm="12" md="2" lg="4">
          <v-card dark class="pa-0 pb-0">
            <v-card light class="ma-1 pa-0">
              <v-divider class="my-2" color="Black"></v-divider>
              <v-card-title class="mb-0 pb-0" style="color: #FF3D00;">{{day}}</v-card-title>
              <v-list dense class="ma-0 pa-1">
                <v-list-item class="ma-0 pa-0">
                  <v-autocomplete
                    v-model="caseplace[d1]"
                    label="Место проведения"
                    :items="places"
                    item-text="place_name"
                    return-object
                  ></v-autocomplete>
                </v-list-item>

                <v-list class="ma-0 pa-0">
                  <v-list class="ma-0 pa-0" v-for="(Lesson, l1) in newarrschedule[d1]" :key="l1">
                    <v-divider class="my-1 ma-0 pa-0" color="Black"></v-divider>
                    <v-list-item
                      class="ma-0 pa-0"
                      v-if="callschedule[arrschedule[day].Place].call_schedule[l1 + 1] != null && callschedule[arrschedule[day].Place].call_schedule[l1 + 1]!=''"
                    >
                      <v-card-title
                        style="color: #FF3D00;"
                        class="subtitle-1 ma-0 pa-0"
                      >{{l1 + 1}} пара - {{callschedule[arrschedule[day].Place-1].call_schedule[l1 + 1]}}</v-card-title>
                    </v-list-item>
                    <v-list-item class="ma-0 pa-0" v-else>
                      <v-card-title
                        style="color: #FF3D00;"
                        class="subtitle-1 ma-0 pa-0"
                      >{{l1 + 1}} пара - расписание звонка отсутствует!</v-card-title>
                    </v-list-item>
                    <v-list v-for="(Lesson1, l2) in Lesson" :key="l2" class="ma-0 pa-0">
                      <v-list-item class="ma-0 pa-0" v-if="l2 == 0" fill-width>
                        <v-autocomplete
                          v-model="Lesson1[0]"
                          label="Дисциплины"
                          :items="arrdiscip"
                          item-text="discipline_name"
                          small-chips
                          chips
                          multiple
                          return-object
                        ></v-autocomplete>
                      </v-list-item>
                      <v-list-item class="ma-0 pa-0" v-if="l2 == 0" fill-width>
                        <v-autocomplete
                          v-model="Lesson1[1]"
                          label="Преподаватели"
                          :items="arrteachers"
                          item-text="name"
                          small-chips
                          chips
                          multiple
                          return-object
                          @change="caseTeacher(Lesson1)"
                        ></v-autocomplete>
                      </v-list-item>
                      <v-list-item class="ma-0 pa-0 pl-1" v-if="l2 == 1" fill-width>
                        <v-switch
                          v-model="arrswitch[d1][l1]"
                          color="primary"
                          inset
                          label="Знаменатель"
                        ></v-switch>
                      </v-list-item>
                      <v-list-item class="ma-0 pa-0" v-if="l2 == 1 && arrswitch[d1][l1]" fill-width>
                        <v-autocomplete
                          v-model="Lesson1[0]"
                          label="Дисциплины"
                          :items="arrdiscip"
                          item-text="discipline_name"
                          small-chips
                          chips
                          multiple
                          return-object
                        ></v-autocomplete>
                      </v-list-item>
                      <v-list-item class="ma-0 pa-0" v-if="l2 == 1 && arrswitch[d1][l1]" fill-width>
                        <v-autocomplete
                          v-model="Lesson1[1]"
                          label="Преподаватели"
                          :items="arrteachers"
                          item-text="name"
                          small-chips
                          chips
                          multiple
                          return-object
                        ></v-autocomplete>
                      </v-list-item>
                    </v-list>
                  </v-list>
                </v-list>
              </v-list>
              <v-divider class="my-1 ma-0 pa-0" color="Black"></v-divider>
            </v-card>
          </v-card>
        </v-col>
      </v-row>
    </v-data>
    <v-row v-if="load==true" sm="2" md="0" class="pa-0 mt-5 align-self-center justify-center">
      <v-progress-circular :disabled="load" indeterminate color="primary"></v-progress-circular>
    </v-row>
    {{newarrschedule}}
  </v-container>
</template>

<script>
import apigroup from "../../../api/group";
import apischedule from "../../../api/schedule";
export default {
  data: () => ({
    itemsPerPageOptions: [6],
    itemsPerPage: 6,

    load: true,
    arrgroups: null,
    casegroup: null,
    arrdepartaments: [],
    departament: null,
    callschedule: null,
    arrschedule: null,
    places: [],
    caseplace: [null, null, null, null, null, null],
    arrday: [
      "Понедельник",
      "Вторник",
      "Среда",
      "Четверг",
      "Пятница",
      "Суббота"
    ],

    arrswitch: [],
    arrdiscip: [],
    arrteachers: [],

    newarrschedule: [],
  }),
  props: {
    discip: {
      type: String,
      default: null
    },
    teachers: {
      type: String,
      default: null
    },
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
  watch: {
    casegroup(val, oldval) {
      if (this.groups == "") this.changeSchedule(val.id);
      else {
        if (oldval != null) this.changeSchedule(val.id);
      }
    }
  },
  methods: {
    caseTeacher: function(Lesson1){ //Дубликат пары - желательно не использовать
      // if (Lesson1[0].length < Lesson1[1].length)
      //   Lesson1[0].push(Lesson1[0][0]);
    },
    sendNewSchedule: function() {
      for (var i = 0; i < this.caseplace.length; i++)
        if (this.caseplace[i] != null && this.caseplace[i] != "")
          this.places[
            (this.arrschedule[this.arrday[i]].Place = this.caseplace[i].id)
          ];

      alert("Расписание изменено!");
    },

    changeGroups: function(departament) {
      //alert("Отеделение " + departament);
      apigroup
        .getGroup(departament)
        .then(reg => {
          this.arrgroups = reg.data.group;
          this.casegroup = this.arrgroups[0];
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    changeSchedule: function(group) {
      //alert("Группа " + group);

      this.load = true;
      apischedule
        .getSchedule(group)
        .then(reg => {
          this.arrschedule = JSON.parse(reg.data.schedule[0].schedule);
          for (var i = 0; i < this.caseplace.length; i++) {
            if (
              this.arrschedule[this.arrday[i]].Place != null &&
              this.arrschedule[this.arrday[i]].Place != ""
            )
              this.caseplace[i] = this.places[
                this.arrschedule[this.arrday[i]].Place - 1
              ];
          }

          this.newarrschedule = [];
          for (var i = 0; i < 6; i++) {
            this.newarrschedule.push([]);
            for (var i1 = 0; i1 < 8; i1++) {
              this.newarrschedule[i].push([]);
              for (var i2 = 0; i2 < 2; i2++) {
                this.newarrschedule[i][i1].push([[null], [null]]);
              }
            }
          }
          console.log(this.newarrschedule);

          this.arrswitch = [];
          for (var i = 0; i < 6; i++) {
            this.arrswitch.push([]);
            for (var i1 = 0; i1 < this.newarrschedule[i].length; i1++) {
              this.arrswitch[i].push(null);
            }
          }

          for (var i = 0; i < 1; i++) //Прохождение по дням
          for (var i1 = 0; i1 < 8; i1++) //Прохождение по парам
          {
            console.log(i + 1 + " день. " + (i1 + 1) + " пара. "); //День и пара
            if (typeof(this.arrschedule[this.arrday[i]][i1 + 1].Lesson) != "object") //Не массивный контент
            {
              console.log(this.arrschedule[this.arrday[i]][i1 + 1].Lesson);
              console.log(this.arrschedule[this.arrday[i]][i1 + 1].Teacher);    
              this.newarrschedule[i][i1][0][0] = this.arrschedule[this.arrday[i]][i1 + 1].Lesson;
              this.newarrschedule[i][i1][0][1] = this.arrschedule[this.arrday[i]][i1 + 1].Teacher;
            }
            else
            {
              if (this.arrschedule[this.arrday[i]][i1 + 1].Lesson != null) //Не нулевое значение
              {
                console.log("Это обжект");
                if (this.arrschedule[this.arrday[i]][i1 + 1].Lesson.length > 1)
                {
                  this.arrswitch[i][i1] = true; //Активация свитча обозначающий, что работает система числителя знаменателя
                  if (this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0] != null) //Если пара по числителю не пустая
                  {
                  if(this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][0] == this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][1])
                    this.newarrschedule[i][i1][0][0] = [this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][0]];
                  else
                    this.newarrschedule[i][i1][0][0] = [this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][0], this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][1]];
                  
                  if(this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][0] == this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][1])
                   this.newarrschedule[i][i1][0][1] = [this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][0]];
                  else
                    this.newarrschedule[i][i1][0][1] = [this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][0], this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][1]];
                  }

                  if (this.arrschedule[this.arrday[i]][i1 + 1].Lesson[1] != null) //Если пара по знаменателю не пустая
                  {
                  if(this.arrschedule[this.arrday[i]][i1 + 1].Lesson[1][0] == this.arrschedule[this.arrday[i]][i1 + 1].Lesson[1][1])
                    this.newarrschedule[i][i1][1][0] = [this.arrschedule[this.arrday[i]][i1 + 1].Lesson[1][0]];
                  else
                    this.newarrschedule[i][i1][1][0] = [this.arrschedule[this.arrday[i]][i1 + 1].Lesson[1][0], this.arrschedule[this.arrday[i]][i1 + 1].Lesson[1][1]];
                  
                  if(this.arrschedule[this.arrday[i]][i1 + 1].Teacher[1][0] == this.arrschedule[this.arrday[i]][i1 + 1].Teacher[1][1])
                   this.newarrschedule[i][i1][1][1] = [this.arrschedule[this.arrday[i]][i1 + 1].Teacher[1][0]];
                  else
                    this.newarrschedule[i][i1][1][1] = [this.arrschedule[this.arrday[i]][i1 + 1].Teacher[1][0], this.arrschedule[this.arrday[i]][i1 + 1].Teacher[1][1]];
                  }
                }
                else //Есди одна сдвоенная пара
                {
                  if(this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][0] == this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][1])
                    this.newarrschedule[i][i1][0][0] = [this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][0]];
                  else
                    this.newarrschedule[i][i1][0][0] = [this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][0], this.arrschedule[this.arrday[i]][i1 + 1].Lesson[0][1]];
                  
                  if(this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][0] == this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][1])
                   this.newarrschedule[i][i1][0][1] = [this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][0]];
                  else
                    this.newarrschedule[i][i1][0][1] = [this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][0], this.arrschedule[this.arrday[i]][i1 + 1].Teacher[0][1]];
                }
              }
              else //Пустая пара
              {
                console.log("Свободная пара");
              }
            }
          }
          this.load = false;
        })
        .catch(ex => {
          console.log(ex);
        });
    }
  },
  mounted: function() {
    //Место
    this.places = JSON.parse(this.place);

    //Расписание звонков
    this.callschedule = JSON.parse(this.callSchedule);
    for (var i = 0; i < this.callschedule.length; i++)
      this.callschedule[i].call_schedule = JSON.parse(
        this.callschedule[i].call_schedule
      );
    var arrd = JSON.parse(this.departaments);
    this.arrdepartaments = JSON.parse(arrd.departaments);
    this.departament = this.arrdepartaments[0];

    this.changeGroups(this.departament.id);
    
    this.arrdiscip = JSON.parse(this.discip);
    this.arrteachers = JSON.parse(this.teachers);

    //Тестовые данные отображения УДАЛИТЬ ПОСЛЕ ТЕСТИРОВАНИЯ
    this.arrdiscip.push(this.arrdiscip[0]);
    this.arrdiscip[this.arrdiscip.length-1].discipline_name = "Информационные системы и технологии";

    this.arrteachers.push(this.arrteachers[0]);
    this.arrteachers[this.arrteachers.length-1].name = "Токарчук Александр Сергеевич";
  }
};
</script>