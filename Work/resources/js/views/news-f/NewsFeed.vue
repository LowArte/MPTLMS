<template lang="pug">
div(name="top" v-if="posts.length > 0" )
  c-comfirm-dialog(ref='qwestion')
  v-card.mx-auto.mb-3(max-width="600px" v-for="(post, i) in posts" :key="i")
    v-system-bar(color="primary" lights-out dark v-if="user != null && user.post_id != null")
      //--span {{post.time}}
      //--v-btn.mx-auto(x-small text @click="openPost(post.id)") Подробнее
      v-spacer
      v-tooltip(v-if="user.post_id == 7 || user.post_id == 1" bottom)
          template(v-slot:activator="{ on }")
              v-btn(icon x-small @click="deletePost(post.id)")
                  v-icon.pa-0.ma-0 close
          span Удалить запись
    c-card-new(:_post = "post")
  v-speed-dial(v-if="posts.length > 2" absolute fixed v-model="fab" :bottom="true" :right="true")
    template(v-slot:activator)
      v-btn(v-model="fab" color="primary" dark fab href="#top")
        v-icon keyboard_arrow_up
  v-btn.mx-auto(v-if="posts.length > 10" color="primary" block text :loading="loading" :disabled="loading") загрузить ещё
</template>

<script>
import { mapGetters } from "vuex";

//?----------------------------------------------
//!           Подключение диалога
//?----------------------------------------------
import confirmDialog_C from "@/js/components/expention-f/ConfirmDialog";
import cardNew_C from "@/js/components/news-f/CardNew";

//?----------------------------------------------
//!           Подключение системы уведомлений
//?----------------------------------------------
import withSnackbar from "@/js/components/mixins/withSnackbar";

//?----------------------------------------------
//!           Подключение api
//?----------------------------------------------
import api_new from "@/js/api/new";

export default {
  computed: {
    ...mapGetters(["user"])
  },
  components: {
    "c-comfirm-dialog": confirmDialog_C,
    "c-card-new" : cardNew_C
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
  async beforeMount() 
  {
    this.posts = await api_new.getNews(this.user.id);
  },
  methods: {
    async deletePost(id) 
    {
        if(await this.$refs.qwestion.pop().then(res => { return res;}))
        {
          if(await api_new.deleteNews(id))
          {
            this.showMessage("Пост удалён!");
            this.posts = await api_new.getNews(this.user.id);
          }
        }
    },
    loadPost() {
      this.loading = true;
      this.loading = false;
    },
    openPost(id) {
      this.loading = true;
      this.loading = false;
    }
  }
};
</script>