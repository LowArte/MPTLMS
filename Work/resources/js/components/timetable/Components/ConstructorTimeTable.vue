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
    <v-data v-cloak :items="arrday" :items-per-page.sync="itemsPerPage">
      <v-row >
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
                          :items="arrlessons"
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
                          small-chips
                          chips
                          multiple
                          return-object
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
                          :items="arrlessons"
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
  </v-container>
</template>

<script>
import apigroup from "../../../api/group";
import apischedule from "../../../api/schedule";
export default {
  data: () => ({
    itemsPerPageOptions: [6],
    itemsPerPage: 6,
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

    newarrschedule: [],
    arrlessons: [
      "Технология разработки и защиты баз данных",
      "Операционные системы",
      "Технология разработки программного обеспечения"
    ],
    arrteachers: [
      "Горбунов Антон Дмитриевич",
      "Шимбирёв Андрей Андреевич",
      "Комаров Андрей Алексеевич"
    ]
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
                this.newarrschedule[i][i1].push([[], []]);
              }
            }
          }

          this.arrswitch = [];
          for (var i = 0; i < 6; i++) {
            this.arrswitch.push([]);
            for (var i1 = 0; i1 < this.newarrschedule[i].length; i1++) {
              this.arrswitch[i].push(null);
            }
          }
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
  }
};
</script>