<template>
  <v-container fluid>
    <v-row align="center">
      <v-container>
        <v-autocomplete v-model="departamet" label="Отделения" solo :items="arrdepartaments"></v-autocomplete>
        <v-autocomplete v-model="group" label="Группа" solo :items="groups.group_name"></v-autocomplete>
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
    <v-data :items="schedule.schedule" :items-per-page.sync="itemsPerPage">
      <v-row>
        <v-col v-for="item in day" :key="item" cols="12" sm="6" md="2" lg="2">
          <v-card>
            <v-card-title class="subtitle-1 mb-0 pb-0" style="color: #FF3D00;">{{item}}</v-card-title>
            <v-list dense>
              <v-list-item>Здание: {{schedule[item].Place}}</v-list-item>
              <v-divider class="my-2"></v-divider>
              <div v-for="(n,i) in 7" :key="i" class="ma-0 pa-0">
                <v-list
                  class="ma-2 pa-0"
                  v-if="schedule[item][n].Lesson != null && schedule[item][n].Lesson != ''"
                >
                  <v-list-item
                    class="mt-0 mb-0 pt-0 pb-0"
                  >{{n}} пара - {{callSchedule[0].call_schedule[n]}}</v-list-item>
                  <v-list-item class="mt-0 mb-0 pt-0 pb-0">{{schedule[item][n].Lesson}}</v-list-item>
                  <v-list-item class="mt-0 mb-0 pt-0 pb-0">{{schedule[item][n].Teacher }}</v-list-item>
                </v-list>
                <v-list class="ma-0 pa-0" v-else>
                  <v-list-item
                    class="mt-0 mb-0 pt-0 pb-0"
                  >{{n}} пара - {{callSchedule[0].call_schedule[n]}}</v-list-item>
                  <v-list-item class="mt-0 mb-0 pt-0 pb-0">Свободная пара</v-list-item>
                </v-list>

                <v-divider class="my-2"></v-divider>
              </div>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-data>
    <!-- <v-data :items="items[group]" :items-per-page.sync="itemsPerPage">
      <template v-slot:default="props">
        <v-row>
          <v-col v-for="item in props.items" :key="item.name" cols="12" sm="6" md="2" lg="2">
            <v-card>
              <v-card-title
                class="subtitle-1"
                style="color: #FF3D00;"
              >{{ item.name }} - {{Datetime}}</v-card-title>
              <v-list dense>
                <v-list-item>Здание: {{item.place}}</v-list-item>
                <v-divider class="my-2"></v-divider>
                <v-list-item>
                  {{timeitems.p1}}
                  <br />
                  {{ item.p1 }}
                  <br />
                  {{ item.t1 }}
                </v-list-item>
                <v-divider class="my-2"></v-divider>
                <v-list-item>
                  {{timeitems.p2}}
                  <br />
                  {{ item.p2 }}
                  <br />
                  {{ item.t2 }}
                </v-list-item>
                <v-divider class="my-2"></v-divider>
                <v-list-item>
                  {{timeitems.p3}}
                  <br />
                  {{ item.p3 }}
                  <br />
                  {{ item.t3 }}
                </v-list-item>
                <v-divider class="my-2"></v-divider>
                <v-list-item>
                  {{timeitems.p4}}
                  <br />
                  {{ item.p4 }}
                  <br />
                  {{ item.t4 }}
                </v-list-item>
                <v-divider class="my-2"></v-divider>
                <v-list-item>
                  {{timeitems.p5}}
                  <br />
                  {{ item.p5 }}
                  <br />
                  {{ item.t5 }}
                </v-list-item>
                <v-divider class="my-2"></v-divider>
                <v-list-item>
                  {{timeitems.p6}}
                  <br />
                  {{ item.p6 }}
                  <br />
                  {{ item.t6 }}
                </v-list-item>
                <v-list-item>
                  {{timeitems.p7}}
                  <br />
                  {{ item.p7 }}
                  <br />
                  {{ item.t7 }}
                </v-list-item>
              </v-list>
            </v-card>
          </v-col>
        </v-row>
      </template>
    </v-data>-->
    <!-- {{this.groups}} -->
    <br />
    {{this.callSchedule}}
    <br />
    {{this.schedule}}
    <br />
  </v-container>
</template>

<script>
export default {
  data: () => ({
    group: "П-2-16",
    model: null,
    hidden: false,
    itemsPerPageOptions: [6],
    itemsPerPage: 6,
    Datetime: "00.00.0000",

    arrgroups: [],
    arrdepartaments: [],
    departament: null,

    group: null,

    day: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"]
  }),
  props: {
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
    loader: function() {
      //Получить массив описанный выше и забиндить его во vue
      return;
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

    console.log(JSON.parse(this.groups));
    console.log(JSON.parse(this.callSchedule));
    console.log(JSON.parse(this.departaments));

    //Отделения
    this.departaments = JSON.parse(this.departaments);
    this.departaments = JSON.parse(this.departaments.departaments);
    this.arrdepartaments = [];
    for (var i = 0; i < this.departaments.length; i++)
      this.arrdepartaments.push(this.departaments[i].dep_name_full);

    //Группы
    this.groups = JSON.parse(this.groups);
    this.group = this.groups.group_name;

    //Расписание звонков
    this.callSchedule = JSON.parse(this.callSchedule);
    for (var i = 0; i < this.callSchedule.length; i++)
      this.callSchedule[i].call_schedule = JSON.parse(
        this.callSchedule[i].call_schedule
      );

    //Расписание занятий
    if (this.schedule == "") {
      console.log("Current schedule is empty");
    } else {
      console.log(JSON.parse(this.schedule));
      this.schedule = JSON.parse(this.schedule);
      this.schedule = JSON.parse(this.schedule.schedule);
      // this.schedule['Понедельник']["1"].Lesson = ["1","2"];
    }
  }
  //Непонятно где приходят отделения и где приходят группы
};
</script>