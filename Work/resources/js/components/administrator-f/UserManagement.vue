<template lang="pug">
    v-card.mx-auto.pa-2(width='100%' height='auto' outline)
      v-data-table.elevation-0.pa-0.ma-0(
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
          v-card-title.my-2.ma-0.py-2.text-truncate CRUD - пользователи
          v-btn.ma-2.ml-0(text @click="initialize()")
            v-icon refresh
          v-dialog(v-model="dialog" max-width="500px")
            template(v-slot:activator="{ on }")
              v-btn.ma-2(text v-on="on")
                v-icon add_circle_outline
            v-card.ma-0.pa-0
              v-card-title.headline 
                h4.text-truncate {{ formTitle }}
              v-alert.ma-2(v-if="alert.type != null" :type="alert.type" transition="scale-transition") {{alert.text}}
              v-card-text
                v-text-field(v-model="editedItem.thirdName" label="Фамилия")
                v-text-field(v-model="editedItem.name" label="Имя")
                v-text-field(v-model="editedItem.secName" label="Отчество")
                v-text-field(v-model="editedItem.email" label="Почта")
                v-autocomplete(:items="arrusersposts" item-value='id' item-text='name' v-model="editedItem.post_id" dense solo label='Роль')
                v-autocomplete(:items="adisabled" item-value='id' item-text='name' value=item v-model="editedItem.disabled" dense solo label='Блокировка')
                v-card-actions                  
                  v-btn(color="accent darken-1" text @click="close") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="save") Сохранить
          v-text-field.ma-0.pa-0.mt-4.single-line.hide-details(v-model="search" label="Поиск")
        template(v-slot:item.text-disabled="{ item }")
          v-card-text.ma-0.pa-0 {{adisabled[item['disabled']].name}}
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
    arrusersposts: [], //Массив постов
    alert: { type: null, text: null }, //Alert
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 10, //Количество отображаемых пользователей
    pageCount: 0, //Количество страниц
    mask: "####", //Маска для количества отображаемых строк
    dialog: false, //Активатор диалога
    adisabled: [
      { id: 0, name: "Разблокирован" },
      { id: 1, name: "Заблокирован" }
    ], //Состояние блокировки
    headers: [
      { text: "Почта", value: "email" },
      { text: "Роль", value: "post.name" },
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
    },
    _arrusersposts: {
      type: Array,
      default: null
    }
  },
  //Получаем данные при старте
  mounted() {
    this.listusers = this._listusers;
    this.arrusersposts = this._arrusersposts;
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
    //Иницилизации данных
    initialize() {
      apiuser
        .getUsers()
        .then(res => {
          this.listusers = res.data.users;
          this.arrposts = res.data.usersposts;
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    //Редактирование учётной записи
    editItem(item) {
      this.editedIndex = this.listusers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    //Удаление учётной записи
    deleteItem(item) {
      confirm("Вы действительно хотите удалить данного пользователя?") &&
        apiuser
          .deleteUser({ id: item.id })
          .then(res => {
            alert("Удалён!"); //! Перенести в другое тип встроенных уведомлений
            this.initialize();
          })
          .catch(ex => {
            console.log(ex);
          });
    },
    //Закрытие диалога
    close() {
      this.dialog = false;

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
    },

    save() {
      if (this.editedIndex == -1) this.editedItem.id = -1;

      apiuser
        .saveUser({
          user: this.editedItem
        })
        .then(res => {
          this.initialize();
          alert("Сохранён!"); //! Перенести в другое тип встроенных уведомлений
          this.close();
        })
        .catch(ex => {
          alert("Сохранение не было произведено!"); //! Перенести в другое тип встроенных уведомлений
          console.log(ex);
        });
    }
  }
};
</script>