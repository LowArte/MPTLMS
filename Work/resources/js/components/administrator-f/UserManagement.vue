<template lang="pug">
  v-layout.row
    v-hover(v-slot:default='{ hover }')
      v-card.mx-auto.pa-2(width='100%' height='auto' :elevation='hover ? 12 : 2')
        v-data-table.elevation-1.pa-0.ma-0(
          :headers="headers"
          :items="listusers"
          :search="search"
          item-key="id"
          no-results-text='Нет результатов' 
          no-data-text='Нет результатов'
          :page.sync="page"
          hide-default-footer
          @page-count="pageCount = $event"
          :items-per-page="itemsPerPage")
          template(v-slot:top)
            v-toolbar(color="white" flat)
              v-toolbar-title
                v-card-text.my-2.ma-0.pa-0.title Управление пользователями
            v-layout.row.pa-0.align-self-center.justify-center(sm="2" md="0")
              v-btn.dark.ma-2(color="primary" @click="initialize()") Обновить
              v-dialog(v-model="dialog" max-width="500px")
                template(v-slot:activator="{ on }")
                  v-btn.ma-2.dark(color="primary" v-on="on") Новый пользователь
                v-card
                  v-card-title.span.headline {{ formTitle }}
                  v-card-text
                    v-layout.row
                      v-text-field(v-model="editedItem.thirdName" label="Фамилия")
                    v-layout.row
                      v-text-field(v-model="editedItem.name" label="Имя")
                    v-layout.row
                      v-text-field(v-model="editedItem.secName" label="Отчество")
                    v-layout.row
                      v-text-field(v-model="editedItem.email" label="Почта")
                    v-layout.row
                      v-autocomplete(:items="arrusersposts" item-value='id' item-text='name' v-model="editedItem.post_id" dense solo label='Роль')
                    v-layout.row
                      v-autocomplete(:items="adisabled" item-value='id' item-text='name' value=item v-model="editedItem.disabled" dense solo label='Блокировка')
                    v-card-actions
                      v-spacer
                      v-btn(color="blue darken-1" text @click="close") Отмена
                      v-btn(color="blue darken-1" text @click="save") Сохранить
            v-card-title.ma-0.ml-4.mr-4.pa-0
              v-text-field.ma-0.pa-0.mt-4.single-line.hide-details(v-model="search" label="Поиск")
          template(v-slot:item.action="{ item }")
            v-icon.small(@click="editItem(item)") edit
            v-icon.small(@click="deleteItem(item)") delete
        v-layout.row.text-center.pa-2.ma-2
          v-pagination(v-model="page" :length="pageCount")
</template>

<script>
import apiuser from "../../api/users"; //api для пользователей
import { mask } from "vue-the-mask"; //маски vue

export default {
  directives: {
    mask
  },
  data: () => ({
    listusers: [], //Массив
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 10, //Количество отображаемых пользователей
    pageCount: 0, //Количество страниц
    mask: "####", //Маска для количества отображаемых строк
    dialog: false, //Активатор диалога
    adisabled: [{ id: 0, name: "Свободен" }, { id: 1, name: "Заблокирован" }],
    headers: [
      {
        text: "№",
        align: "left",
        value: "id"
      },
      { text: "Почта", value: "email" },
      { text: "Роль", value: "post" },
      { text: "Блокировка", value: "text-disabled" },
      { text: "Действия", value: "action", sortable: false }
    ], //Структура таблицы и с полями которые требуется выводить
    editedIndex: -1, //Текущий индекс редактируемой строки
    editedItem: {
      id: "",
      secName: "",
      name: "",
      thirdName: "",
      email: "",
      password: "",
      post_id: "",
      disabled: ""
    } //Массив с данным для сохранения в бд
  }),
  props: {
    _listusers: {
      data: Array,
      default: null
    }, //JSON пользователей
    _arrusersposts: {
      type: Array,
      default: null
    }
  },
  computed: {
    //Получение названия диалога
    formTitle() {
      return this.editedIndex === -1
        ? "Новый пользователь"
        : "Редактировать пользователя";
    }
  },
  methods: {
    mounted() {
      this.listusers = this._listusers;
      //this.arrusersposts = this._arrusersposts;
      console.log(this.listusers);
      /*for(var i = 0; i < this.listusers.length; i++)
        this.listusers[i]['text-disabled'] = this.adisabled[this.listusers[i]['disabled']].name;*/
    },
    //Иницилизации данных
    initialize(){
      apiuser
        .getUsers()
        .then(res => {
          this.listusers = JSON.parse(res.data.users);
          this.arrposts = JSON.parse(res.data.usersposts);
          for(var i = 0; i < this.listusers.length; i++)
            this.listusers[i]['text-disabled'] = this.adisabled[this.listusers[i]['disabled']].name;
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    /*//Редактирование учётной записи
    editItem(item) {
      this.editedIndex = this._listusers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    //Удаление учётной записи
    deleteItem(item) {
      confirm("Вы действительно хотите удалить данного пользователя?") &&
        apiuser
          .deleteUser({ id: item.id })
          .then(res => {
            alert("Удалён!");
            this.initialize();
          })
          .catch(ex => {
            console.log(ex);
          });
    },
    //Закрытие диалога
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign(
          {},
          {
            id: "",
            secName: "",
            name: "",
            thirdName: "",
            email: "",
            password: "",
            post_id: "",
            disabled: ""
          }
        );
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex == -1) this.editedItem.id = -1;

      apiuser
        .saveUser({
          user: this.editedItem
        })
        .then(res => {
          switch (res.data.success) {
            case "erroremail":
              alert("Почта уже используется!");
              break;
            case true:
              this.initialize();
              alert("Сохранён!");
              this.close();
              break;
          }
        })
        .catch(ex => {
          alert("Сохранение не было произведено!");
          console.log(ex);
        });
    }*/
  }
};
</script>