<template lang="pug">
    v-card.mx-auto.pa-2(width='100%' height='auto' outline)
      c-comfirm-dialog(ref='qwestion')
      v-data-table.elevation-0.pa-0.ma-0(
        :headers="headers"
        :items="posts"
        :search="search"
        item-key="id"
        no-results-text='Нет результатов' 
        no-data-text='Нет результатов'
        :page.sync="page"
        hide-default-footer
        @page-count="pageCount = $event"
        :items-per-page="itemsPerPage")
        template(v-slot:top)
          v-card-title.my-2.ma-0.py-2.text-truncate CRUD - должностей
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
                v-text-field(v-model="editedItem.name" label="Наименование")
                v-card-actions                  
                  v-btn(color="accent darken-1" text @click="close") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="save()") Сохранить
          v-text-field.ma-0.pa-0.mt-4.single-line.hide-details(v-model="search" label="Поиск")
        template(v-slot:item.action="{ item }")
          v-icon.small(@click="editItem(item)") edit
          //- v-icon.small(@click="deleteItem(item)") delete
      v-layout.row.text-center.pa-2.ma-2
        v-pagination(v-model="page" :length="pageCount")
</template>

<script>
import apiposts from "../../api/userPosts"; //api для должностей
import { mask } from "vue-the-mask"; //маски vue
import withSnackbar from "../mixins/withSnackbar";//Alert
import ConfirmDialog_C from "./../expention-f/ConfirmDialog"; //Диалог confirm

export default {
  mixins: [withSnackbar],
  directives: {
    mask
  },
  components: {
    "c-comfirm-dialog": ConfirmDialog_C
  },
  data: () => ({
    posts: [], //Массив должностей
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 10, //Количество отображаемых строк
    pageCount: 0, //Количество страниц
    mask: "####", //Маска для количества отображаемых строк
    dialog: false, //Активатор диалога
    headers: [
      { text: "Наименование", value: "name" },
      { text: "Действия", value: "action", sortable: false }
    ], //Структура таблицы и с полями которые требуется выводить
    editedItem: {
      id: -1,
      name: ""
    },//Структура строки
  }),
  props: {
    _posts: {
      type: Array,
      default: null
    } //Данные должностей
  },

  //Получаем данных при старте
  mounted() {
    this.posts = this._posts;
  },

  computed: {
    //Получение названия диалога
    formTitle() {
      return this.editedItem.id === -1
        ? "Новая должность"
        : "Редактировать должность";
    }
  },

  methods: {
    //Иницилизации данных
    initialize() {
      apiposts
        .getPosts()
        .then(res => {
          this.posts = res.data.posts;
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    //Вызов диалогового окна для редактирования
    editItem(item) 
    {
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    //Удаление
    deleteItem(item) {
      this.$refs.qwestion.pop().then(confirmResult => {
        if (confirmResult) {
          apiposts
            .deleteDepartment({ id: item.id })
            .then(res => {
              this.showMessage("Удалено!");
              this.initialize();
            })
            .catch(ex => {
              this.showError("Удаление не было произведено!" + ex);
            })
        } else {
          this.showMessage("Действие было отменено");
        }
      });
    },
    //Закрытие диалога
    close() {
      this.dialog = false;
      this.editedItem = Object.assign({}, {id: -1,name: "",});
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
    //Сохранение нового места проведения
    saveNew()
    {
      apiposts
        .saveDepartment({post: this.editedItem})
        .then(res => {
          this.initialize();
          this.showMessage("Сохранено!");
          this.close();
        })
        .catch(ex => {
          this.showError("Сохранение не было произведено! " + ex);
        });
    },
    //Сохранение изменения для выбранного места проведения
    saveEdit()
    {
      apiposts
        .editDepartment({
          post: this.editedItem
        })
        .then(res => {
          this.initialize();
          this.showMessage("Изменён!");
          this.close();
        })
        .catch(ex => {
          this.showError("Изменение не было произведено! " + ex);
        });
    }
  }
};
</script>