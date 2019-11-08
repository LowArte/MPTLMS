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
          @change="getGroups(departament.id)"
        ></v-autocomplete>
        <v-autocomplete
          v-model="casegroup"
          label="Группа"
          solo
          :items="arrgroups"
          item-text="group_name"
          return-object
          @change="getSchedule(casegroup.id)"
        ></v-autocomplete>
        <!-- <v-container class="pa-0 align-self-center" d-flex>
          <v-row sm="2" md="0" class="pa-0 justify-center">
            <v-col class="pa-0 d-flex justify-center" sm="2" md="0">
              <v-btn
                color="accent"
                dark
                @click="hidden = !hidden"
              >{{ hidden ? 'Числитель' : 'Знаменатель' }}</v-btn>
            </v-col>
          </v-row>
        </v-container>-->
      </v-container>
    </v-row>
    <v-divider class="ma-0"></v-divider>
    <v-data v-if="arrschedule" :items-per-page.sync="itemsPerPage">
      <v-row>
        <v-col v-for="item in day" :key="item" cols="12" sm="6" md="2" lg="4">
          <v-card>
            <v-card-title class="subtitle-1 mb-0 pb-0" style="color: #FF3D00;">{{item}}</v-card-title>
            <v-list dense class="ma-0 pa-0">
              <v-list-item>Здание: {{places[arrschedule[item].Place].place_name}}</v-list-item>
              <v-divider class="my-2"></v-divider>
              <div v-for="(n,i) in 7" :key="i" class="ma-0 pa-0">
                <v-list
                  class="ma-2 pa-0"
                  v-if="arrschedule[item][n].Lesson != null && arrschedule[item][n].Lesson != ''"
                >
                  <v-list-item
                    class="mt-0 mb-0 pt-0 pb-0"
                    v-if="callschedule[arrschedule[item].Place].call_schedule[n] != null && callschedule[arrschedule[item].Place].call_schedule[n]!=''"
                  >{{n}} пара - {{callschedule[arrschedule[item].Place].call_schedule[n]}}</v-list-item>
                  <v-list-item v-else>{{n}} пара - расписание звонка отсутствует!</v-list-item>
                  <v-list-item class="mt-0 mb-0 pt-0 pb-0">{{arrschedule[item][n].Lesson}}</v-list-item>
                  <v-list-item class="mt-0 mb-0 pt-0 pb-0">{{arrschedule[item][n].Teacher }}</v-list-item>
                </v-list>
                <v-list class="ma-0 pa-0" v-else>
                  <v-list-item
                    class="mt-0 mb-0 pt-0 pb-0"
                    v-if="callschedule[arrschedule[item].Place].call_schedule[n] != null && callschedule[arrschedule[item].Place].call_schedule[n]!=''"
                  >{{n}} пара - {{callschedule[arrschedule[item].Place].call_schedule[n]}}</v-list-item>
                  <v-list-item v-else>{{n}} пара - расписание звонка отсутствует!</v-list-item>
                  <v-list-item class="mt-0 mb-0 pt-0 pb-0">Свободная пара</v-list-item>
                </v-list>
                <v-divider class="my-2 ma-0 pa-0"></v-divider>
              </div>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-data>
    {{arrdepartaments}}
    <br />
    {{arrgroups}}
  </v-container>
</template>

<script>
import apigroup from "../../../api/group";
import apischedule from "../../../api/schedule";
export default {
  data: () => ({
    arrgroups: null,
    casegroup: "П-2-16",
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
    day: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]
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
    getGroups: function(departament) {
     // alert("Отеделение " + departament);
      apigroup
        .getGroup(departament)
        .then(reg => {
          this.arrgroups = reg.data.group;
          if (this.arrgroups.length > 0) {
            this.casegroup = this.arrgroups[0].group_name;
            getSchedule(this.arrgroups[0].id);
          }
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    getSchedule: function(group) {
      //alert("Группа " + group);
      apischedule
        .getSchedule(group)
        .then(reg => {
          this.arrschedule = JSON.parse(reg.data.schedule[0].schedule);
          
        })
        .catch(ex => {
          console.log(ex);
        });
    }
  },
  mounted: function() {
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
    console.log(JSON.parse(this.place));
    console.log(JSON.parse(this.groups));
    console.log(JSON.parse(this.callSchedule));
    console.log(JSON.parse(this.departaments));

    //Место
    this.places = JSON.parse(this.place);

    //Отделения
    this.arrdepartaments = JSON.parse(this.departaments);
    this.departament = JSON.parse(this.arrdepartaments.cur_departament)[0];
    this.arrdepartaments = JSON.parse(this.arrdepartaments.departaments);

    //Группы
    this.arrgroups = [];
    this.arrgroups.push(JSON.parse(this.groups));
    this.casegroup = this.arrgroups.group_name;
    this.getGroups(this.departament.id);

    //Расписание звонков
    this.callschedule = JSON.parse(this.callSchedule);
    for (var i = 0; i < this.callschedule.length; i++)
      this.callschedule[i].call_schedule = JSON.parse(
        this.callschedule[i].call_schedule
      );

    //Расписание занятий
    if (this.schedule == "") {
      console.log("Current schedule is empty");
    } else {
      console.log(JSON.parse(this.schedule));
      this.arrschedule = JSON.parse(this.schedule);
      this.arrschedule = JSON.parse(this.arrschedule.schedule);
    }
  }
};
</script>