<template lang="pug">
    v-card.mx-auto.pa-2(width='100%' height='auto' outline)
      c-comfirm-dialog(ref='qwestion')
      v-data-table.elevation-0.pa-0.ma-0(:headers="headers" :items="departments" :search="search" item-key="id" no-results-text='Нет результатов' no-data-text='Нет результатов' :page.sync="page" hide-default-footer @page-count="pageCount = $event" :items-per-page="itemsPerPage")
        template(v-slot:top)
          v-card-title.my-2.ma-0.py-2.text-truncate CRUD - отделений
          v-tooltip(bottom)
            template(v-slot:activator="{ on }")
              v-btn.ma-2.ml-1(text v-on="on" @click="initialize()")
                  v-icon refresh
            span Перезагрузить
          v-tooltip(bottom)
            template(v-slot:activator="{ on }")
              v-btn.ma-2.ml-1(text v-on="on" @click="initialize()")
                  v-icon mdi-delete
            span Удалить все
          v-tooltip(bottom)
            template(v-slot:activator="{ on }")
              v-btn.ma-2.ml-1(text color="red" v-on="on" @click="upload()")
                  v-icon mdi-upload
                  span.ma-2 Загрузить документ
            span Загрузить файл с данными
          v-tooltip(bottom)
            template(v-slot:activator="{ on }")
              v-btn.ma-2.ml-1(text color="success" v-on="on" @click="upload()")
                  v-icon mdi-download
                  span.ma-2 Скачать документ
            span Скачать файл с данными
          v-dialog(v-model="dialog" max-width="500px")
            template(v-slot:activator="{ on }")
              v-tooltip(bottom)
                template(v-slot:activator="{ on }")
                  v-btn.ma-2(text v-on="on" @click="initialize()")
                      v-icon add
                span Новая запись
            v-card.ma-0.pa-0
              v-card-title.headline 
                h4.text-truncate {{ formTitle }}
              v-card-text
                v-text-field(v-model="editedItem.dep_name" label="Код")
                v-text-field(v-model="editedItem.specialization" label="Специальность")
                v-card-actions                  
                  v-btn(color="accent darken-1" text @click="close") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="save()") Сохранить
          v-text-field.ma-0.pa-0.mt-4.single-line.hide-details(v-model="search" label="Поиск")
        template(v-slot:item.action="{ item }")
          v-tooltip(bottom)
              template(v-slot:activator="{ on }")
                  v-icon.small(v-on="on" @click="editItem(item)") edit
              span Редактировать
          v-tooltip(bottom)
              template(v-slot:activator="{ on }")
                v-icon.small(v-on="on" @click="deleteItem(item)") mdi-delete
              span Удалить
      v-layout.row.text-center.pa-2.ma-2
        v-pagination(v-model="page" :length="pageCount")
</template>

<script>
import apidepartments from "../../api/departments"; //api для отделений
import { mask } from "vue-the-mask"; //маски vue
import withSnackbar from "../mixins/withSnackbar"; //Alert
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
    departments: [], //Массив отделений
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 30, //Количество отображаемых строк
    pageCount: 0, //Количество страниц
    mask: "####", //Маска для количества отображаемых строк
    dialog: false, //Активатор диалога
    headers: [
      { text: "Наименование", value: "dep_name_full" },
      { text: "Действия", value: "action", sortable: false }
    ], //Структура таблицы и с полями которые требуется выводить
    editedItem: {
      id: -1,
      dep_name: "",
      specialization: "",
      dep_name_full: ""
    } //Структура строки
  }),
  props: {
    _departments: {
      type: Array,
      default: null
    } //Данные отделение
  },

  //Получаем данных при старте
  mounted() {
    this.departments = this._departments;
  },

  computed: {
    //Получение названия диалога
    formTitle() {
      return this.editedItem.id === -1
        ? "Новое отделение"
        : "Редактировать отделение";
    }
  },

  methods: {
    //Иницилизации данных
    initialize() {
      apidepartments
        .getDepartments()
        .then(res => {
          this.departments = res.data.departments;
        })
        .catch(ex => {
          console.log(ex);
        });
    },
    //Функция для загрузки ФАЙЛА с данными для таблицы
    upload() {
      this.showMessage("Данная функция будет не доступна до релизной версии");
    },
    //Вызов диалогового окна для редактирования
    editItem(item) {
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    //Удаление
    deleteItem(item) {
      this.$refs.qwestion.pop().then(confirmResult => {
        if (confirmResult) {
          apidepartments
            .deleteDepartment({ id: item.id })
            .then(res => {
              this.showMessage("Удалено!");
              this.initialize();
            })
            .catch(ex => {
              this.showError("Удаление не было произведено!" + ex);
            });
        } else {
          this.showMessage("Действие было отменено");
        }
      });
    },
    //Закрытие диалога
    close() {
      this.dialog = false;
      this.editedItem = Object.assign(
        {},
        { id: -1, dep_name: "", specialization: "", dep_name_full: "" }
      );
    },
    //Обработка нажатия на кнопку сохранить
    save() {
      this.editedItem.dep_name_full =
        this.editedItem.dep_name + " " + this.editedItem.specialization;
      if (this.editedItem.id == -1) {
        this.editedItem.id = -1;
        this.saveNew();
      } else this.saveEdit();
    },
    //Сохранение нового места проведения
    saveNew() {
      apidepartments
        .saveDepartment({ department: this.editedItem })
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
    saveEdit() {
      apidepartments
        .editDepartment({
          department: this.editedItem
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