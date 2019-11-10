<template>
  <v-row>
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-0" height="auto" width="max">
          <v-container class="pa-0 ma-0">
            <v-row class="pa-2 ma-0">
              <v-card-text class="my-2 ma-0 pa-0 text-center title">Панель управления</v-card-text>
            </v-row>
            <v-divider></v-divider>
            <v-row class="pa-2 ma-0">
              <v-checkbox v-model="options.prof" :label="`Режим профилактики`"></v-checkbox>
            </v-row>
            <v-btn class="ma-2" color="accent" dark @click="sendQuery">Применить</v-btn>
          </v-container>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

<script>
import panelApi from "../api/panel";

export default {
  data: () => ({
    options: {
      prof: false
    }
  }),
  components: {},
  props: {
    options_prop: {
      data: String,
      default: null
    }
  },
  mounted() {
    this.options = JSON.parse(this.options_prop);
    console.log(this.options);
  },
  methods: {
    sendQuery() {
      Object.keys(this.options).forEach(element => {
        switch (element) {
          case "prof": {
            panelApi
              .setOptionValue({
                prop: "isProfilacticServer",
                value: this.options[element]
              })
              .then(res => {
                console.log(res);
              })
              .catch(ex => {
                console.log(ex);
              });
            break;
          }
        }
      });
    }
  }
};
</script>