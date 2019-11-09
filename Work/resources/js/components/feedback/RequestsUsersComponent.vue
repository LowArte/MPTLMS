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
                  <v-toolbar-title>Обращение пользователей</v-toolbar-title>
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
                  <v-card-text class="my-1 ma-0 pa-0 text">Сообщение: {{expanded[0].body}}</v-card-text>
                  <br />
                  <v-form v-model="form" class="mt-0 pt-0">
                    <v-container class="mt-0 pt-0">
                      <v-row class="mt-0 pt-0">
                        <v-textarea
                          class="mt-0 pt-0"
                          v-model="modelmessage"
                          :auto-grow="true"
                          :clearable="false"
                          :counter="255 ? 255 : false"
                          :filled="false"
                          :flat="true"
                          :hint="'Не более 255 символов'"
                          :label="'Сообщение'"
                          :loading="false"
                          :no-resize="false"
                          :outlined="false"
                          :persistent-hint="false"
                          :placeholder="''"
                          :rounded="false"
                          :row-height="24"
                          :rows="3"
                          :shaped="false"
                          :single-line="false"
                          :solo="false"
                          :rules="messageRules"
                        ></v-textarea>
                      </v-row>
                      <v-row class="pa-2 justify-center">
                        <v-btn
                          :disabled="!form"
                          class="white--text"
                          color="blue"
                          depressed
                          @click="sendQuery(expanded[0].email)"
                        >Отправить</v-btn>
                      </v-row>
                    </v-container>
                  </v-form>
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
import feedbackApi from "../../api/feedback";
import { mask } from "vue-the-mask";
import withSnackbar from "../mixins/withSnackbar";

export default {
  mixins: [withSnackbar],
  directives: {
    mask
  },
  data() {
    return {
      modelmessage: "",
      messageRules: [
        v => v.length > 0 || "Текст сообщения не указан",
        v =>
          v.length <= 255 || "Текст сообщения должен быть не более 255 символов"
      ],
      form: false,
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
      items:[]
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
    console.log(this.items);
  },
  methods: {
    sendQuery(email) {   
      feedbackApi
        .sendEmail({mail:email,text:this.modelmessage,id:this.expanded[0].id})
        .then(res => {
          this.showMessage("Ответ отправлен");
          this.items.splice(this.expanded[0])
        })
        .catch(exp => {
          this.showError("Произошла ошибка");
        });
      this.modelmessage = "";
    },
    parseIntLoc(val) {
      if (val == "" || val == null || val == "0") {
        return 1;
      }
      return parseInt(val);
    }
  }
};
</script>