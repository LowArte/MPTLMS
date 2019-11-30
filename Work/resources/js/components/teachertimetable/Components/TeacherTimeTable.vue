<template>
  <v-container fluid>
    <v-row align="center">
      <v-container>
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
              <v-card-title class="subtitle-1" style="color: #FF3D00;">{{ item.name }} - {{Datetime}}</v-card-title>
              <v-list dense>
                <v-list-item>Здание: {{Building}}</v-list-item>
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
    groups: ["П-1-16", "П-2-16", "П-3-16", "П-4-16"],
    group: "П-2-16",
    model: null,
    hidden: false,
    itemsPerPageOptions: [6],
    itemsPerPage: 6,
    Datetime: '00.00.0000',
    timeitems: {},
    items: {}
  })
};
</script>