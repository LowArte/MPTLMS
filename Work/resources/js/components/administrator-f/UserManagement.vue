<template lang="pug">
    v-card.mx-auto.pa-2(width='100%' height='auto' outline)
      c-comfirm-dialog(ref='qwestion')
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
              v-card-text
                v-text-field(v-model="editedItem.thirdName" label="Фамилия")
                v-text-field(v-model="editedItem.name" label="Имя")
                v-text-field(v-model="editedItem.secName" label="Отчество")
                v-text-field(v-model="editedItem.email" label="Почта")
                v-autocomplete(:items="arrusersposts" item-value='id' item-text='name' v-model="editedItem.post_id" dense solo label='Роль' @change="changePost")
                v-autocomplete(:items="adisabled" item-value='id' item-text='name' value=item v-model="editedItem.disabled" dense solo label='Блокировка')
                //- v-combobox(v-if="editedItem.post_id==2" @change="departament_change" v-model="departaments_info.selected_departament" item-text="dep_name_full" :items="departaments_info.departaments" label="Специальность")
                v-combobox(v-if="editedItem.post_id==2" v-model="studentItem.group_id" item_value="id" item_text="group_name" label='Группа')
                v-dialog(v-if="editedItem.post_id==2" ref="dateDialog" v-model="dateDialog" :return-value.sync="studentItem.group" persistent width="290px")
                  template(v-slot:activator="{ on }")
                      v-text-field(v-model="studentItem.group" label="Дата" readonly v-on="on")
                  v-date-picker(v-model="studentItem.group" scrollable :first-day-of-week="1" locale="ru-Ru")
                      v-btn(text color="primary" @click="dateDialog = false") Отмена
                      v-btn(text color="primary" @click="$refs.dateDialog.save(studentItem.group);") Принять
                v-radio-group(v-if="editedItem.post_id==2" v-model="studentItem.gender" :mandatory="false")
                  v-radio(label="Мужской" value="Мужской")
                  v-radio(label="Женский" value="Женский")
                v-autocomplete(v-if="editedItem.post_id==2" :items="arrfinancings" v-model="studentItem.type_of_financing" dense solo label='Вид финансирования')
                v-card-actions                  
                  v-btn(color="accent darken-1" text @click="close") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="save()") Сохранить
          v-text-field.ma-0.pa-0.mt-4.single-line.hide-details(v-model="search" label="Поиск")
        template(v-slot:item.text-disabled="{ item }")
          v-card-text.ma-0.pa-0 {{adisabled[item['disabled']].name}}
        template(v-slot:item.action="{ item }")
          v-icon.small(@click="editItem(item)") edit
          v-icon.small(v-if="item['post_id'] != 1" @click="deleteItem(item)") delete
      v-layout.row.text-center.pa-2.ma-2
        v-pagination(v-model="page" :length="pageCount")
</template>

<script>
import apiuser from "../../api/users"; //api для пользователей
import { mask } from "vue-the-mask"; //маски vue
import withSnackbar from "../mixins/withSnackbar"; //Alert
import group_api from "./../../api/group"; //Группы
import ConfirmDialog_C from "./../expention-f/ConfirmDialog"; //Диалог confirm

export default {
  mixins: [withSnackbar],

  directives: 
  {
    mask
  },

  components: 
  {
    "c-comfirm-dialog": ConfirmDialog_C
  },

  data: () => ({
    departaments_info: [], //Массив отделений
    groups_info: [],
    listusers: [], //Массив
    arrusersposts: [], //Массив постов
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 10, //Количество отображаемых строк
    pageCount: 0, //Количество страниц
    mask: "####", //Маска для количества отображаемых строк
    dialog: false, //Активатор диалога
    arrfinancings: ["Бюджетный", "Платный"],
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
    editedItem: {
      id: -1,
      secName: "",
      name: "",
      thirdName: "",
      email: "",
      password: "",
      post_id: "",
      disabled: ""
    }, //Массив с данными учётной записи для сохранения в бд

    studentItem: {
      id: -1,
      group_id: 1,
      birthday: new Date().toISOString().substr(0, 10),
      gender: "Мужской",
      type_of_financing: ""
    }, //Массив с данным студента для сохранения в бд
    dateDialog: null //Диалог даты
  }),

  props: 
  {
    _departaments_info: {
      type: Array,
      default: null
    },
    _listusers: {
      data: Array,
      default: null
    },
    _arrusersposts: {
      type: Array,
      default: null
    },
    _slug: {
      type: String,
      default: ""
    } //Модуль
  },

  //Получаем данные при старте
  mounted() 
  {
    this.listusers = this._listusers;
    this.arrusersposts = this._arrusersposts;
    this.departaments = this._departaments;
  },

  computed: 
  {
    //Получение названия диалога
    formTitle() {
      return this.editedItem.id === -1
        ? "Новый пользователь"
        : "Редактировать пользователя";
    }
  },

  methods: 
  {
    //Изменение отделения
    departament_change() 
    {
      group_api
        .getGroup(departaments_info.selected)
        .then(res => {
          this.groups_info.groups = res.data.groups;
          this.studentItem.group_id = this.groups_info.groups[0].id;
        })
        .catch(ex => {
          this.showError(ex);
        });
    },

    //Изменение роли
    changePost() 
    {
      if (item.post_id == 2) 
      {
        apiuser
          .getStudent({ id: this.editedItem.id })
          .then(res => {
            this.studentItem = Object.assign({}, res.data.student);
          })
          .catch(ex => {
            this.showError(ex);
          });
      }
    },

    //Иницилизации данных
    initialize() 
    {
      apiuser
        .getUsers()
        .then(res => {
          this.listusers = res.data.users;
          this.arrposts = res.data.usersposts;
        })
        .catch(ex => {
          this.showError(ex);
        });
    },

    //Вызов диалогового окна для редактирования учётной записи
    editItem(item) 
    {
      this.editedItem = Object.assign({}, item);

      if (item.post_id == 2) 
      {
        apiuser
          .getStudent({ id: this.editedItem.id })
          .then(res => {
            this.studentItem = Object.assign({}, res.data.student);
          })
          .catch(ex => {
            this.showError(ex);
          });
      }

      this.dialog = true;
    },

    //Удаление учётной записи
    deleteItem(item) 
    {
      this.$refs.qwestion.pop().then(confirmResult => {
        if (confirmResult) 
        {
          apiuser
            .deleteUser({ id: item.id })
            .then(res => {
              this.showMessage("Удаление выполнено");
              this.initialize();
            })
            .catch(ex => {
              this.showError("Удаление не было произведено " + ex);
            });
        } 
        else 
        {
          this.showInfo("Действие было отменено");
        }
      });
    },

    //Закрытие диалога
    close() 
    {
      this.dialog = false;
      this.editedItem = Object.assign(
        {},
        {
          id: -1,
          secName: "",
          name: "",
          thirdName: "",
          email: "",
          password: "",
          post_id: "",
          disabled: ""
        }
      );

      this.studentItem = Object.assign(
        {},
        {
          id: -1,
          group_id: 1,
          birthday: new Date().toISOString().substr(0, 10),
          gender: "Мужской",
          type_of_financing: ""
        }
      );
    },

    //Обработка нажатия на кнопку сохранить
    save() 
    {
      if (this.editedItem.id == -1) 
      {
        this.editedItem.id = -1;
        this.saveNew();
      } 
      else 
        this.saveEdit();
    },

    //Сохранение нового пользователя
    saveNew() 
    {
      apiuser
        .saveUser({
          user: this.editedItem,
          student: this.studentItem
        })
        .then(res => {
          this.initialize();
          this.showMessage("Сохранён!");
          this.close();
        })
        .catch(ex => {
          this.showError(ex.response.data.error);
        });
    },
    
    //Сохранение изменения для выбранного пользователя
    saveEdit() 
    {
      apiuser
        .saveEdit({
          id: this.editedItem.id,
          user: this.editedItem,
          student: this.studentItem
        })
        .then(res => {
          this.initialize();
          this.showMessage("Изменён!");
          this.close();
        })
        .catch(ex => {
          if (ex.response.status == 400)
            this.showError(ex.response.data.error);
          else
            this.showError(ex);
        });
    }
  }
};
</script>