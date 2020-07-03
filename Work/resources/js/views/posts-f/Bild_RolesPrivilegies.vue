<template lang='pug'>  
    v-card(v-if="selectedPost")
      v-system-bar
        v-card-text Настройка меню пользователя
      v-layout.column.wrap
        v-flex.ma-2.mb-0
          v-autocomplete.ma-1(label="Роль" @change="postChange" no-data-text="Нет данных" return-object item-text='name' :items="posts" v-model="selectedPost")
        v-flex.ma-2.mb-0.row.pa-4
          v-flex.md6.xs12
            v-treeview(:active.sync="active" v-if="selectedPost" item-text="text" :items="selectedPost.privilegies" open-all return-object activatable transition :multiple-active='false')              
              template(v-slot:append="{item}")
                v-btn(v-if="item.children && item.id!=1" text icon @click="addInside(item)")
                  v-icon add
              template(v-slot:prepend="{ item }") 
                v-icon(v-if="item.icon") {{item.icon}}
            v-btn(text block @click="addNew" color="primary") НОВЫЙ ЭЛЕМЕНТ
          v-flex(text-center)
            v-scroll-y-transition(mode="out-in")
              div.mx-auto(max-width="400" v-if="!selected" style="align-self: center;" title grey--text text--lighten-1 font-weight-light) Выберите элемент
              v-card.mx-auto(flat v-else max-width="400")
                v-text-field(v-model='selected.text' label="Наименование")
                v-flex(v-if='selected.children' row)
                  v-icon.mr-1 {{selected.icon}}
                  v-autocomplete(v-model='selected.icon' no-data-text="Нет данных" :items="icons" label="Иконка")
                    template(v-slot:item="{ item }")
                        v-icon {{item}}
                        v-spacer
                        span {{item}}
                v-autocomplete(v-if='(!selected.children || selected.children.length==0) && !selected.default' return-object item-text='info.name' no-data-text="Нет данных" :items="files" v-model='selected.component' label="Компонент")
                v-btn(v-if="!selected.default" @click="deleteItem(selected)") УДАЛИТЬ
        v-flex.ma-2.mb-0
          v-btn.mt-2.justify-center(color="accent" block dark @click="sendQuery") СОХРАНИТЬ               
</template>

<script>
import { getIcons } from "@/js/materialDesignIcons";
import api_user_post from "@/js/api/userPost";
import * as mutations from "@/js/store/mutation-types";
import withSnackbar from "@/js/components/mixins/withSnackbar"; //Alert
import withOverlayLoading from "@/js/components/mixins/withOverlayLoader"; //Загрузка

export default {
  mixins: [withSnackbar, withOverlayLoading],
  post_name: {
    name: "Конструктор привилегий ролей",
    url: "bild_post_privilegies"
  },
  mounted() {
    this.init();
  },
  computed: {
    selected() {
      //Выьранный элемент из массива this.active
      if (!this.active.length) return undefined;
      return this.active[0];
    }
  },
  data: () => {
    return {
      active: [], // Активный элемент TreeView
      icons: getIcons(), // Доступные на выбор иконки
      files: [], // Файлы компонентов
      posts: [], // Информации из таблицы *USERS_POST*
      selectedPost: null // Выбранный элемень роли
    };
  },
  methods: 
  {
    async init() 
    {
      this.showLoading("Загрузка данных");
      this.files = this.importAll(require.context("@/js/views", true, /\.vue$/));
      this.posts = await api_user_post.getPostsFull();
      if (this.posts) 
        this.selectedPost = this.posts[0];
      this.closeLoading("Загрузка данных");
    },
    postChange() {
      this.active = [];
    },
    //! Добавляет внутрь массива privilegies{item}.children дополнительный элемент
    addInside(item) {
      if (!item.component) 
        delete item.component;

      item.children.push({
        id:
          Math.random()
            .toString(36)
            .substring(2, 15) +
          Math.random()
            .toString(36)
            .substring(2, 15),
        text: "Новый элемент",
        component: null
      });
    },
    //! Добавляет внутрь массива privilegies дополнительный элемент
    addNew() {
      const element = {
        id:
          Math.random()
            .toString(36)
            .substring(2, 15) +
          Math.random()
            .toString(36)
            .substring(2, 15),
        icon: "fiber_new",
        text: "Новый элемент",
        menu: true,
        component: "",
        children: []
      };

      if (this.selectedPost.id != 1) 
        this.selectedPost.privilegies.splice(this.selectedPost.privilegies.length - 1, 0, element);
      else 
        this.selectedPost.privilegies.push(element);
    },

    //! Удаляет элемент из массива children или privilegies
    deleteItem(item) 
    {
      this.active = [];
      if (item.children) 
      {
        this.selectedPost.privilegies = this.selectedPost.privilegies.filter(
          x => x.id !== item.id
        );
      } 
      else 
      {
        this.selectedPost.privilegies = this.selectedPost.privilegies.map(
          varitem => {
            let deleted = [];
            if (varitem.children)
              deleted = varitem.children.filter(x => x.id !== item.id);
            
            if (deleted.length == 0) 
            {
              return {
                id: varitem.id,
                icon: varitem.icon,
                text: varitem.text,
                children: [],
                component: null
              };
            } 
            else 
            {
              return {
                id: varitem.id,
                icon: varitem.icon,
                text: varitem.text,
                children: deleted
              };
            }
          }
        );
      }
    },

    //! Отправляет запрос на сохранение изменений
    async sendQuery() 
    {
      //console.log(this.selectedPost.privilegies);
      if(await api_user_post.setPostPrivilegies({id: this.selectedPost.id, privilegies: this.selectedPost.privilegies}))
        this.showMessage("Выполнено!");
      else
        this.showError("Произошла ошибка!");
    },

    //! Сканирует систему на компоненты и возврашает их
    importAll(r) 
    {
      let items = [];
      r.keys().forEach(key => {
        let com = r(key);
        if (com.default.post_name) {
          items.push({
            info: com.default.post_name,
            path: "js/views" + key.replace(".","").replace(".vue", "")
          });
        }
      });
      return items;
    }
  }
};
</script>