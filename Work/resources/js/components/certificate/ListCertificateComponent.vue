<template>
  <v-row align="center" justify="center">
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" class="mx-auto pa-4" height="auto" width="max">
          <v-data-table
            :headers="headers"
            :items="items"
            :single-expand="true"
            :expanded.sync="expanded"
            item-key="id"
            show-expand
            class="elevation-1"
            :page.sync="page"
            hide-default-footer
            @page-count="pageCount = $event"
            :search="search"
            :items-per-page="itemsPerPage"
          >
            <template v-slot:top>
              <div>
                <v-toolbar flat color="white" class="ma-0 ml-2 mr-2 pa-0">
                  <v-toolbar-title>Заказы документации от студентов</v-toolbar-title>
                  <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-title class="ma-0 ml-4 mr-4 pa-0">
                  <v-text-field
                    class="ma-0 pa-0"
                    v-model="search"
                    label="Поиск"
                    single-line
                    hide-details
                  ></v-text-field>
                </v-card-title>
              </div>
            </template>
            <template v-slot:expanded-item="{ headers }">
              <td :colspan="headers.length" v-if="expanded.length > 0">
                <div>
                  <v-card-text class="my-1 ma-0 pa-0 text">ФИО: {{expanded[0].fio}}</v-card-text>
                  <v-card-text
                    v-for="(info,i) in Object.keys(expanded[0].body)"
                    :key="i"
                    class="my-1 ma-0 pa-0 text"
                  >{{info}} : {{expanded[0].body[info]}}</v-card-text>
                </div>
              </td>
            </template>
          </v-data-table>
          <div class="text-center pt-2">
            <v-pagination v-model="page" :length="pageCount"></v-pagination>
            <v-text-field
              :value="itemsPerPage"
              label="Количество отображаемых обращений"
              v-mask="mask"
              @input="itemsPerPage = parseIntLoc($event)"
            ></v-text-field>
          </div>
        </v-card>
      </v-hover>
    </v-col>
  </v-row>
</template>

<script>
import { mask } from "vue-the-mask";

export default {
  directives: {
    mask
  },
  data() {
    return {
      search: "",
      mask: "####",
      expanded: [],
      singleExpand: true,
      page: 1,
      pageCount: 0,
      itemsPerPage: 100,
      headers: [
        { text: "Номер обращения", value: "id" },
        { text: "Тематика", value: "name" },
        { text: "Почта", value: "email" },
        { text: "Дата обращения", value: "date" },
        { text: "", value: "data-table-expand" }
      ],
      items: [
        {
          id: 1,
          name: "asdsadasda",
          email: "asdadas@mail.ru",
          date: new Date().toString(),
          fio: "sdasd asd asdadas",
          body: {
            Школа: "123113",
            Справка: "asdsahdgashg adas hajsgdha dhasghdasg h"
          }
        }
      ]
    };
  },
  props: {
    requests: {
      data: String,
      default: ""
    }
  },
  mounted() {
    this.items = JSON.parse(this.requests);
    for (let i = 0; i < this.items.length; i++) {
      this.items[i].body = JSON.parse(this.items[i].body);  
    }
  },
  methods: {
    parseIntLoc(val) {
      if (val == "" || val == null || val == "0") {
        return 1;
      }
      return parseInt(val);
    }
  }
};
</script>
