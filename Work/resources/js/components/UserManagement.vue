<template>
  <v-row>
    <v-col cols="12">
      <v-hover v-slot:default="{ hover }">
        <v-card :elevation="hover ? 12 : 2" height="auto" width="max">
          <v-data-table
            :headers="headers"
            :items="listusers"
            class="elevation-1 pa-0 ma-0"
            :search="search"
            item-key="id"
            :page.sync="page"
            hide-default-footer
            @page-count="pageCount = $event"
            :items-per-page="itemsPerPage"
          >
            <template v-slot:top>
              <div>
                <v-toolbar flat color="white">
                  <v-toolbar-title>
                    <v-card-text class="my-2 ma-0 pa-0 text-center title">Управление пользователями</v-card-text>
                  </v-toolbar-title>
                  <v-divider class="mx-4" inset vertical></v-divider>
                </v-toolbar>
                <v-row sm="2" md="0" class="pa-0 align-self-center justify-center">
                  <v-btn color="primary" dark class="ma-2" @click="initialize(true)">Обновить</v-btn>
                  <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on }">
                      <v-btn color="primary" dark class="ma-2" v-on="on">Новый пользователь</v-btn>
                    </template>
                    <v-card>
                      <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                      </v-card-title>

                      <v-card-text>
                        <v-container>
                          <v-row>
                            <v-col cols="12" sm="6" md="12">
                              <v-text-field v-model="editedItem.thirdname" label="Фамилия"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="12">
                              <v-text-field v-model="editedItem.name" label="Имя"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="12">
                              <v-text-field v-model="editedItem.secname" label="Отчество"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="12">
                              <v-text-field v-model="editedItem.email" label="Почта"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="12">
                              <v-text-field v-model="editedItem.post" label="Роль"></v-text-field>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-card-text>

                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="close">Отмена</v-btn>
                        <v-btn color="blue darken-1" text @click="save">Сохранить</v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </v-row>
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
            <template v-slot:item.action="{ item }">
              <v-icon small class="mr-2" @click="editItem(item)">edit</v-icon>
              <v-icon small @click="deleteItem(item)">delete</v-icon>
            </template>
            <template v-slot:no-data>
              <v-btn color="primary" @click="initialize(true)">Обновить</v-btn>
            </template>
          </v-data-table>
          <div class="text-center pa-2 ma-2">
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
import apiuser from "../api/users";
import { mask } from "vue-the-mask";

export default {
  directives: {
    mask
  },
  data: () => ({
    arrusers: [],
    arrusersposts: [],
    search: "",
    page: 1,
    mask: "####",
    itemsPerPage: 10,
    pageCount: 0,
    on: false,

    dialog: false,
    headers: [
      {
        text: "№",
        align: "left",
        value: "id"
      },
      { text: "Фамилия", value: "secname" },
      { text: "Имя", value: "name" },
      { text: "Отчество", value: "thirdname" },
      { text: "Почта", value: "email", sortable: false },
      { text: "Роль", value: "post" },
      { text: "Действия", value: "action", sortable: false }
    ],
    listusers: [],
    editedIndex: -1,
    editedItem: {
      id: "",
      secname: "",
      name: "",
      thirdname: "",
      email: "",
      password: "",
      post: ""
    },
    defaultItem: {
      id: "",
      secname: "",
      name: "",
      thirdname: "",
      email: "",
      password: "",
      post: ""
    }
  }),
  props: {
    users: {
      data: String,
      default: null
    },
    usersposts: {
      data: String,
      default: null
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  mounted() {
    this.arrusers = JSON.parse(this.users);
    this.arrusersposts = JSON.parse(this.usersposts);
    console.log(this.arrusers);
    console.log(this.arrusersposts);
    this.initialize(false);
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Новый пользователь"
        : "Редактировать пользователя";
    }
  },

  methods: {
    initialize($b) {
      if ($b == true) {
        apiuser
          .getUsers()
          .then(res => {
            this.arrusers = JSON.parse(res.data.users);
            this.arrposts = JSON.parse(res.data.usersposts);
            this.pushUsers();
          })
          .catch(ex => {
            console.log(ex);
          });
      } else this.pushUsers();
    },

    pushUsers() {
      this.listusers = [];
      for (var i = 0; i < this.arrusers.length; i++) {
        this.listusers.push({
          id: this.arrusers[i].id,
          secname: this.arrusers[i].secName,
          name: this.arrusers[i].name,
          thirdname: this.arrusers[i].thirdName,
          email: this.arrusers[i].email,
          password: this.arrusers[i].password_notHash,
          post: this.arrusers[i].post_id
        });
      }
    },

    editItem(item) {
      this.editedIndex = this.listusers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      apiuser
        .deleteUser({
          id: item.id
        })
        .then(res => {
          const index = this.listusers.indexOf(item);
          confirm("Вы действительно хотите удалить данного пользователя?") &&
            this.listusers.splice(index, 1);
          alert("Удалён!");
        })
        .catch(ex => {
          initialize(true);
          console.log(ex);
        });
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      var $check = true;
      for (var i = 0; i < this.arrusers.length; i++)
        if (this.arrusers[i].email == this.editedItem.email) $check = false;
      if ($check) {
        if (this.editedIndex == -1) this.editedItem.id = -1;

        apiuser
          .saveUser({
            user: this.editedItem
          })
          .then(res => {
            if (this.editedIndex > -1)
              Object.assign(this.listusers[this.editedIndex], this.editedItem);
            else this.initialize(true);

            alert("Сохранён!");
            this.close();
          })
          .catch(ex => {
            initialize(true);
            console.log(ex);
          });
      }
      else
        alert("Указанная почта уже используется!");
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