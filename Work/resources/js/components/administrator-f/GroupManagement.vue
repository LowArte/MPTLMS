<template lang="pug">
    v-card.mx-auto.pa-2(width='100%' height='auto' outline)
      c-comfirm-dialog(ref='qwestion')
      v-data-table.elevation-0.pa-0.ma-0(
        :headers="headers"
        :items="groups"
        :search="search"
        item-key="id"
        no-results-text='Нет результатов' 
        no-data-text='Нет результатов'
        :page.sync="page"
        hide-default-footer
        @page-count="pageCount = $event"
        :items-per-page="itemsPerPage")
        template(v-slot:top)
          v-card-title.my-2.ma-0.py-2.text-truncate CRUD - групп
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
                v-text-field(v-model="editedItem.group_name" label="Наименование")
                v-text-field(v-model="editedItem.study_period" label="Срок обучения")
                v-autocomplete(:items="arr_type_of_study" v-model="editedItem.type_of_study" dense solo label='Тип обучения')
                v-text-field(v-model="editedItem.сurs" label="Курс")
                v-autocomplete(:items="departments" item-value="id" item-text="dep_name_full" v-model="editedItem.type_of_study" dense solo label='Отделение')
                v-card-actions                  
                  v-btn(color="accent darken-1" text @click="close") Отмена
                  v-spacer
                  v-btn(color="info darken-1" text @click="save()") Сохранить
          v-text-field.ma-0.pa-0.mt-4.single-line.hide-details(v-model="search" label="Поиск")
        template(v-slot:item.action="{ item }")
          v-icon.small(@click="editItem(item)") edit
          v-icon.small(@click="deleteItem(item)") delete
      v-layout.row.text-center.pa-2.ma-2
        v-pagination(v-model="page" :length="pageCount")
</template>

<script>
import apigroups from "../../api/group"; //api для групп
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
    groups: [], //Массив групп
    departments: [], //Массив отделений
    search: "", //Поиск
    page: 1, //Текущая страница
    itemsPerPage: 10, //Количество отображаемых строк
    pageCount: 0, //Количество страниц
    mask: "####", //Маска для количества отображаемых строк
    dialog: false, //Активатор диалога
    arr_type_of_study: ["Очная", "Заочная"],
    headers: [
      { text: "Группа", value: "group_name" },
      { text: "Курс", value: "сurs" },
      { text: "Действия", value: "action", sortable: false }
    ], //Структура таблицы и с полями которые требуется выводить
    editedItem: {
      id: -1,
      group_name: "",
      study_period: "",
      arr_type_of_study: "",
      сurs: 1,
      departaments_id: 1,
    },//Структура строки
  }),
  props: {
    _groups: {
      type: Array,
      default: null
    }, //Данные групп
    _departments: {
      type: Array,
      default: null
    } //Данные отделений
  },

  //Получаем данных при старте
  mounted() {
    this.groups = this._groups;
    this.departments = this._departments;
  },

  computed: {
    //Получение названия диалога
    formTitle() {
      return this.editedItem.id === -1
        ? "Новая группа"
        : "Редактировать группу";
    }
  },

  methods: {
    //Иницилизации данных
    initialize() {
      apigroups
        .getGroupAll()
        .then(res => {
          this.groups = res.data.groups;
          this.$departments = res.data.departments;
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
          apigroups
            .deleteGroup({ id: item.id })
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
      this.editedItem = Object.assign({},
      {id: -1,
      group_name: "",
      study_period: "",
      arr_type_of_study: "",
      curs: "",
      departaments_id: 1});
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
      apigroups
        .saveGroup({group: this.editedItem})
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
      apigroups
        .editGroup({
          group: this.editedItem
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