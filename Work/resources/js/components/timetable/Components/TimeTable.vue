<template>
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
      </v-container>
    </v-row>
    <v-divider class="ma-0"></v-divider>
    <v-data v-if="arrschedule != null && load == false" :items-per-page.sync="itemsPerPage">
      <v-row>
        <v-col v-for="item in arrday" :key="item" cols="12" sm="6" md="2" lg="4">
          <v-card dark class="pa-0 pb-0">
            <v-card light class="ma-1 pa-0">
              <v-divider class="my-2" color="Black"></v-divider>
              <v-card-title class="mb-0 pb-0" style="color: #FF3D00;">{{item}}</v-card-title>
              <v-list dense class="ma-0 pa-0">
                <v-list-item>Место проведения: {{places[arrschedule[item].Place-1].place_name}}</v-list-item>
                <v-divider class="my-2" color="Black"></v-divider>
                <div v-for="(n,i) in 8" :key="i" class="ma-0 pa-0">
                  <v-list
                    class="ma-0 ml-4 mr-4 pa-0"
                    v-if="arrschedule[item][n].Lesson != null && arrschedule[item][n].Lesson != ''"
                  >
                    <v-list
                      class="ma-0 pa-0"
                      v-if="typeof(arrschedule[item][n].Lesson) == 'object' && arrschedule[item][n].Lesson != null"
                    >
                      <v-card-title
                        style="color: #FF3D00;"
                        class="subtitle-1 ma-0 pa-0"
                      >{{n}} пара - {{callschedule[arrschedule[item].Place-1].call_schedule[n]}}</v-card-title>
                      <v-list
                        v-for="(Lesson, l1) in arrschedule[item][n].Lesson"
                        :key="l1"
                        class="ma-0 pa-0"
                      >
                        <v-list v-if="typeof(Lesson) == 'object'" class="ma-0 pa-0">
                          <v-list v-if="Lesson != null" class="ma-0 pa-0">
                            <v-list-item v-if="l1 == 0" class="ma-0 pa-0">
                              <div class="ma-0 pa-0">
                                <v-card-title
                                  style="color: #FF3D00;"
                                  class="subtitle-1 ma-0 pa-0"
                                  v-if="arrschedule[item][n].Lesson.length > 1"
                                >Числитель:</v-card-title>
                                <p class="ma-0 pa-0">{{Lesson[0]}}/{{Lesson[1]}}</p>
                                <p
                                  class="ma-0 pa-0"
                                >{{arrschedule[item][n].Teacher[l1][0]}}/{{arrschedule[item][n].Teacher[l1][1]}}</p>
                              </div>
                            </v-list-item>
                            <v-list v-if="Lesson != null" class="ma-0 pa-0">
                              <v-list-item v-if="l1 == 1" class="ma-0 pa-0">
                                <div class="ma-0 pa-0">
                                  <v-card-title
                                    style="color: #FF3D00;"
                                    class="subtitle-1 ma-0 pa-0"
                                  >Знаменатель:</v-card-title>
                                  <p class="ma-0 pa-0">{{Lesson[0]}}/{{Lesson[1]}}</p>
                                  <p
                                    class="ma-0 pa-0"
                                  >{{arrschedule[item][n].Teacher[l1][0]}}/{{arrschedule[item][n].Teacher[l1][1]}}</p>
                                </div>
                              </v-list-item>
                            </v-list>
                          </v-list>
                        </v-list>
                        <v-list v-if="Lesson == null" class="ma-0 pa-0">
                          <v-list-item v-if="l1 == 0" class="ma-0 pa-0">
                            <div class="ma-0 pa-0">
                              <v-card-title
                                style="color: #FF3D00;"
                                class="subtitle-1 ma-0 pa-0"
                              >Числитель:</v-card-title>
                              <p class="ma-0 pa-0">{{nullDis}}</p>
                            </div>
                          </v-list-item>

                          <v-list-item v-if="l1 == 1" class="ma-0 pa-0">
                            <div class="ma-0 pa-0">
                              <v-card-title
                                style="color: #FF3D00;"
                                class="subtitle-1 ma-0 pa-0"
                              >Знаменатель:</v-card-title>
                              <p class="ma-0 pa-0">{{nullDis}}</p>
                            </div>
                          </v-list-item>
                        </v-list>

                        <v-list v-if="typeof(Lesson) != 'object'" class="ma-0 pa-0">
                          <v-list-item v-if="l1 == 0" class="ma-0 pa-0">
                            <div class="ma-0 pa-0">
                              <v-card-title
                                style="color: #FF3D00;"
                                class="subtitle-1 ma-0 pa-0"
                              >Числитель:</v-card-title>
                              <p class="ma-0 pa-0">{{Lesson}}</p>
                              <p class="ma-0 pa-0">{{arrschedule[item][n].Teacher[l1]}}</p>
                            </div>
                          </v-list-item>

                          <v-list-item v-if="l1 == 1" class="ma-0 pa-0">
                            <div class="ma-0 pa-0">
                              <v-card-title
                                style="color: #FF3D00;"
                                class="subtitle-1 ma-0 pa-0"
                              >Знаменатель:</v-card-title>
                              <p class="ma-0 pa-0">{{Lesson}}</p>
                              <p class="ma-0 pa-0">{{arrschedule[item][n].Teacher[l1]}}</p>
                            </div>
                          </v-list-item>
                        </v-list>
                      </v-list>
                    </v-list>

                    <!-- Обычная пара -->
                    <v-list class="ma-0 pa-0" v-else>
                      <v-list-item
                        class="ma-0 pa-0"
                        v-if="callschedule[arrschedule[item].Place].call_schedule[n] != null && callschedule[arrschedule[item].Place].call_schedule[n]!=''"
                      >
                        <v-card-title
                          style="color: #FF3D00;"
                          class="subtitle-1 ma-0 pa-0"
                        >{{n}} пара - {{callschedule[arrschedule[item].Place-1].call_schedule[n]}}</v-card-title>
                      </v-list-item>
                      <v-list-item
                        v-else
                        class="ma-0 pa-0"
                      >{{n}} пара - расписание звонка отсутствует!</v-list-item>
                      <v-list-item class="ma-0 pa-0">
                        <div class="ma-0 pa-0">
                          <p class="ma-0 pa-0">{{arrschedule[item][n].Lesson}}</p>
                          <p class="ma-0 pa-0">{{arrschedule[item][n].Teacher}}</p>
                        </div>
                      </v-list-item>
                    </v-list>
                  </v-list>
                  <!-- Свободная пара -->
                  <v-list class="ma-0 ml-4 mr-4 pa-0" v-else>
                    <v-list-item
                      class="ma-0 pa-0"
                      v-if="callschedule[arrschedule[item].Place].call_schedule[n] != null && callschedule[arrschedule[item].Place].call_schedule[n]!=''"
                    >
                      <v-card-title
                        style="color: #FF3D00;"
                        class="subtitle-1 ma-0 pa-0"
                      >{{n}} пара - {{callschedule[arrschedule[item].Place-1].call_schedule[n]}}</v-card-title>
                    </v-list-item>
                    <v-list-item class="ma-0 pa-0" v-else>
                      <v-card-title
                        style="color: #FF3D00;"
                        class="subtitle-1 ma-0 pa-0"
                      >{{n}} пара - расписание звонка отсутствует!</v-card-title>
                    </v-list-item>
                    <v-list-item class="ma-0 pa-0">{{nullDis}}</v-list-item>
                  </v-list>
                  <v-divider class="my-1 ma-0 pa-0" color="Black"></v-divider>
                </div>
              </v-list>
            </v-card>
          </v-card>
        </v-col>
      </v-row>
    </v-data>
    <v-row v-if="load==true" sm="2" md="0" class="pa-0 mt-5 align-self-center justify-center">
      <v-progress-circular :disabled="load" indeterminate color="primary"></v-progress-circular>
    </v-row>
  </v-container>
</template>

<script>
import apigroup from "../../../api/group";
import apischedule from "../../../api/schedule";
export default {
  data: () => ({
    load: true,
    nullDis: "Свободная пара",
    casegroup: null,
    model: null,
    hidden: false,
    itemsPerPageOptions: [6],
    itemsPerPage: 6,
    Datetime: "00.00.0000",

    arrgroups: [],
    arrdepartaments: [],
    departament: null,
    callschedule: null,
    arrschedule: null,
    group: null,
    places: [],
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
  watch: {
    casegroup(val, oldval) {
      if (this.groups == "") this.changeSchedule(val.id);
      else {
        if (oldval != null) this.changeSchedule(val.id);
      }
    }
  },
  methods: {
    changeGroups: function(departament) {
      //alert("Отеделение " + departament);
      this.load = true;
      apigroup
        .getGroup(departament)
        .then(reg => {
          this.arrgroups = reg.data.group;
          this.casegroup = this.arrgroups[0];
        })
        .catch(ex => {
          console.log(ex);
        });
        this.load = false;
    },
    changeSchedule: function(group) {
      //alert("Группа " + group);
      this.load = true;
      apischedule
        .getSchedule(group)
        .then(reg => {
          this.arrschedule = JSON.parse(reg.data.schedule[0].schedule);
        })
        .catch(ex => {
          console.log(ex);
        });
      this.load = false;
    }
  },
  mounted: function() {
    this.load = true;
    var currDate = new Date();
    var hours = currDate.getHours();
    var minutes = currDate.getMinutes();
    var seconds = currDate.getSeconds();
    if (hours <= 9) {
      hours = "0" + hours;
    }
    if (minutes <= 9) {
      minutes = "0" + minutes;
    }
    if (seconds <= 9) {
      seconds = "0" + seconds;
    }
    this.Datetime = hours + ":" + minutes + ":" + seconds;

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
    if (this.groups == null || this.groups == "") {
      //Отделения
      this.departament = this.arrdepartaments[0];

      this.changeGroups(this.departament.id);
    } else {
      //Отделения
      this.departament = JSON.parse(arrd.cur_departament);

      //Группы
      this.changeGroups(this.departament.id);
      this.casegroup = JSON.parse(this.groups);
    }
    this.load = false;
  }
};
</script>