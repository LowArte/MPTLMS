<template lang="pug">
div(name="top" v-if="posts.length > 0" )
  c-comfirm-dialog(ref='qwestion')
  v-card.mx-auto.mb-3(max-width="600px" v-for="(post, i) in posts" :key="i")
      v-system-bar(color="primary" lights-out dark)
          span {{post.time}}
          v-btn.mx-auto(x-small text @click="openPost(post.id)") Подробнее
          v-tooltip(v-if="user.post_id == 7 || user.post_id == 1" bottom)
              template(v-slot:activator="{ on }")
                  v-btn(icon x-small @click="deletePost(post.id)")
                      v-icon.pa-0.ma-0 close
              span Удалить запись
      v-carousel(height="300" min-height="250px" :continuous="false" :cycle="false" :show-arrows="false" delimiter-icon="mdi-minus" v-if="post.images.length > 0")
          v-carousel-item(v-for="(mediain, i) in post.media" :key="i" :src="mediain")
      v-content.pt-0.pa-2
          v-card-title {{post.title}}
          v-card-text {{post.text}}
      v-divider
      v-card-actions
          v-btn(text @click="clickLike(post.id)")
              v-icon mdi-heart
              span.mx-2 {{post.likes.length}}
  v-speed-dial(v-if="posts.length > 2" absolute fixed v-model="fab" :bottom="true" :right="true")
    template(v-slot:activator)
      v-btn(v-model="fab" color="primary" dark fab href="#top")
        v-icon keyboard_arrow_up
  v-btn.mx-auto(v-if="posts.length > 10" color="primary" block text :loading="loading" :disabled="loading") загрузить еще
</template>

<script>
import { mapGetters } from "vuex";

//?----------------------------------------------
//!           Подключение диалога
//?----------------------------------------------
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import news_api from "@/js/api/news";

export default {
  computed: {
    ...mapGetters(["user"])
  },
  components: {
    "c-comfirm-dialog": confirmDialog_C
  },
  post_name: {
    name: "Лента новостей",
    url: "news"
  },
  mixins: [withSnackbar],
  data: () => {
    return {
      loading: false,
      fab: false,
      posts: []
    };
  },
  async mounted() {
    this.posts = await news_api.getNews(this);
    console.log(this.posts.length);
  },
  methods: {
    deletePost(id) {
      this.$refs.qwestion.pop().then(result => {
        if (result) {
          this.posts.deleteById(id);
          news_api.deleteNews(id, this);
        }
      });
    },
    loadPost() {
      this.loading = true;
      console.log(this.posts);
      this.loading = false;
    },
    openPost(id) {
      this.loading = true;
      console.log(this.posts[1]);
      this.loading = false;
    },
    clickLike(id) {
      news_api.likeNews(id, this);
      //найти пользователя в масиве и отметить лайк, оновить счётчик
    }
  }
};
</script>