<template>
  <v-container fluid>
    <v-row align="center">
      <v-container>
        <v-autocomplete v-model="departamet" label="Отделения" solo :items="departaments"></v-autocomplete>
        <v-autocomplete v-model="group" label="Группа" solo :items="groups"></v-autocomplete>
        <v-container class="pa-0 align-self-center" d-flex>
          <v-row sm="2" md="0" class="pa-0 justify-center">
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
    <v-data :items="items[group]" :items-per-page.sync="itemsPerPage">
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
    </v-data>
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
  }),
  props:{
    schedule:{
      type: String,
      default:null
    },
    callSchedule:{
      type: String,
      default:null
    },
    groups:{
      type: String,
      default:null
    },
    departaments:{
      type:String,
      default:null
    }
  },
  methods: {
    loader: function() {
      //Получить массив описанный выше и забиндить его во vue
      return;
    }
  },
  mounted:function() {
      var currDate = new Date()
      var hours = currDate.getHours()
      var minutes = currDate.getMinutes()
      var seconds = currDate.getSeconds()
      if (hours <= 9) {
        hours = "0" + hours
      }
      if (minutes <= 9) {
        minutes = "0" + minutes
      }
      if (seconds <= 9) {
        seconds = "0" + seconds
      }
      this.Datetime = hours + ":" + minutes + ":" + seconds
      console.log(JSON.parse(this.groups))
      console.log(JSON.parse(this.callSchedule))
      console.log(JSON.parse(this.departaments))
      console.log(JSON.parse(this.schedule))
  }
};
</script>